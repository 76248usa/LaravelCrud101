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


        <div class="card-header" style="margin-top: 40px;">All Messages</div>
    <table class="table">
            <thead>
              <tr>
                <th scope="col"> SL No</th>
                <th scope="col">Name</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Subject</th>
                <th scope="col">Message</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>

              <tr>
                @php($i = 1)
                @foreach ($messages as $message)
                <th scope="row">{{$i++}}</th>
                <td>{{ $message->name }}</td>
                <td>{{ $message->name }}</td>
                <td>{{ $message->email }}</td>
                <td>{{ $message->subject }}</td>
                <td>{{ $message->message }}</td>
                @if($message->created_at == NULL)
                <span class="text-danger">No Date Set</span>
                @else
                {{ Carbon\Carbon::parse($message->created_at)->diffForHumans() }}
                @endif
                </td>
                <td>

                    <a href="{{ url('message/delete/'.$message->id)}}" class="btn btn-danger">Delete</a>
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

        </div>

    </div>
</div>

        </div>

<!-- Trash Part -->






