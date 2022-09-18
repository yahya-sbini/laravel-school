<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
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
        $res = Lesson::create([
            'name'            => $request -> name,
            'color_1'         => $request -> color_1,
            'color_2'         => $request -> color_2,
            //REMOVED 'test_link'       => $request -> test_link,
            'unit_id'         => $request -> unit_id,
        ]);
        if ($res) return ["operationn" => "Done"];
        else return ["operation" => "Error Occured"];
    }

    public function delete(Lesson $lesson,$id){
        $res = $lesson::find($id) -> delete ();
       // $lesson -> save();
        //check here
        if ($res) return ["operationn" => "Done"];
        else return ["operation" => "Error Occured"];

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson,$id)
    {
        $res =Lesson::select('*')->where('unit_id', $id)->get();
        return $res;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit_name(Request $request,$id)
    {
        $lesson = Lesson::find($id);
        $lesson -> name = $request -> name;
        $res =  $lesson -> save();
        if ($res) return ["operationn" => "Done"];
        else return ["operation" => "Error Occured"];
    }

    public function edit_link(Request $request,$id)
    {
        $lesson = Lesson::find($id);
        $lesson -> test_link = $request -> test_link;
        $res =  $lesson -> save();
        if ($res) return ["operationn" => "Done"];
        else return ["operation" => "Error Occured"];
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        //
    }
}
