<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use App\Circle;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];
    
    // state
    const STATE_NONE    = 0;
    const STATE_REQUEST = 1;
    const STATE_REFUSE  = 2;
    const STATE_JOIN    = 3;
    
    
    // 
    // 共通処理
    // 
    
    // ユーザに関連するサークルリストを取得
    public function circles()
    {
        return $this->belongsToMany(Circle::class)->withPivot('state')->withTimestamps();
    }
    // 参加済みのサークルリストを取得
    public function joinedCircles()
    {
        return $this->circles()->where('state', \Config::get('const.STATE_JOIN'))->get();
    }
    
    // 中間テーブルに情報が存在しているか
    public function existsCircleState($circleId)
    {
        return $this->circles()->where('circle_id', $circleId)->exists();
    }
    
    // stateを更新
    public function updateState($circleId, $state)
    {
        if ($this->existsCircleState($circleId)) 
        {
            \DB::update("UPDATE circle_user SET state = ? WHERE user_id = ? AND circle_id = ?", [$state, \Auth::user()->id, $circleId]);
        } else {
            $this->circles()->attach($circleId, ['state' => $state]);
        }
    }
    

    //
    // リクエスト関連
    //
    
    // 参加リクエスト申請
    public function request($circleId)
    {
        if (!$this->canRequest($circleId)) return false;
        $this->updateState($circleId, \Config::get('const.STATE_REQUEST'));
        return true;
    }
    
    // 参加リクエストキャンセル
    public function cancelRequest($circleId)
    {
        if (!$this->canCancelRequest($circleId)) return false;
        $this->updateState($circleId, \Config::get('const.STATE_NONE'));
        return true;
    }
    
    // リクエスト申請可能かどうか（参加していないサークルにのみ可能）
    public function canRequest($circleId)
    {
        // そもそも情報が存在していなければ申請可能
        if (!$this->existsCircleState($circleId)) return true;
        
        $notJoinedCircles = $this->circles()->where('state', \Config::get('const.STATE_NONE'));
        return $notJoinedCircles->where('circle_id', $circleId)->exists();
    }
    // リクエストキャンセル可能かどうか（リクエスト中のサークルにのみ可能）
    public function canCancelRequest($circleId)
    {
        $requestedCircles = $this->circles()->where('state', \Config::get('const.STATE_REQUEST'));
        return $requestedCircles->where('circle_id', $circleId)->exists();
    }
    

    //
    // 参加関連
    //
    
    // 参加
    public function join($circleId)
    {
        if ($this->hasJoined($circleId)) return false;
        $this->updateState($circleId, \Config::get('const.STATE_JOIN'));
        return true;
    }
    
    // 参加済かどうか
    public function hasJoined($circleId)
    {
        $joinedCircles = $this->circles()->where('state', \Config::get('const.STATE_JOIN'));
        return $joinedCircles->where('circle_id', $circleId)->exists();
    }

}
