@extends('home.profile.profile_layout')

@section('profileContent')
<div class="col-md-12 p-0">
    <button class="text-center btn btn-success h4 bold p-2 col-md-12"> @lang('site.new_project') </button>
    @foreach ($projects as $project)
        <div class="card mb-4">
            {{-- <div class="card-header">
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-xs-2 p-0">
                        <img src="{{$project->user->profile_photo_url}}" alt="User Image" style="width: 100%; height:100%">
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-10 pt-3">
                        <a href="{{route('project',$project->id)}}">
                            <h2 class="h5 bold">
                                {{$project->user->name}}
                            </h2>
                        </a>
                    </div>
                </div>
            </div> --}}
            <div class="card-body pt-0 pm-0 card-header">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12 p-0">
                        <img src="{{URL::asset('img/project/project.jpg')}}" alt="Project Image" style="height: 100%; width:100%">
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="col-md-12">
                            <div class="col-md-12 p-3">
                                @if ($project->user_id == auth()->user()->id)
                                    <div class="nav-item dropdown exit @if(App()->getLocale() == 'ar') float-start @else float-end @endif">
                                        <a id="projectcontroller{{$project->id}}" class="col-md-12 getnotice nav-link text-light  btn text-dark  p-0 notice-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre get-notice="{{route('get_notice')}}">
                                            <i class="fas fa-caret-square-down fa-2x"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="projectcontroller{{$project->id}}" >
                                            <div class="card  box-hover p-0">
                                                <a href="{{route('project.edit',$project->id)}}" class="link-active btn btn-light mb-2">
                                                    <i class="fas fa-edit mr-2 ml-2"></i>
                                                    @lang('site.edit_project')
                                                </a>
                                                <a href="{{route('project.delete',$project->id)}}" class="link-active btn btn-light mb-2">
                                                    <i class="fas fa-trash-alt mr-2 ml-2"></i>
                                                    @lang('site.delete_project')
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif <!-- End Of Project Controller -->

                                <a href="{{route('project',$project->id)}}">
                                    <h2 class="h5 bold">
                                        {{$project->name}}
                                    </h2>
                                </a>
                                <hr>
                            </div>

                            {{-- @if ($project->user->status == 0)
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
                            <br> --}}

                            <p style="line-height: 35px">
                                <span class="bold"> @lang('site.des') :</span> {{$project->des}}
                            </p>

                            {{-- <p class="btn btn-warning col-md-6 text-dark bold text-center mt-2 pt-2 pb-2 text-bold h6">

                            </p> --}}

                            @if ($project->min_price)
                                <div class="text-center">
                                    <h6 class="h6 bold ">
                                        @lang('site.min_price') : {{$project->min_price}}$
                                    </h6>
                                </div>
                            @endif

                            @php
                                $project_tag = explode(',',$project->tags);
                            @endphp
                            <p class="bold"> @lang('site.tags') : @foreach($project_tag as $tag)<a href="">#{{$tag}} </a>@endforeach</p>
                            <br>
                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn btn-light bold h6 col-md-12">
                                        <i class="fas fa-calendar-alt mr-2 ml-2"></i>
                                        {{$project->my_date}}
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="btn btn-light bold h6 col-md-12 ">
                                        <a href="{{route('project',$project->id)}}" class="text-dark">
                                            <i class="fas fa-comments mr-2 ml-2"></i>
                                            {{count($user->comments)}}
                                            @lang('site.proposals')
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @empty($project)
        @if (auth()->user()->id == $user->id)
            <div class="col-md-12 pt-5">
                <a href="{{route('home')}}">
                    <h3 class="h3 bold text-center text-danger text-capitalize ">
                        You do not have any projects
                    </h3>
                </a>
                <p class="bold text-center mt-3 text-capitalize">
                    If you do not have a project or investment plan, search for project ideas to invest in
                </p>
            </div>
        @else
            <div class="col-md-12 pt-5">
                <a href="{{route('home')}}">
                    <h3 class="h3 bold text-center text-danger text-capitalize ">
                        This account does not have any projects
                    </h3>
                </a>
            </div>
        @endif

    @endempty
</div>
@endsection
