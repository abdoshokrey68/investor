@extends('home.project.project_layout')


@section('project_content')
    <div class="col-md-12 p-0">
        <div class="card d-flex justify-content-center m-auto">
            {{-- <div class="card-header">
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-xs-2 p-0">
                        <img src="{{$project->user->profile_photo_url}}" alt="User Image" style="width: 100%; height:100%">
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-10 pt-3">
                        <a href="{{route('profile',$project->user->id)}}">
                            <h2 class="h5 bold">
                                {{$project->user->name}}
                            </h2>
                        </a>
                    </div>
                </div>
            </div> --}}
            <div class="card-body pt-0 pm-0" style="min-height: 350px">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12 p-0">
                        <img src="{{URL::asset('img/project/project.jpg')}}" alt="Project Image" style="height: 100%; width:100%">
                    </div>

                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="col-md-12">
                                <h2 class="h5 bold pt-4">
                                    {{$project->name}}
                                </h2>

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

                                <p class=" bold"> <i class="fas fa-calendar-alt"></i> {{$project->my_date}}</p>

                                @if ($project->user->status == 0)
                                    <p class="bold btn float-end text-center" style="background: #9b59b6; color:#fff">
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
                            <p >
                                <span class="bold"> @lang('site.small_overview') :</span> {{$project->des}}
                            </p>
                            @php
                                $project_tag = explode(',',$project->tags);
                            @endphp
                            <p class="bold"> @lang('site.tags') : @foreach($project_tag as $tag)<a href="">#{{$tag}} </a>@endforeach</p>
                            <br>
                            <hr>
                        </div>
                        <div class="row">
                            {{-- <div class="col-md-6">
                                <div class="col-md-12 bg-dark text-light text-center">
                                    <h5 class="h6 p-2">
                                        @lang('site.min_price_project') : {{$project->min_price}}$
                                    </h5>
                                </div>
                            </div> --}}
                            <div class="col-md-12 ">
                                <div class="col-md-12 text-dark btn btn-light text-center">
                                        <h5 class="h6 p-2 m-0 bold"> <i class="fas fa-comments mr-2 ml-2"></i> {{count($comments)}} @lang('site.proposals')</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($project->user_id != auth()->user()->id)
            @isset($project->comment_status)
                @else
                <div class="col-md-12">
                    <div class="card mt-4">
                        <div class="card-header bg-warning h5 bold"> @lang('site.new_sugg') </div>
                        <div class="card-body">
                            <form action="{{route('comment', $project->id)}}" method="post">
                                @csrf
                                <textarea class="form-control" name="comment" id="comment" cols="30" rows="10" required placeholder="@lang('site.best_candidate')">@error('comment'){{old('comment')}}@else @if($errors->any()) {{old('comment')}} @endif @enderror</textarea>
                                @error('comment')
                                    <p class="text-danger col-md-12 mt-2 bold"><i class="fas fa-times ml-2 mr-2"></i>{{$message}}</p>
                                @enderror <!-- End Of Comment Box -->

                                <select name="status" id="status" class="form-control mt-3 mb-3" required>
                                    @lang('site.your_project_plan')
                                    <option disabled @if(!old('status')) selected @endif> @lang('site.choose_plane')  </option>
                                    <option value="1" @if(old('status') == 1) selected @endif> @lang('site.request_project') </option>
                                    <option value="2" @if(old('status') == 2) selected @endif> @lang('site.will_financier')  </option>
                                    {{-- <option value="3" @if(old('status') == 3) selected @endif> @lang('site.inveset_project')  </option> --}}
                                </select>
                                @error('status')
                                    <p class="text-danger col-md-12 mt-2 bold"><i class="fas fa-times ml-2 mr-2"></i>{{$message}}</p>
                                @enderror <!-- End Of Comment Box -->
                                <button class="btn btn-primary text-light h2 bold float-end"> <i class="fas fa-paper-plane"></i> @lang('site.submit_suggestion') </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endisset
        @endif

        <div class="card mt-5">
            <div class="card-header">
                <h2 class="h4 bold">
                    @lang('site.project_suggestions')
                </h2>
            </div>
            <div class="card-body p-0">
                        <div class="col-md-12 comments-box mt-1">
                            @foreach ($comments as $comment)
                                <div class="card the-comment mt-4 mb-4 p-1" style="min-height: 200px;">
                                    <div class="row user-info mt-2">
                                        <div class="col-md-2 col-sm-2 col-xl-2">
                                            <img src="{{$comment->user->profile_photo_url}}" alt="User Image">
                                        </div>
                                        <div class="col-md-10 col-sm-10 col-xl-9 pt-1">
                                            @if ($comment->user_id == auth()->user()->id)
                                                <div class="nav-item dropdown exit {{app()->getLocale() == 'ar' ? 'float-start' :  'float-end' }}">
                                                    <a id="commentcontroller{{$comment->id}}" class="col-md-12 getnotice nav-link text-light  btn text-dark  p-0 notice-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre get-notice="{{route('get_notice')}}">
                                                        <i class="fas fa-caret-square-down fa-2x"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="commentcontroller{{$comment->id}}" >
                                                        <div class="card  box-hover p-0">
                                                            <a href="{{route('comment.edit',$project->id)}}" class="link-active btn btn-light mb-2">
                                                                <i class="fas fa-edit mr-2 ml-2"></i>
                                                                @lang('site.edit')
                                                            </a>
                                                            <a href="{{route('comment.delete',$project->id)}}" class="link-active btn btn-light mb-2">
                                                                <i class="fas fa-trash-alt mr-2 ml-2"></i>
                                                                @lang('site.delete')
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif <!-- End Of Project Controller -->
                                            <a href="{{route('profile', $comment->user->id)}}" class="text-primary">
                                                <h5 class="h5 bold">
                                                    <i class="fas fa-user"></i>
                                                    {{$comment->user->name}}
                                                </h5>
                                            </a>
                                            <p class="bold "> <i class="fas fa-calendar-alt"></i> {{$comment->date}}</p>

                                        </div>
                                    </div>
                                    <!-- End User Information Box -->
                                    <div class="col-md-12 p-2">


                                        <h6 class="h4 comment-text"> <i class="fas fa-check-square bg-success"></i> {{$comment->comment}}</h6>
                                        @if ($project->user->status == 0)
                                                <p class="bold btn col-md-3 float-end text-center" style="background: #8e44ad; color:#fff">
                                                    @lang('site.innovative')
                                                </p>
                                            @elseif($project->user->status == 1)
                                                <p class="bold btn col-md-3 float-end text-center" style="background: #16a085; color:#000">
                                                    @lang('site.investor')
                                                </p>
                                            @elseif($project->user->status == 2)
                                                <p class="bold btn col-md-3 float-end text-center" style="background: #34495e; color:#fff">
                                                    @lang('site.financier')
                                                </p>
                                            @else
                                                <p class="bold btn col-md-3 float-end text-center" style="background: #8e44ad; color:#fff">
                                                    @lang('site.innovative')
                                                </p>
                                        @endif


                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{-- <h4 class="h4 bold p-4 text-danger">
                            There are no suggestions yet
                        </h4> --}}

            </div>
        </div>
        <!-- End Comments Box -->
    </div>
@endsection
