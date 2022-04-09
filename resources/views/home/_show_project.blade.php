
<div class="col-md-12">
    <a href="{{route('project.new_project')}}" class="btn btn-success col-md-12 mt-2 mb-2">
        Create New Project
        <i class="fas fa-plus mr-2 ml-2"></i>
    </a>
</div>
@foreach ($all_project as $project)
    <div class="card mt-4 mb-2">
        <div class="card-header p-0">
            <div class="row col-md-12 p-0" style="justify-content: center;">
                <div class="col-md-1 col-sm-1 col-xs-2 p-0">
                    @if (isset($project->user->profile_photo_url))
                        <img src="{{$project->user->profile_photo_url}}" alt="User Image" style="width: 100%; height:100%">
                        @else
                        <img src="{{asset('img/user/users.png')}}" alt="User Image" style="width: 100%; height:100%">
                    @endif
                </div>
                <div class="col-md-10 col-sm-10 col-xs-10 ">
                    <a href="{{route('profile',$project->user->id)}}" class="p-2">
                        <h2 class="h5 bold">
                            {{$project->user->name}}
                        </h2>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body pt-0 pm-0">
            <div class="row" >
                <div class="col-md-4 col-sm-4 col-xs-12 p-0">
                    <img src="{{URL::asset('img/project/project.jpg')}}" alt="Project Image" style="height: 100%; width:100%">
                </div>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="col-md-12 pt-3">

                        @if ($project->user_id == auth()->user()->id)
                            <div class="nav-item dropdown exit float-end">
                                <a id="projectcontroller{{$project->id}}" class="col-md-12 getnotice nav-link text-light  btn text-dark  p-0 notice-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre get-notice="{{route('get_notice')}}">
                                    <i class="fas fa-caret-square-down fa-2x"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="projectcontroller{{$project->id}}" >
                                    <div class="card  box-hover p-0">
                                        <a href="{{route('project.edit',$project->id)}}" class="link-active btn btn-light mb-2">
                                            <i class="fas fa-edit mr-2 ml-2"></i>
                                            Edit Project
                                        </a>
                                        <a href="{{route('project.delete',$project->id)}}" class="link-active btn btn-light mb-2">
                                            <i class="fas fa-trash-alt mr-2 ml-2"></i>
                                            Delete Project
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
                        {{-- <a href="{{route('project',$project->id)}}">
                            <p class=" bold">{{$project->my_date}}</p>
                        </a> --}}
                        <br>

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

                        {{-- <p class="btn btn-warning col-md-6 text-dark bold text-center mt-2 pt-2 pb-2 text-bold h6">

                        </p> --}}

                        @php
                            $project_tag = explode(',',$project->tags);
                        @endphp
                        @if ($project_tag)
                            <p class="bold"> <i class="fas fa-hashtag"></i> Tags : @foreach($project_tag as $tag)<a href="">#{{$tag}} </a>@endforeach</p>
                        @endif
                        <br>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn btn-light bold h6 col-md-12">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{$project->my_date}}
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <a href="{{route('project',$project->id)}}" class="btn btn-light bold h6 col-md-12">
                                    <i class="fas fa-comments mr-2 ml-2"></i>
                                    @php
                                        echo count($project->comments)
                                    @endphp
                                    Proposals
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
{{-- {{$all_project->links()}} --}}
