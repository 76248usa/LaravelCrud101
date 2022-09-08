@extends('admin.admin_master')

@section('admin')
    <div class="py-12">
            <div class="container">
            <div class="row">



        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Slider</div>
                <div class="card-body">

                <form action="{{ url('slider/update/'.$slider->id) }} " method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="old_image" value="{{ $slider->image }}">
                    <div class="mb-3">
                        <div class="form-group">
                      <label for="exampleInputEmail1" class="form-label">Update Slider Title</label>
                      <input type="text" name="title" class="form-control" aria-describedby="emailHelp" value={{ $slider->title }}>

                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                      <div id="emailHelp" class="form-text">
                    </div>
                </div>

                <div class="form-group">
                      <label for="exampleInputEmail1" class="form-label">Update Description</label>
                      <input type="text" name="description" class="form-control" aria-describedby="emailHelp" value={{ $slider->description }}>

                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                      <div id="emailHelp" class="form-text">
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">Update Image</label>

                    <input type="file" name="image" class="form-control" value={{ $slider->image }}>

                      @error('image')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                    <div class="form-group">
                        <img src=" {{ asset($slider->image)}}" height="200px"
                        width="300px"/>
                    </div>
              </div>
                    <button style="background-color: red" type="submit" class="btn btn-primary">Update Slider</button>
                  </form>
                </div>
            </div>
        </div>
        @if(session('success'))
                 <div class="alert alert-danger" role="alert">
                    {{ session('success') }}
                  </div>
                @endif

    </div>
</div>

        </div>



<style>

</style>

@endsection
