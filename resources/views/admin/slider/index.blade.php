
@extends('admin.admin_master')

@section('admin')

 <div class="py-12">
            <div class="container">
            <div class="row">

                <div class="col-md-8">
                    <div class="card">

        @if(session('success'))
            <div class="alert alert-danger" role="alert">
            {{ session('success') }}
            </div>
        @endif

        <div class="card-title" style="margin-top: 40px;">All Brands</div>
    <table class="table">
        <h2>Slider      Home Sliders</h2>
            <thead>
              <tr>
                <th scope="col"> SL No</th>
                <th scope="col">Slider Name</th>
                <th scope="col">Slider Description</th>
                <th scope="col">Slider Image</th>

                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>

              <tr>
                @php($i = 1)
                @foreach ($sliders as $slider)
                <th scope="row">{{$i++}}</th>
                <td>{{ $slider->title }}</td>
                <td>{{ $slider->description  }}</td>
                <td> <img src="{{ asset($slider->image) }}"
                style="height:40px; width:70px;" alt=""></td>

                <td>
                    <a href="{{ url('slider/edit/'.$slider->id)}}" class="btn btn-info">Edit</a>
                    <a href="{{ url('slider/delete/'.$slider->id) }}" class="btn btn-danger">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

        </div>
        </div>




        <div class="col-md-4" >
            <div class="card" style="margin-top: 40px;>
                <h3>Add Slider</h3>
                <div class="card-header">Add Slider</div>
                <div class="card-body">
               <!-- <form action="" method="POST"
                enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <div class="form-group">
                      <label for="exampleInputEmail1" class="form-label">Brand Name</label>
                      <input type="text" name="brand_name" class="form-control" aria-describedby="emailHelp">

                      @error('brand_name')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror


                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label">Brand Name</label>
                        <input type="file" name="brand_image" class="form-control" aria-describedby="emailHelp">

                        @error('brand_image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                      </div>

                      <div id="emailHelp" class="form-text">
                    </div>

                  </form> -->
                  <h3>Go to Add Slider Page</h3>
                  <a href="{{ route('add.slider') }}"><button type="submit" class="btn btn-primary">Add Slider</button></a>
                </div>
            </div>







        </div>

    </div>
</div>

        </div>

<!-- Trash Part -->













