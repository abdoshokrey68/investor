@extends('layouts.app')

@section('content')

<div class="container profile-information">
    <div class="row">
        <div class="col-md-4 p-0">
            <div class="card">
                <div class="col-md-12 justify-content-center">
                    @if (isset($user->profile_photo_url))
                        <img src="{{$user->profile_photo_url}}" alt="User Image" class="image-res mt-5">
                        @else
                        <img src="{{asset('img/user/users.png')}}" alt="User Image" class="image-res mt-5">
                    @endif
                    <h3 class="h3 bold text-center mt-3">
                        <i class="fas fa-user mr-2 ml-2"></i>{{$user->name}}
                        @if (auth()->user()->id != $user->id)
                            @php
                                $user_id = auth()->user()->id;
                                $friend_id = $user->id;
                                $friend_status = DB::select("SELECT * FROM friends where `user_id` = $user_id AND `friend_id` = $friend_id LIMIT 1");
                            @endphp
                            @if(!$friend_status)
                                <a href="{{route('add_friend',$user->id)}}">
                                    <i class="fas fa-user-plus btn btn-secondary text-light pt-2 pb-2"></i>
                                    {{-- <i class="fas fa-user-plus btn btn-secondary text-light pt-2 pb-2" id="add-new-friend" data-info="{{$user->id}}" data-url="{{route('add_friend')}}"></i> --}}
                                </a>
                            @else
                                @php
                                    $user_id = auth()->user()->id;
                                    $friend_id = $user->id;
                                    $test2 = DB::select("SELECT * FROM friends where `user_id` = $user_id AND `friend_id` = $friend_id AND `status` = 0 LIMIT 1");
                                @endphp
                                @if ($test2)
                                    <a href="{{route('remove_friend',$user->id)}}">
                                        <i class="fas fa-user-minus btn btn-secondary text-light pt-2 pb-2"></i>
                                    </a>
                                        <p class="text-success h6 bold p-2">
                                        @lang('site.request_sent')
                                    </p>
                                @else
                                    <a href="{{route('remove_friend',$user->id)}}">
                                        <i class="fas fa-user-check btn btn-secondary text-light pt-2 pb-2"></i>
                                    </a>
                                    <p class="text-success h6 bold p-2">
                                        @lang('site.really_friends')
                                    </p>
                                @endif
                            @endif
                        @endif
                    </h3>
                    @if ($user->email)
                        <p class="h6 text-center bold"><i class="fas fa-paper-plane mr-2 ml-2"></i>{{$user->email}}</p>
                    @endif

                    @if ($user->id == auth()->user()->id)
                        <div class="col-md-12">
                            <a href="{{route('profile.edit',auth()->user()->id)}}" class="btn btn-primary float-end mt-3">
                                <i class="fas fa-user-edit mr-2"></i>
                                @lang('site.edit_profile')
                            </a>
                        </div>
                    @endif

                    @if ($user->status == 0)
                            <p class="bold col-md-12 p-3 mt-4 float-end text-center" style="background: #9b59b6; color:#fff">
                                @lang('site.innovative')
                            </p>
                        @elseif($user->status == 1)
                            <p class="bold col-md-12 p-3 mt-4 float-end text-center" style="background: #16a085; color:#000">
                                @lang('site.investor')
                            </p>
                        @elseif($user->status == 2)
                            <p class="bold col-md-12 p-3 mt-4 float-end text-center" style="background: #34495e; color:#fff">
                            @lang('site.financier')
                            </p>
                        @else
                            <p class="bold col-md-12 p-3 mt-4 float-end text-center" style="background: #9b59b6; color:#fff">
                                @lang('site.innovative')
                            </p>
                        @endif

                    <div class="clearfix"></div>

                    <div class="all-projects">
                        <p class="h4 p-2 mt-3 bold">
                            <i class="fas fa-lightbulb mt-2 ml-2"></i> @lang('site.all_projects') : {{$user->projects->count()}}
                        </p>

                        @if (auth()->user()->id == $user->id )
                            <p class="coins-box col-md-12 bg-dark text-warning bold h6 p-3 text-center">
                                @lang('site.your_coins') : {{$user->coins}} <i class="fas fa-coins"></i>
                            </p>
                        @endif

                        <div class="rating-box col-md-12 bg-dark text-warning bold h6 p-3 text-center">
                            <span class=""><i class="fas fa-smile mr-2 ml-2"></i> @lang('site.ratings') :</span>
                            @for ($i = 1; $i <= $user->rating; $i++)
                                <i class="fas fa-star text-warning"></i>
                            @endfor
                            @for ($i = 1; $i <= (5 - $user->rating); $i++)
                                <i class="fas fa-star text-secondary"></i>
                            @endfor
                        </div>

                        @if ($user->bio)
                            <b class="h5 line-height "> <span class="bold"> @lang('site.bio') : </span> {{$user->bio}} </b>
                        @endif

                        @if ($user->country)
                            <p class="h6 bold"> <i class="fas fa-globe-asia"></i> @lang('site.address') : {{$user->country}}</p>
                        @endif


                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            @yield('profileContent')
        </div>
    </div>
</div>

@endsection
