<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
}
