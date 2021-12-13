<?php

namespace App\Http\Controllers;

use App\Imports\LessonImport;
use App\Models\Chapter;
use App\Models\ClassRoom;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\Test;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Facades\Excel;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query  = Lesson::query();
        $query->with('unit', 'classRoom', 'subject', 'chapter');
        if ($request->has('class_room_id')) {
            $opt = $request->input('class_room_id');
            $query->whereHas('classRoom',  function($q) use ($opt) {
                $q->where('class_room_id', '=', $opt);
            });
        }

        if ($request->has('chapter_id')) {
            $opt = $request->input('chapter_id');
            $query->whereHas('chapter',  function($q) use ($opt) {
                $q->where('chapter_id', '=', $opt);
            });
        }

        if ($request->has('subject_id')) {
            $opt = $request->input('subject_id');
            $query->whereHas('subject',  function($q) use ($opt) {
                $q->where('subject_id', '=', $opt);
            });
        }

        if ($request->has('unit_id')) {
            $opt = $request->input('unit_id');
            $query->whereHas('unit',  function($q) use ($opt) {
                $q->where('unit_id', '=', $opt);
            });
        }

        if ($request->has('lesson_id')) {
            $query->whereId($request->input('lesson_id'));
        }

        return $this->response($query->get());
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        //
    }

    public function import()
    {
        $type = 'a';
        $collection = Excel::toArray(new LessonImport(), public_path('test.xlsx'));
        $collection = $collection[0];
        for ($i = 1; $i < count($collection); $i++) {

            $avilableClassRoom = ClassRoom::whereName($collection[$i][0])->first();
            if (!$avilableClassRoom && $collection[$i][0] != '') {
                ClassRoom::create([
                    'name' => $collection[$i][0],
                    'color' => $collection[$i][7]
                ]);
            }

            $avilableChapter = Chapter::whereName($collection[$i][1])->first();
            if (!$avilableChapter && $collection[$i][1] != '') {
                Chapter::create([
                    'name' => $collection[$i][1],
                    'color' => $collection[$i][7]
                ]);
            }

            $avilableSubject = Subject::whereName($collection[$i][2])->first();
            if (!$avilableSubject && $collection[$i][2] != '') {
                Subject::create([
                    'name' => $collection[$i][2],
                    'color' => $collection[$i][7]
                ]);
            }

            $avilableUnit = Unit::whereName($collection[$i][3])->first();
            if (!$avilableUnit && $collection[$i][3] != '') {
                Unit::create([
                    'name' => $collection[$i][3],
                    'color' => $collection[$i][7]
                ]);
            }
        }
        for ($i = 1; $i < count($collection); $i++) {
            $avilableClassRoom = ClassRoom::whereName($collection[$i][0])->first();
            $avilableChapter = Chapter::whereName($collection[$i][1])->first();
            $avilableSubject = Subject::whereName($collection[$i][2])->first();
            $avilableUnit = Unit::whereName($collection[$i][3])->first();
            $availableLesson = Lesson::whereName($collection[$i][4])->first();

            if (!$availableLesson && $collection[$i][6] != '') {
                Lesson::create([
                    'class_room_id' => $avilableClassRoom->id,
                    'chapter_id' => $avilableChapter->id,
                    'subject_id' => $avilableSubject->id,
                    'unit_id' => $avilableUnit->id,
                    'color' => $collection[$i][7],
                    'name' => $collection[$i][4],
                    'tests' => [$collection[$i][6]],
                ]);
            } else if ($collection[$i][6] != '') {
                $tes = (array)$availableLesson->tests;
                array_push($tes, $collection[$i][6]);
                $availableLesson->tests = $tes;
                $availableLesson->save();
            }
        }
        return "done";
    }
}
