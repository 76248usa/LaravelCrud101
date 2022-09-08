@extends('admin.admin_master')

@section('admin')
    <div class="py-12">
            <div class="container">
            <div class="row">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Contact</div>
                <div class="card-body">
                <form action="{{ url('/contact/update/'.$contact->id) }} " method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <div class="form-group">
                      <label  class="form-label">Update About Title</label>
                      <input type="text" name="address" class="form-control"  value={{ $contact->address }}>

                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                      <div  class="form-text">
                    </div>
                </div>

                <div class="form-group">
                    <label  class="form-label">Update Description</label>

                    <input type="text" name="email" class="form-control" value={{ $contact->email }}>

                      @error('email')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror

                </div>

                <div class="form-group">
                    <label  class="form-label">Update Description</label>

                    <input type="text" name="phone" class="form-control" value={{ $contact->phone }}>

                      @error('phone')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror

                </div>


                    <button style="background-color: red" type="submit" class="btn btn-primary">Update About</button>
                  </form>
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

        </div>



<style>

</style>

@endsection
