@extends('admin.admin_master')

@section('admin')
    <div class="card" style="margin-top: 40px;>

        <div class="card-header">Add Slider</div>
        <div class="card-body">
        <form action="{{ route('store.slider') }}" method="POST"
        enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <div class="form-group">
              <label for="exampleInputEmail1" class="form-label">Slider Title</label>
              <input type="text" name="title" class="form-control" aria-describedby="emailHelp">
              @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Slider Description</label>
                <input type="text" name="description" class="form-control" aria-describedby="emailHelp">
                @error('name')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
              </div>

            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Slider Image</label>
                <input type="file" name="image" class="form-control" aria-describedby="emailHelp">

                @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror

              </div>

              <div id="emailHelp" class="form-text">
            </div>

          </form>

          <button type="submit" class="btn btn-primary">Add Slider</button>
        </div>
    </div>
    @endsection
