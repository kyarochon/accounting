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
        //
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
        $circle = new Circle;
        $circle->name       = $request->name;
        $circle->image_name = $request->image_name;
        $circle->save();
        
        return redirect('/');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
