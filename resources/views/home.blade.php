@extends('layouts.app')

@section('content')
<div class="container">
        <home-component locale="{{app()->getLocale()}}" newproject-route="{{route('project.new_project')}}" />
        {{-- <div class="row">
            <div class="col-md-3 p-0">
                <div class="card p-0">
                    <div class="card-body">
                        <form action="" class="col-md-12">
                            <input type="text" class="form-control col-md-12" name="search" id="search" placeholder="Search ..">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                @include('home.show_project')
            </div>
        </div> --}}
</div>
@endsection
