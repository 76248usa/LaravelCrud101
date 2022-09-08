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


        <div class="card-header" style="margin-top: 40px;">All Contact Data</div>
    <table class="table" style="margin-left: 40px;">
            <thead>
              <tr>
                <th scope="col"> SL N</th>
                <th scope="col">Contact Address</th>
                <th scope="col">Contact Email</th>
                <th scope="col">Contact Phone</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>

              <tr>
                @php($i = 1)
                @foreach ($contacts as $contact)
                <th scope="row">{{$i++}}</th>
                <td>{{ $contact->address }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->phone }}</td>

                <td>
                @if($contact->created_at == NULL)
                <span class="text-danger">No Date Set</span>
                @else
                {{ Carbon\Carbon::parse($contact->created_at)->diffForHumans() }}
                @endif
                </td>
                <td>
                    <a href="{{ url('contact/edit/'.$contact->id) }}" class="btn btn-info">Edit</a>

                    <a href="{{ url('contact/delete/'.$contact->id) }}" class="btn btn-danger">Delete</a>
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
                <div class="card-header">Add Contact</div>
                <div class="card-body">
                <form action="{{ url('/contact/store') }}" method="POST"
                enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <div class="form-group">
                      <label for="exampleInputEmail1" class="form-label">Contact Address</label>
                      <input type="text" name="address" class="form-control" >

                      @error('address')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror


                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" >

                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>

                    <div class="form-group">
                        <label  class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" >

                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>

                    <div id="emailHelp" class="form-text">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Contact</button>
                  </form>
                </div>
            </div>

        </div>

    </div>
</div>

        </div>

<!-- Trash Part -->






