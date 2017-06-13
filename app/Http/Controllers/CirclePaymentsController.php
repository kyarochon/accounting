<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CirclePayment;

class CirclePaymentsController extends Controller
{
    public function index(){}
    public function create(){}
    public function show($id){}



    // 新規作成
    public function store(Request $request)
    {
        $circlePayment = new CirclePayment;
        $circlePayment->circle_id = $request->circle_id;
        $circlePayment->type      = $request->type;
        $circlePayment->category  = $request->category;
        $circlePayment->text      = $request->text;
        $circlePayment->payments  = $request->payments;
        $circlePayment->date      = $request->date;
        $circlePayment->save();
        
        return redirect('/circles/' . $request->circle_id);
    }

    // 編集
    public function edit($id)
    {
    }

    // 更新
    public function update(Request $request, $id)
    {
    }

    // 削除
    public function destroy($id)
    {
    }
}
