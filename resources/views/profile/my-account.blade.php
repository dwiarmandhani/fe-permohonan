@extends('templates.app')
@section('isi')
<div class="page-body">
    <!-- Container-fluid starts-->
    <h2>My Account</h2>

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
          <div class="card profile-greeting">
            <div class="card-body"><img class="img-fluid bg-img-cover" src="{{ url('') }}/html/assets/images/dashboard/profile-greeting/bg.png" alt="">
                <div class="profile-details">
                    <h4>Profile Information</h4>
                    <ul>
                        <li><strong>Name:</strong> {{ $profile['user']['name'] }}</li>
                        <li><strong>Username:</strong> {{ $profile['user']['username'] }}</li>
                        <li><strong>Email:</strong> {{ $profile['user']['email'] }}</li>
                        <li><strong>Phone:</strong> {{ $profile['user']['phone'] }}</li>
                    </ul>
                </div>
            </div>

            <div class="shap-block">
              <div class="rounded-shap"><i></i><i></i><i>                   </i></div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-6 box-col-50 xl-50">
          <div class="card">

            <div class="card-body"><img class="img-fluid bg-img-cover" src="{{ url('') }}/html/assets/images/dashboard/profile-greeting/bg.png" alt="">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" value="{{ $profile['user']['name'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" class="form-control" value="{{ $profile['user']['username'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" value="{{ $profile['user']['email'] }}" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" name="phone" class="form-control" value="{{ $profile['user']['phone'] }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Profile</button>
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
