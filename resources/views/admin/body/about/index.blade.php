@extends('admin.admin_master')

@section('admin')
 <div class="py-12">
            <div class="container">
            <div class="row">

                <div class="col-md-9">
                    <div class="card">

        @if(session('success'))
            <div class="alert alert-danger" role="alert">
            {{ session('success') }}
            </div>
        @endif


        <div class="card-header" style="margin-top: 40px;">About Us</div>
    <table class="table" style="margin-left: 40px;">
            <thead>
              <tr>
                <th scope="col"> SL N</th>
                <th scope="col">About Title</th>
                <th scope="col">Description</th>
                <th scope="col">Long Desc At</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>

              <tr>
                @php($i = 1)
                @foreach ($abouts as $about)
                <th scope="row">{{$i++}}</th>
                <td>{{ $about->title }}</td>
                <td>{{ $about->description }}</td>
                <td>{{ $about->long_description }}</td>

                <td>
                @if($about->created_at == NULL)
                <span class="text-danger">No Date Set</span>
                @else
                {{ Carbon\Carbon::parse($about->created_at)->diffForHumans() }}
                @endif
                </td>
                <td>
                    <a href="{{ url('about/edit/'.$about->id) }}" class="btn btn-info">Edit</a>

                    <a href="{{ url('about/delete/'.$about->id) }}" class="btn btn-danger">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          @if(session('success'))
          <div class="alert alert-danger" role="alert">
          {{ session('success') }}
          </div>
      @endif

        </div>
        </div>

        <div class="col-md-3" >
            <div class="card" style="margin-top: 40px;>
                <div class="card-header">Add about</div>
                <div class="card-body">
                <form action="{{ url('/about/store') }}" method="POST"
                enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <div class="form-group">
                      <label for="exampleInputEmail1" class="form-label">About Title</label>
                      <input type="text" name="title" class="form-control" >

                      @error('title')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror


                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label">Description</label>
                        <input type="text" name="description" class="form-control" >

                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                      </div>

                      <div class="form-group">
                            <label for="exampleFormControlTextarea1" class="form-label">Long description</label>
                            <textarea class="form-control"  rows="3"></textarea>


                        @error('long_description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                      </div>

                      <div id="emailHelp" class="form-text">
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                  </form>
                </div>
            </div>
        </div>

    </div>
</div>

        </div>

<!-- Trash Part -->






