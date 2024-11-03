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
    <!-- Container-fluid starts-->
    <div class="container-fluid default-dash">
      <div class="row">
        <div class="col-xl-4 col-md-6 box-col-50 xl-50">
          <div class="card profile-greeting">
            <div class="card-body"><img class="img-fluid bg-img-cover" src="{{ url('') }}/html/assets/images/dashboard/profile-greeting/bg.png" alt="">
              <div>
                <h1>Selamat datang!</h1>
                <h4>Silahkan buat permohonan baru</h4>
                <h4>Klik dibawah ini!</h4>
                <a class="btn btn-primary" href="{{route('permohonan.create')}}">Buat Permohonan Baru</a>
              </div>
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
