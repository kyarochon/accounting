<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Circle;

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
        
        $data = [
            'circle' => $circle,
        ];
        
        return view('circles.graph', $data);
    }
    
    public function input_list($id)
    {
        $circle = Circle::find($id);
        
        $data = [
            'circle' => $circle,
        ];
        
        return view('circles.list', $data);
    }
    
}
