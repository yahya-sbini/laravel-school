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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Welcome Dear ..... Let’s start') }}</div>

                    <div class="card-body">

                        <div class="alert alert-success" role="alert">
                            <form action={{ route('home.selected') }}  method="POST">
                                @csrf
                            <select name="levels" class="form-select" aria-label="Default select example">
                                <option value="1">Class</option>
                                @foreach ($levels as $level)
                                <option value={{ $level -> id }}>{{ $level -> name }}</option>
                                @endforeach
                            </select>
                            <br>

                            <select name="semesters" class="form-select" aria-label="Default select example">
                                <option value="1">Semester</option>
                                @foreach ($semesters as $semester)
                                <option value={{ $semester -> id }}>{{ $semester -> name }}</option>
                                @endforeach
                            </select>
                            <br>


                           <center><button type="submit" class="justify-content-center btn btn-success ">Set</button></center>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <br><br><br><br><br>

        <br><br><br><br><br>
    </div>
@endsection
