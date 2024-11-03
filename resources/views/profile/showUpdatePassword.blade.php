@extends('templates.app')
@section('isi')
<div class="page-body">

        {{-- Pesan Sukses --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Pesan Error --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <div class="container-fluid default-dash">
      <div class="row">

        <div class="col-xl-4 col-md-6 box-col-50 xl-50">
          <div class="card">
                  <div class="card-body">
                      <h4>Change Password</h4>
                      <form action="{{ route('profile.updatepassword') }}" method="POST">
                          @csrf
                          @method('PUT')

                          <div class="form-group">
                              <label for="current_password">Current Password:</label>
                              <input type="password" name="current_password" class="form-control" required>
                          </div>

                          <div class="form-group">
                              <label for="new_password">New Password:</label>
                              <input type="password" name="new_password" class="form-control" required>
                          </div>

                          <div class="form-group">
                              <label for="new_password_confirmation">Confirm New Password:</label>
                              <input type="password" name="new_password_confirmation" class="form-control" required>
                          </div>

                          <button type="submit" class="btn btn-primary">Change Password</button>
                      </form>
                  </div>


            <div class="shap-block">
              <div class="rounded-shap"><i></i><i></i><i>                   </i></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid Ends-->
  </div>
  @endsection
