<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    @extends('layouts.app')

    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Dashboard') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <center>{{ __('Pasona') }}</center>
                        </div>
                    </div>
                </div>
            </div>

            <br><br><br><br><br>

            <div class="row justify-content-center">
                <div class="col-md-6">
                    @if (session('operation'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('operation') }}</strong>
                        </div>
                </div>
                @endif
            </div>

            <br><br><br><br><br>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            {{ __('Units') }}
                            <div>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-info position-absolute top-0 end-0" data-toggle="modal"
                                    data-target="#add_unit">
                                    Add new
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="add_unit" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add new unit</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action={{ route('add.unit') }} method="POST">
                                                @csrf
                                                <div class="modal-body">


                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Unit Name</label>
                                                        <input type="text" name="adding_unit_name" class="form-control"
                                                            id="exampleInputEmail1" aria-describedby=""
                                                            placeholder="Unit Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <!--<label for="exampleInputPassword1">whatever</label>
                                                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                                                        placeholder="whatever">-->
                                                        <select name="subjects" class="form-select"
                                                            aria-label="Default select example">
                                                            <option selected>Subjects</option>
                                                            @foreach ($all_subjects as $subject)
                                                                <option value={{ $subject->id }}>
                                                                    {{ $subject->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-body">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Number</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>

                                <thead>
                                    @php($i = 1)
                                    @foreach ($joint_units as $unit)
                                        <tr>
                                            <th scope="col">{{ $i++ }}</th>
                                            <th scope="col">{{ $unit->name }}</th>
                                            <th scope="col">{{ $unit->subject_name }}</th>
                                            <th scope="col">

                                                <div>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target={{ '#exampleModalEdit' . $unit->id }}>
                                                        Edit
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id={{ 'exampleModalEdit' . $unit->id }}
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Add
                                                                        new unit</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action={{ route('edit.unit') }} method="POST">
                                                                    @csrf
                                                                    <div class="modal-body">


                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Unit
                                                                                Name</label>
                                                                            <input type="text" name="editting_unit_name"
                                                                                class="form-control"
                                                                                id="exampleInputEmail1" aria-describedby=""
                                                                                placeholder="Unit Name"
                                                                                value={{ $unit->name }}>

                                                                            <input type="hidden" value={{ $unit->id }}
                                                                                name="selected_unit_id">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <select name="subjects" class="form-select"
                                                                                aria-label="Default select example">




                                                                                <option value={{ $unit->subject_id }}>
                                                                                    Subjec</option>

                                                                                @foreach ($all_subjects as $subject)
                                                                                    <option value={{ $subject->id }}>
                                                                                        {{ $subject->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>


                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Save</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </th>
                                            <th scope="col"><a
                                                    href="{{ url('home/operations/unit/delete/' . $unit->id) }}"
                                                    class="btn btn-danger" role="button" aria-pressed="true">Delete</a></th>
                                        </tr>
                                    @endforeach
                                    {{ $joint_units->links() }}
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <br><br><br><br><br>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Lessons') }}</div>
                        <div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info position-absolute top-0 end-0" data-toggle="modal"
                                data-target="#add_lesson">
                                Add new
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="add_lesson" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add new unit</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action={{ route('add.lesson') }} method="POST">
                                            @csrf
                                            <div class="modal-body">


                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Lesson Name</label>
                                                    <input type="text" name="adding_lesson_name" class="form-control"
                                                        id="exampleInputEmail1" aria-describedby=""
                                                        placeholder="Lesson Name">
                                                </div>
                                                <div class="form-group">
                                                    <!--<label for="exampleInputPassword1">whatever</label>
                                                                <input type="text" class="form-control" id="exampleInputPassword1"
                                                                    placeholder="whatever">-->
                                                    <select name="units" class="form-select"
                                                        aria-label="Default select example">
                                                        <option selected>Units</option>
                                                        @foreach ($all_units as $unit)
                                                            <option value={{ $unit->id }}>
                                                                {{ $unit->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <table class="table">
                                <thead>


                                    <tr>
                                        <th scope="col">Number</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>


                                <thead>
                                    @php($i = 1)
                                    @foreach ($joint_lessons as $lesson)
                                        <tr>
                                            <th scope="col">{{ $i++ }}</th>
                                            <th scope="col">{{ $lesson->name }}</th>
                                            <th scope="col">{{ $lesson->unit_name }}</th>
                                            <th scope="col">

                                                <div>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target={{ '#edit_lesson' . $lesson->id }}>
                                                        Edit
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id={{ 'edit_lesson' . $lesson->id }}
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                        this lesson</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action={{ route('edit.lesson') }} method="POST">
                                                                    @csrf
                                                                    <div class="modal-body">


                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Lesson
                                                                                Name</label>
                                                                            <input type="text" name="editting_lesson_name"
                                                                                class="form-control"
                                                                                id="exampleInputEmail1" aria-describedby=""
                                                                                placeholder="Unit Name"
                                                                                value={{ $lesson->name }}>

                                                                            <input type="hidden" value={{ $lesson->id }}
                                                                                name="selected_lesson_id">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <select name="units" class="form-select"
                                                                                aria-label="Default select example">




                                                                                <option value={{ $lesson->unit_id }}>
                                                                                    Subjec</option>

                                                                                @foreach ($all_units as $unit)
                                                                                    <option value={{ $unit->id }}>
                                                                                        {{ $unit->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>


                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Save</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </th>
                                            <th scope="col"><a
                                                    href="{{ url('home/operations/lesson/delete/' . $lesson->id) }}"
                                                    class="btn btn-danger" role="button" aria-pressed="true">Delete</a></th>
                                        </tr>
                                    @endforeach
                                    {{ $joint_lessons->links() }}
                                </thead>
                            </table>

                        </div>
                    </div>
                </div>

            </div>

            <br><br><br><br><br> <br><br><br><br><br>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Tests') }}</div>


                        <div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info position-absolute top-0 end-0" data-toggle="modal"
                                data-target="#add_test">
                                Add new
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="add_test" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add new test</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action={{ route('add.test') }} method="POST">
                                            @csrf
                                            <div class="modal-body">


                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Test Link</label>
                                                    <input type="text" name="adding_test_name" class="form-control"
                                                        id="exampleInputEmail1" aria-describedby="" placeholder="Test Link">
                                                </div>
                                                <div class="form-group">
                                                    <!--<label for="exampleInputPassword1">whatever</label>
                                                                <input type="text" class="form-control" id="exampleInputPassword1"
                                                                    placeholder="whatever">-->
                                                    <select name="lessons" class="form-select"
                                                        aria-label="Default select example">
                                                        <option selected>Lesson</option>
                                                        @foreach ($all_lessons as $lesson)
                                                            <option value={{ $lesson->id }}>
                                                                {{ $lesson->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <table class="table">

                                <thead>
                                    <tr>
                                        <th scope="col">Number</th>

                                        <th scope="col">Test name</th>
                                        <th scope="col">Lesson</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>

                                <thead>
                                    @php($i = 1)
                                    @foreach ($join_tests as $test)
                                        <tr>
                                            <th scope="col">{{ $i++ }}</th>

                                            <th scope="col" onclick="{{ url('googel.com') }}.com">
                                                {{ $test->test_label }}</th>
                                            <th scope="col">{{ $test->lesson_name }}</th>
                                            <th scope="col">

                                                <div>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target={{ '#edit_test' . $test->id }}>
                                                        Edit
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id={{ 'edit_test' . $test->id }}
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                        this test</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action={{ route('edit.test') }} method="POST">
                                                                    @csrf
                                                                    <div class="modal-body">


                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Test
                                                                                Link</label>
                                                                            <input type="text" name="editting_test_link"
                                                                                class="form-control"
                                                                                id="exampleInputEmail1" aria-describedby=""
                                                                                placeholder="Test link"
                                                                                value={{ $test->test_link }}>



                                                                            <input type="hidden" value={{ $test->id }}
                                                                                name="selected_test_id">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <select name="lessons" class="form-select"
                                                                                aria-label="Default select example">




                                                                                <option value={{ $test->lesson_id }}>
                                                                                    Lesson</option>

                                                                                @foreach ($all_lessons as $lesson)
                                                                                    <option value={{ $lesson->id }}>
                                                                                        {{ $lesson->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>


                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Save</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </th>
                                            <th scope="col"><a
                                                    href="{{ url('home/operations/test/delete/' . $test->id) }}"
                                                    class="btn btn-danger" role="button" aria-pressed="true">Delete</a>
                                            </th>
                                        </tr>
                                    @endforeach
                                    {{ $join_tests->links() }}
                                </thead>
                            </table>

                        </div>
                    </div>
                </div>

            </div>

            <br><br><br><br><br>

        </div>
    @endsection

    <div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
                integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
    </div>
</body>

</html>
