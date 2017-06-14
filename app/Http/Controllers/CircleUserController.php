<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Circle;

class CircleUserController extends Controller
{
    public function request()
    {
        $circleId = request()->circleId;
        $user     = \Auth::user();
        
        if ($user->canRequest($circleId))
        {
            $user->request($circleId);
        }
        return redirect()->back();
    }


    public function cancelRequest()
    {
        $circleId = request()->circleId;
        $user     = \Auth::user();
        
        if ($user->canCancelRequest($circleId))
        {
            $user->cancelRequest($circleId);
        }
        return redirect()->back();
    }
    
    
    public function acceptRequest()
    {
        $circleId = request()->circleId;
        $userId   = request()->userId;
        
        $user = User::find($userId);
        $user->acceptRequest($circleId);

        return redirect()->back();
    }
    
    public function rejectRequest()
    {
        $circleId = request()->circleId;
        $userId   = request()->userId;

        $user = User::find($userId);
        $user->rejectRequest($circleId);

        return redirect()->back();
    }
    
    public function leave()
    {
        $circleId = request()->circleId;
        $userId   = request()->userId;

        $user = User::find($userId);
        $user->leave($circleId);

        return redirect("/");
    }
}
