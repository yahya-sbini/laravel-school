<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Unit;
use App\Models\ClassRoom;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\Test;

class HomeController extends Controller
{
    public function lesson_add(Request $request){
         $res = Lesson::create([
            'name' => $request -> input('adding_lesson_name'),
            'unit_id' => $request -> units,
            'color_1' => "orange",
            'color_2' =>  "orange",
        ]);
        return redirect() -> back() -> with('operation',' we added the reocrd successfully !');
    }


    public function lesson_edit(Request $request){

        $res  = Lesson::find($request -> input('selected_lesson_id')) -> update([
            'name' => $request -> input('editting_lesson_name'),
            'unit_id' => $request -> units,
            'color_1' => "orange",
            'color_2' =>  "orange",
        ]);

        return redirect() -> back() -> with('operation',' we editted the reocrd successfully !');
    }

    public function lesson_delete(Request $request){
         $res = Lesson::find($request -> id) ->delete();
        return redirect() -> back()->with('operation','we deleted the reocrd successfully !');

    }





    public function test_add(Request $request){
         $res = Test::create([
            'test_link' => $request -> input('adding_test_name'),
            'lesson_id' => $request -> lessons,
            'color_1' => "orange",
            'color_2' =>  "orange",
            'test_label' => "afv",
        ]);
        return redirect() -> back() -> with('operation',' we added the reocrd successfully !');
    }


    public function test_edit(Request $request){

         $res  = Test::find($request -> input('selected_test_id')) -> update([
            'test_link' => $request -> input('editting_test_link'),
            'lesson_id' => $request -> lessons,
            'color_1' => "orange",
            'color_2' =>  "orange",
            'test_label' => "afv",
        ]);

        return redirect() -> back() -> with('operation',' we editted the reocrd successfully !');
    }

    public function test_delete(Request $request){

        $res = Test::find($request -> id) ->delete();
        return redirect() -> back()->with('operation','we deleted the reocrd successfully !');

    }



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show_options()
    {
        $semesters =  Chapter::select('name', 'id')->paginate(5);
        $levels = ClassRoom::select('id', 'name')->paginate(12);
        return view('home', compact('semesters', 'levels'));
    }


    public function get_selected(Request $request)
    {
        $selected_chapter = Chapter::select('id')->where([
            ['class_room_id', $request->levels],
            ['name', $request->semesters]
        ])->first();

        $joint_units = Unit::select('units.*', 'subjects.name as subject_name')
        ->join('subjects', 'subjects.id', '=', 'units.subject_id')
        ->orderBy('subjects.name')
        ->paginate(6);

        $all_subjects = Subject::select('name', 'id')->get();


        $joint_lessons = Lesson::select('lessons.*', 'units.name as unit_name')
        ->join('units', 'units.id', '=', 'lessons.unit_id')
        ->orderBy('units.name')
        ->paginate(6);

        $all_units = Unit::select('name', 'id')->get();


        $join_tests = Test::select('tests.*', 'lessons.name as lesson_name')
        ->join('lessons', 'lessons.id', '=', 'tests.lesson_id')
        ->orderBy('lessons.name')
        ->paginate(6);

        $all_lessons = Lesson::select('name', 'id')->get();



        return view('info', compact('joint_units','all_subjects','joint_lessons','all_units','join_tests','all_lessons'));
    }

    public function unit_add(Request $request){
        $res = Unit::create([
            'name' => $request -> input('adding_unit_name'),
            'subject_id' => $request -> subjects,
            'color_1' => "orange",
            'color_2' =>  "orange",
        ]);
        return redirect() -> back() -> with('operation',' we added the reocrd successfully !');
    }


    public function unit_edit(Request $request){

        $res  = Unit::find($request -> input('selected_unit_id')) -> update([
            'name' => $request -> input('editting_unit_name'),
            'subject_id' => $request -> subjects,
        ]);

        return redirect() -> back() -> with('operation',' we editted the reocrd successfully !');
    }

    public function unit_delete(Request $request){
        $res = Unit::find($request -> id) ->delete();
        return redirect() -> back()->with('operation','we deleted the reocrd successfully !');

    }




























    public function get_lessons(Request $request)
    {
        //remove repeates in unit array & use only its id
        $sub_test = array(1, 2, 3);
        $all_lessons = Lesson::select('id', 'name', 'unit_id')->whereIn('unit_id', $sub_test)->get();
        echo $all_lessons;
    }

    public function get_tests(Request $request)
    {
        $sub_test = array(1, 2, 3);
        $all_test = Test::select('id', 'test_link', 'lesson_id')->whereIn('lesson_id', $sub_test)->get();
        echo $all_test;
    }

    public function test(Request $request)
    {
        /*$sub_test= array(1,2,3);
        $all_lessons = Lesson::select('id','name','unit_id')->whereIn('unit_id',$sub_test)->get();
        echo $all_lessons;*/
        //echo $abc;

    }
}
