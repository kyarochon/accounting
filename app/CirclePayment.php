<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CirclePayment extends Model
{
    protected $table    = 'circle_payments';
    protected $fillable = ['circle_id', 'type', 'category', 'text', 'payments', 'date'];

    // 収支種別名
    function getTypeText() {
        switch ($this->type) {
            case \Config::get('const.TYPE_INCOME'):   return "収入";
            case \Config::get('const.TYPE_SPENDING'): return "支出";
            default: return "";
        }
        return "";
    }
    
    // 収支カテゴリ名
    function getCategoryText() {
        return \Config::get('const.CATEGORY_NAME')[$this->category];
    }
}
