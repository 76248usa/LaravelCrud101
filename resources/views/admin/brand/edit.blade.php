@extends('admin.admin_master')

@section('admin')
    <div class="py-12">
            <div class="container">
            <div class="row">

                @if(session('success'))
                 <div class="alert alert-danger" role="alert">
                    {{ session('success') }}
                  </div>
                @endif



        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Brand</div>
                <div class="card-body">
                <form action="{{ url('brand/update/'.$brand->id) }} " method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="old_image" value="{{ $brand->brand_image }}">
                    <div class="mb-3">
                        <div class="form-group">
                      <label for="exampleInputEmail1" class="form-label">Update Brand Name</label>
                      <input type="text" name="brand_name" class="form-control" aria-describedby="emailHelp" value={{ $brand->brand_name }}>

                        @error('brand_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                      <div id="emailHelp" class="form-text">
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label">Update Brand Image</label>

                    <input type="file" name="brand_image" class="form-control" value={{ $brand->brand_image }}>

                      @error('brand_image')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                    <div class="form-group">
                        <img src=" {{ asset($brand->brand_image)}}" height="200px"
                        width="300px"/>
                    </div>
              </div>
                    <button style="background-color: red" type="submit" class="btn btn-primary">Update Brand</button>
                  </form>
                </div>
            </div>
        </div>

    </div>
</div>

        </div>



<style>

</style>

@endsection
