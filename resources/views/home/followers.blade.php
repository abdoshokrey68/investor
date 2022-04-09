@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-3 p-0">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="col-md-12">
                    <a href="" class="btn btn-success col-md-12 mt-2 mb-2">
                        Create New Project
                        <i class="fas fa-plus mr-2 ml-2"></i>
                    </a>
                </div>
                {{-- @foreach ($followers_project as $project)
                    @if ($project->user)
                        <div class="card mt-4 mb-2">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-1 col-sm-1 col-xs-2 p-0">
                                        <img src="{{$project->user->profile_photo_url}}" alt="User Image" style="width: 100%; height:100%">
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <a href="{{route('project',$project->id)}}">
                                            <h2 class="h5 bold">
                                                {{$project->user->name}}
                                            </h2>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0 pm-0">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-12 p-0">
                                        <img src="{{URL::asset('img/project/project.jpg')}}" alt="Project Image" style="height: 100%; width:100%">
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <div class="col-md-12">
                                            <a href="{{route('project',$project->id)}}">
                                                <h2 class="h5 bold">
                                                    {{$project->projects->name}}
                                                </h2>
                                            </a>
                                            <a href="{{route('project',$project->id)}}">
                                                <p class=" bold">{{$project->date}}</p>
                                            </a>

                                            @if ($project->user->status == 0)
                                                <p class="bold btn float-end text-center" style="background: #8e44ad; color:#fff">
                                                    Innovative
                                                </p>
                                            @elseif($project->user->status == 1)
                                                <p class="bold btn float-end text-center" style="background: #16a085; color:#000">
                                                    Investor
                                                </p>

                                            @elseif($project->user->status == 2)
                                                <p class="bold btn float-end text-center" style="background: #34495e; color:#fff">
                                                Financier
                                                </p>

                                            @elseif($project->user->status == 3)
                                                <p class="bold btn btn-danger float-end text-center">
                                                    Admin
                                                </p>
                                            @endif

                                            <br>
                                            <br>

                                            <p style="line-height: 35px">
                                                <span class="bold">Descreption :</span> {{$project->des}}
                                            </p>
                                            @php
                                                $project_tag = explode(',',$project->tags);
                                            @endphp
                                            <p class="bold">Tags : @foreach($project_tag as $tag)<a href="">#{{$tag}} </a>@endforeach</p>
                                            <br>
                                            <hr>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="col-md-12 bg-dark text-light text-center">
                                                        <h5 class="h6 p-2">
                                                            Min Price : {{$project->min_price}}$
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <div class="col-md-12 bg-dark text-light text-center">
                                                        <a href="">
                                                            <h5 class="h6 p-2">Proposals</h5>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach --}}
            </div>
        </div>
</div>
@endsection

                {{-- @foreach ($followers_project as $followers)
                    @if ($followers->user)
                    <div class="card mt-4 mb-2">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-1 col-sm-1 col-xs-2 p-0">
                                    <img src="{{$followers->user->profile_photo_url}}" alt="User Image" style="width: 100%; height:100%">
                                </div>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    <a href="{{route('project',$followers->projects->id)}}">
                                        <h2 class="h5 bold">
                                            {{$followers->user->name}}
                                        </h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0 pm-0">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-12 p-0">
                                    <img src="{{URL::asset('img/project/project.jpg')}}" alt="Project Image" style="height: 100%; width:100%">
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <div class="col-md-12">
                                        <a href="{{route('project',$followers->projects->id)}}">
                                            <h2 class="h5 bold">
                                                {{$followers->projects->name}}
                                            </h2>
                                        </a>
                                        <a href="{{route('project',$followers->projects->id)}}">
                                            <p class=" bold">{{$followers->projects->date}}</p>
                                        </a>

                                        @if ($followers->user->status == 0)
                                            <p class="bold btn float-end text-center" style="background: #8e44ad; color:#fff">
                                                Innovative
                                            </p>
                                        @elseif($followers->user->status == 1)
                                            <p class="bold btn float-end text-center" style="background: #16a085; color:#000">
                                                Investor
                                            </p>

                                        @elseif($followers->user->status == 2)
                                            <p class="bold btn float-end text-center" style="background: #34495e; color:#fff">
                                            Financier
                                            </p>

                                        @elseif($followers->user->status == 3)
                                            <p class="bold btn btn-danger float-end text-center">
                                                Admin
                                            </p>
                                        @endif

                                        <br>
                                        <br>

                                        <p style="line-height: 35px">
                                            <span class="bold">Descreption :</span> {{$followers->projects->des}}
                                        </p>

                                        @php
                                            $project_tag = explode(',',$followers->projects->tags);
                                        @endphp
                                        <p class="bold">Tags : @foreach($project_tag as $tag)<a href="">#{{$tag}} </a>@endforeach</p>
                                        <br>
                                        <hr>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-md-12 bg-dark text-light text-center">
                                                    <h5 class="h6 p-2">
                                                        Min Price : {{$followers->projects->min_price}}$
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div class="col-md-12 bg-dark text-light text-center">
                                                    <a href="">
                                                        <h5 class="h6 p-2">Proposals</h5>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach --}}
