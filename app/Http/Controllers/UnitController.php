<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res = unit::create([
            'name'         => $request -> name,
            'color_1'      => $request -> color_1,
            'color_2'      => $request -> color_2,
            'subject_id'   => $request -> subject_id,
        ]);
        if ($res) return ["operationn" => "Done"];
        else return ["operation" => "Error Occured"];

    }
       //showe (one more)
    public function delete(Unit $unit,$id){
        $res = $unit::find($id) -> delete ();
        if ($res) return ["operationn" => "Done"];
        else return ["operation" => "Error Occured"];

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit,$id)
    {

        $res =Unit::select('*')->where('subject_id', $id)->get();
        return $res;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit_name(Request $request,$id)
    {
        $unit = Unit::find($id);
        $unit -> name = $request -> name;
        $res =  $unit -> save();
        if ($res) return ["operationn" => "Done"];
        else return ["operation" => "Error Occured"];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        //
    }
}
