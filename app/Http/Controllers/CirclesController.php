<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Circle;
use App\CirclePayment;

class CirclesController extends Controller
{
    public function index()
    {
        $keyword = request()->keyword;
        $circles = [];
        
        if ($keyword) {
            $circles = Circle::where('name', 'LIKE', '%' . $keyword . '%')->get();
        }

        return view('circles.index', [
            'keyword' => $keyword,
            'circles' => $circles,
        ]);
    }

    public function create()
    {
        $circle = new Circle;

        return view('circles.create', [
            'circle' => $circle,
        ]);
    }

    public function store(Request $request)
    {
        // サークル新規作成
        $circle = new Circle;
        $circle->name       = $request->name;
        $circle->image_name = $request->image_name;
        $circle->save();
        
        // サークルに作成ユーザを加入
        \Auth::user()->join($circle->id);

        return redirect('/');
    }

    public function show($id)
    {
        $circle = Circle::find($id);
        
        return view('circles.show', [
            'circle' => $circle,
        ]);

    }

    public function edit($id){}
    public function update(Request $request, $id){}
    public function destroy($id){}
    

    public function graph($id)
    {
        $circle = Circle::find($id);

        $incomeList   = [];
        $incomeLabels = []; 
        $incomeCategories = \Config::get('const.INCOME_CATEGORIES');
        foreach ($incomeCategories  as $incomeCategory) {
            $income = CirclePayment::where('circle_id', $id)->where('category', $incomeCategory)->sum('payments');
            $incomeList[]   = $income;
            $incomeLabels[] = \Config::get('const.CATEGORY_NAME')[$incomeCategory];
        }

        $spendingList = [];
        $spendingLabels = []; 
        $spendingCategories = \Config::get('const.SPENDING_CATEGORIES');
        foreach ($spendingCategories  as $spendingCategory) {
            $spending = CirclePayment::where('circle_id', $id)->where('category', $spendingCategory)->sum('payments');
            $spendingList[]   = $spending;
            $spendingLabels[] = \Config::get('const.CATEGORY_NAME')[$spendingCategory];
        }

        $data = [
            'circle'          => $circle,
            'income_list'     => $incomeList,
            'income_labels'   => $incomeLabels,
            'spending_list'   => $spendingList,
            'spending_labels' => $spendingLabels,
        ];
        
        return view('circles.graph', $data);
    }
    
    public function input_list($id)
    {
        $circle = Circle::find($id);
        $circlePayments = CirclePayment::where('circle_id', $id)->orderBy('date', 'desc')->get();

        $totalFee = 0;
        foreach ($circlePayments as $circlePayment)
        {
            if ($circlePayment->type == \Config::get('const.TYPE_INCOME')) {
                $totalFee += $circlePayment->payments;
            } else {
                $totalFee -= $circlePayment->payments;
            }
        }

        $data = [
            'circle' => $circle,
            'circle_payments' => $circlePayments,
            'total_fee' => $totalFee,
        ];
        
        return view('circles.list', $data);
    }
    
    public function member($id)
    {
        $circle = Circle::find($id);
        $users = $circle->users()->get();
        
        $data = [
            'circle' => $circle,
            'users'  => $users,
        ];
        
        return view('circles.member', $data);
    }
    
}
