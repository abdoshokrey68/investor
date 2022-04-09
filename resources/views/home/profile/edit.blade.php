@extends('home.profile.profile_layout')

@section('profileContent')
    <div class="container p-0">
        <div class="col-md-12 p-0">
            <div class = "panel panel-dark ">
                <div class = "panel-heading btn-dark  text-light  col-md-12">
                    <h3 class = "panel-title p-3"> <i class="fas fa-user-edit"></i> @lang('site.edit_info') </h3>
                </div>
                <div class = "panel-body p-2 bold">
                    <form action="{{route('profile.update',$user->id)}}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12 image-auto">
                            @empty($user->image)
                                <img src="{{asset('img/user/users.png')}}" alt="User Image" class="image-res mt-5" style="height: 20vh; width: 20vh">
                                @else
                                <img src="{{URL::asset("img/users/$user->image")}}" alt="User Image" class="image-res mt-5" style="height: 20vh; width: 20vh">
                            @endempty
                            <div class="clear"></div>
                        </div>

                        @if (session()->has('success'))
                            <div class="col-md-12 h5 bold alert alert-light">
                                <i class="fas fa-check-circle text-success" style="font-size:1.5em"></i>
                                {{session()->get('success')}}
                            </div>
                        @endif

                        <div class="col-md-12">
                            <label for="image"> <i class="fas fa-image"></i> @lang('site.select_image')</label>
                            <input required type="file" name="image" id="image" class="form-control">
                            @error('image')
                                <p class="text-danger col-md-12 mt-2 bold"><i class="fas fa-times ml-2 mr-2"></i>{{$message}}</p>
                            @enderror
                        </div> <!-- End Of Image Box -->

                        <div class="col-md-12">
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label for="name">
                                        @lang('site.full_name')
                                    </label>
                                    <input required type="text" name="name" id="name" class="form-control  @error('name') is-invalid  @enderror" placeholder="Full Name ..."
                                    value="@if($errors->any()){{old('name')}}@else{{$user->name}}@endif">
                                </div>
                                @error('name')
                                    <p class="text-danger col-md-12 mt-2 bold"><i class="fas fa-times ml-2 mr-2"></i>{{$message}}</p>
                                @enderror
                            </div>
                        </div> <!-- End Of Full Name Box -->

                        <div class="col-md-12 mt-3">
                            <label for="bio">
                                <i class="fas fa-info-circle"></i>
                                @lang('site.bio')
                            </label>
                            <textarea name="bio" id="bio" cols="30" rows="10" class="form-control  @error('bio') is-invalid  @enderror" placeholder="About you ...">@if($errors->any()){{old('bio')}}@else{{$user->bio}}@endif</textarea>
                            @error('bio')
                                <p class="text-danger col-md-12 mt-2 bold"><i class="fas fa-times ml-2 mr-2"></i>{{$message}}</p>
                            @enderror
                        </div> <!-- End Of BIO Box -->

                        <div class="col-md-12 mt-3">
                            <label for="status">
                                <i class="fas fa-user-md"></i>
                                @lang('site.status')
                            </label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid  @enderror" required>
                                <option disabled selected> @lang('site.choose_interests') </option>
                                <option value="0" @if ($user->status == 0) selected @endif > @lang('site.innovative') </option>
                                <option value="1" @if ($user->status == 1) selected @endif> @lang('site.investor') </option>
                                <option value="2" @if ($user->status == 2) selected @endif> @lang('site.financier') </option>
                            </select>
                            @error('status')
                                <p class="text-danger col-md-12 mt-2 bold"><i class="fas fa-times ml-2 mr-2"></i>{{$message}}</p>
                            @enderror
                        </div> <!-- End Of Status Box -->

                        <div class="col-md-12 mt-3">
                            <label for="address">
                                <i class="fas fa-map-marker-alt"></i>
                                @lang('site.address')
                            </label>
                                <div>
                                    <country-component countrys="{{$countrys}}" old_value="@if($errors->any()){{old('country')}}@else{{$user->country}}@endif" />
                                </div>
                                <div class="clear"></div>
                            @error('country')
                                <p class="text-danger col-md-12 mt-2 bold"><i class="fas fa-times ml-2 mr-2"></i>{{$message}}</p>
                            @enderror
                        </div> <!-- End Of Address Box -->

                        {{-- <div class="col-md-12 mt-3">
                            <label for="address">
                                <i class="fas fa-map-marker-alt"></i>
                                @lang('site.address')
                            </label>
                            <input required type="address" name="country" id="address" class="form-control  @error('country') is-invalid  @enderror" placeholder="@lang('site.address')"
                            value="@if($errors->any()){{old('country')}}@else{{$user->country}}@endif">
                            @error('country')
                                <p class="text-danger col-md-12 mt-2 bold"><i class="fas fa-times ml-2 mr-2"></i>{{$message}}</p>
                            @enderror
                        </div> <!-- End Of Address Box --> --}}

                        <div class="col-md-12 mt-3">
                            <label for="email">
                                <i class="fas fa-envelope-open-text"></i>
                                @lang('site.email')
                            </label>
                            <input required type="email" name="email" id="email" class="form-control @error('email') is-invalid  @enderror " placeholder=" @lang('site.email') ... "
                            value="@if($errors->any()){{old('email')}}@else{{$user->email}}@endif">
                            @error('email')
                                <p class="text-danger col-md-12 mt-2 bold"><i class="fas fa-times ml-2 mr-2"></i>{{$message}}</p>
                            @enderror
                        </div> <!-- End Of Email Box -->

                        <div class="col-md-12 mt-3">
                            <label for="phone">
                                <i class="fas fa-mobile-alt"></i>
                                @lang('site.phone')
                            </label>
                            <input required type="text" name="phone" id="phone" class="form-control  @error('phone') is-invalid  @enderror" placeholder=" @lang('site.phone') ... "
                            value="@if($errors->any()){{old('phone')}}@else{{$user->phone}}@endif">
                            @error('phone')
                                <p class="text-danger col-md-12 mt-2 bold"><i class="fas fa-times ml-2 mr-2"></i>{{$message}}</p>
                            @enderror
                        </div> <!-- End Of Phone Box -->

                        <div class="col-md-12 mt-3">
                            <label for="password">
                                <i class="fas fa-lock"></i>
                                @lang('site.password')
                            </label>
                            <input required type="password" name="password" id="password" class="form-control  @error('password') is-invalid  @enderror" placeholder="@lang('site.password') ... ">
                            @error('password')
                                <p class="text-danger col-md-12 mt-2 bold"><i class="fas fa-times ml-2 mr-2"></i>{{$message}}</p>
                            @enderror
                        </div>  <!-- End Of Password Box -->

                        <input required type="submit" value="@lang('site.update')" class="btn btn-primary col-md-6 float-end mt-3 bold">
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
