@extends('templates.app')
@section('isi')
<div class="page-body">
@if(session('success'))
    <div class="alert alert-success">
        {{ session('message') }}
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

<div class="container-fluid">
    <div class="row">

      <!-- Zero Configuration  Starts-->
      <div class="col-sm-12">
        <div class="card">

            <div class="card-header pb-0">
                <h4>Tasklist Data Entry</h4>
            </div>

          <div class="card-body">
            <div class="mb-3">
                <input type="text" id="searchName" placeholder="Nama Pemohon" class="form-control" style="display:inline; width: auto; margin-right: 10px;">
                            <input type="text" id="searchAplikasiNomor" placeholder="Nomor Aplikasi" class="form-control" style="display:inline; width: auto; margin-right: 10px;">
                            <input type="date" id="searchStartDate" class="form-control" style="display:inline; width: auto; margin-right: 10px;">
                            <input type="date" id="searchEndDate" class="form-control" style="display:inline; width: auto; margin-right: 10px;">
                            <input type="text" id="searchBranch" placeholder="Cabang" class="form-control" style="display:inline; width: auto; margin-right: 10px;">
                            <button id="searchBtn" class="btn btn-primary">Cari</button>
                            <button id="clearBtn" class="btn btn-secondary">Clear</button>
            </div>
            <div class="table-responsive">
                <table class="display" id="applicationTable">
                    <thead>
                        <tr>
                            <th>Nama Pemohon</th>
                            <th>No Aplikasi</th>
                            <th>KTP</th>
                            <th>Tanggal Aplikasi</th>
                            <th>Cabang</th>
                            <th>Nama AO</th>
                            <th>
                                <a class="btn btn-primary" href="{{ route('permohonan.create') }}">Buat Permohonan</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applications as $application)
                            <tr>
                                <td>{{ $application['nasabah']['nama'] }}</td>
                                <td>{{ $application['no_aplikasi'] }}</td>
                                <td><a href="{{ asset($application['nasabah']['ktp']) }}" download>{{$application['nasabah']['nik']}}</a></td>
                                <td>{{ $application['tanggal_aplikasi'] }}</td>
                                <td>{{ $application['financing_request']['cabang'] }}</td>
                                <td>{{ $application['nama_ao'] }}</td>
                                <td>
                                    <ul class="action">
                                        <li class="edit">
                                            <a href="{{ route('permohonan.show', $application['id']) }}"><i class="icon-eye"></i></a>
                                        </li>

                                        <li class="delete">
                                            <form action="{{ route('permohonan.delete', $application['id']) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" style="border: none; background: none; color: red;">
                                                    <i class="icon-trash"></i>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">Data tidak tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
