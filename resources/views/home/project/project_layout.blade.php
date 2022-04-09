@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <div class="row">
            <div class="col-md-4 p-0">
                <div class="card">
                    <img src="{{URL::asset('img/project/project1.png')}}" alt="Create Project">
                </div>
            </div> --}}
            <div class="offset-md-2 col-md-8 p-0">
                @yield('project_content')
            </div>
        {{-- </div> --}}
    </div>
@endsection
