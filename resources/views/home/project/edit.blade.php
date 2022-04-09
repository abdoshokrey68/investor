@extends('home.project.project_layout')

@section('project_content')

    <div class="col-md-12 new_project p-0">
        <div class="card pr-2 pl-2">
            <h2 class="h2 bold pt-4 pl-4 pr-4"> <i class="fas fa-edit"></i> @lang('site.edit_project') </h2>
            <hr>
            <form action="{{route('project.update',$project->id)}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="col-md-12 mt-3 p-2">
                    <label for="name" class="bold"> @lang('site.project_name') </label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value=" @error('name') {{old('name')}}@else @if($errors->any()){{old('name')}} @else{{$project->name}} @endif @enderror" >

                    @error('name')
                        <b class="bold text-danger">
                            <i class="fas fa-exclamation-triangle mr-2 ml-2"></i>
                            {{$message}}
                        </b>
                    @enderror
                </div> <!-- End Of Project Name -->

                <div class="col-md-12 mt-3 p-2">
                    <label for="des" class="bold">@lang('site.project_des') </label>
                    <textarea type="text" name="des" id="des" cols="30" rows="10" class="form-control @error('des') is-invalid @enderror"
                    >@error('des'){{old('des')}}@else @if($errors->any()){{old('des')}} @else{{$project->des}}@endif @enderror</textarea>
                    @error('des')
                        <b class="bold text-danger">
                            <i class="fas fa-exclamation-triangle mr-2 ml-2"></i>
                            {{$message}}
                        </b>
                    @enderror
                </div> <!-- End Of Project Description -->

                <div class="col-md-12 mt-3 p-2">
                    <label for="min_price" class="bold"> @lang('site.min_price_project')</label>
                    <input type="text" name="min_price" id="min_price" class="form-control @error('min_price') is-invalid @enderror" value="@error('min_price'){{old('min_price')}}@else @if($errors->any()){{old('min_price')}}
                    @else{{$project->min_price}}@endif @enderror" >
                    @error('min_price')
                        <b class="bold text-danger">
                            <i class="fas fa-exclamation-triangle mr-2 ml-2"></i>
                            {{$message}}
                        </b>
                    @enderror
                </div> <!-- End Of Project Name -->

                <div class="col-md-12 mt-3 p-2">
                    <label for="tags" class="bold"> <i class="fas fa-hashtag"></i> @lang('site.tags') </label>
                    <input type="text" name="tags" id="tags" class="form-control @error('tags') is-invalid @enderror" value="@error('tags'){{old('tags')}} @else @if($errors->any()){{old('tags')}}
                    @else{{$project->tags}}@endif @enderror" placeholder="@lang('site.separate_tags')">
                    <p class="bold text-danger mt-2"> @lang('site.tags_example')  </p>
                    @error('tags')
                        <b class="bold text-danger">
                            <i class="fas fa-exclamation-triangle mr-2 ml-2"></i>
                            {{$message}}
                        </b>
                    @enderror
                </div> <!-- End Of Project Name -->


                <div class="col-md-12 mt-3 p-2">
                    <label for="image" class="bold"> <i class="fas fa-image"></i> @lang('site.image') </label>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" value="@if($errors->any()){{old('image')}}@endif">
                    @error('image')
                        <b class="bold text-danger">
                            <i class="fas fa-exclamation-triangle mr-2 ml-2"></i>
                            {{$message}}
                        </b>
                    @enderror
                </div> <!-- End Of Project Image -->
                @if ($project->image)
                        <img
                            src="{{URL("img/project/$project->image")}}"
                            alt="Project Image"
                            style="height: 100%; width:100%"
                        />
                    @else
                        <img
                            src="{{URL("img/project/project.jpg")}}"
                            alt="Project Image"
                            style="height: 100%; width:100%"
                        />
                @endif

                <input type="submit" value=" @lang('site.save') " class="col-md-6 float-end bold  btn btn-warning m-3">

            </form>
        </div>
    </div>

@endsection
