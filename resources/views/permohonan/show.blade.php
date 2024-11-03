@extends('templates.app')
@section('isi')
        <div class="page-body">
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
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Detail Permohonan</h3>
                </div>
              </div>
            </div>
          </div>
          <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="container mt-5">
                            <form action="{{ route('permohonan.update', $application) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <section>
                                    <h4>Data Nasabah</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input type="text" class="form-control" id="nama" name="nasabah[nama]" value="{{ $application['nasabah']['nama'] }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nik">NIK</label>
                                                <input type="text" class="form-control" id="nik" name="nasabah[nik]" value="{{ $application['nasabah']['nik'] }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tempat_lahir">Tempat Lahir</label>
                                                <input type="text" class="form-control" id="tempat_lahir" name="nasabah[tempat_lahir]" value="{{ $application['nasabah']['tempat_lahir'] }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" class="form-control" id="tanggal_lahir" name="nasabah[tanggal_lahir]" value="{{ $application['nasabah']['tanggal_lahir'] }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                                <select class="form-control" id="jenis_kelamin" name="nasabah[jenis_kelamin]" required>
                                                    <option value="">Pilih...</option>
                                                    <option value="L" {{ $application['nasabah']['jenis_kelamin'] == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                    <option value="P" {{ $application['nasabah']['jenis_kelamin'] == 'P' ? 'selected' : '' }}>Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="alamat_lengkap">Alamat Lengkap</label>
                                                <input type="text" class="form-control" id="alamat_lengkap" name="nasabah[alamat_lengkap]" value="{{ $application['nasabah']['alamat_lengkap'] }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Additional Nasabah Fields -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kelurahan">Kelurahan</label>
                                                <input type="text" class="form-control" id="kelurahan" name="nasabah[kelurahan]" value="{{ $application['nasabah']['kelurahan'] }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kecamatan">Kecamatan</label>
                                                <input type="text" class="form-control" id="kecamatan" name="nasabah[kecamatan]" value="{{ $application['nasabah']['kecamatan'] }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kabupaten">Kabupaten</label>
                                                <input type="text" class="form-control" id="kabupaten" name="nasabah[kabupaten]" value="{{ $application['nasabah']['kabupaten'] }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="provinsi">Provinsi</label>
                                                <input type="text" class="form-control" id="provinsi" name="nasabah[provinsi]" value="{{ $application['nasabah']['provinsi'] }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kode_pos">Kode Pos</label>
                                                <input type="text" class="form-control" id="kode_pos" name="nasabah[kode_pos]" value="{{ $application['nasabah']['kode_pos'] }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_rekening">No Rek Tabungan</label>
                                                <input type="text" class="form-control" id="no_rekening" name="nasabah[no_rekening_tabungan]" value="{{ $application['nasabah']['no_rekening_tabungan'] }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_hp">No HP <span class="highlight">(+62)</span></label>
                                                <input type="text" class="form-control" id="no_hp" name="nasabah[no_hp]" required pattern="[0-9]*" value="{{ $application['nasabah']['no_hp'] }}" placeholder="Masukkan nomor tanpa 0/62">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Alamat Email</label>
                                                <input type="email" class="form-control" id="email" name="nasabah[email]" value="{{ $application['nasabah']['email'] }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="ktp">Upload KTP</label>
                                        <input type="file" class="form-control-file" id="ktp" name="nasabah[ktp]" accept="image/*" onchange="previewKTP(event)">
                                        <div id="ktpPreview" style="margin-top: 10px;">
                                            <img src="{{ asset($application['nasabah']['ktp']) }}" id="ktpPreview" style="margin-top: 10px; width: 150px;">
                                            <a href="{{ asset($application['nasabah']['ktp']) }}" download="ktp.png" style="display: block; margin-top: 10px;">Download KTP</a>
                                        </div>
                                    </div>

                                </section>


                                <section>
                                    <h4>Informasi Permohonan</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jumlah_penghasilan">Jumlah Penghasilan</label>
                                                <input type="number" class="form-control" id="jumlah_penghasilan" name="jumlah_penghasilan" value="{{ $application['jumlah_penghasilan'] }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jumlah_penghasilan_lainnya">Jumlah Penghasilan Lainnya</label>
                                                <input type="number" class="form-control" id="jumlah_penghasilan_lainnya" name="jumlah_penghasilan_lainnya" value="{{ $application['jumlah_penghasilan_lainnya'] }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jumlah_permohonan">Jumlah Permohonan</label>
                                                <input type="number" class="form-control" id="jumlah_permohonan" name="jumlah_permohonan" value="{{ $application['jumlah_permohonan'] }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jangka_waktu">Jangka Waktu (bulan)</label>
                                                <input type="number" class="form-control" id="jangka_waktu" name="jangka_waktu" value="{{ $application['jangka_waktu'] }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="maksimal_pembiayaan">Maksimal Pembiayaan yang diajukan</label>
                                                <input type="text" class="form-control" id="maksimal_pembiayaan" name="maksimal_pembiayaan" value="{{ $application['maksimal_pembiayaan'] }}" readonly>
                                                <button type="button" class="btn btn-secondary mt-2" id="calculate">Hitung</button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tujuan_pembiayaan">Tujuan Pembiayaan</label>
                                                <input type="text" class="form-control" id="tujuan_pembiayaan" name="tujuan_pembiayaan" value="{{ $application['tujuan_pembiayaan'] }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status_perkawinan">Status Perkawinan</label>
                                                <select class="form-control" id="status_perkawinan" name="status_perkawinan" required>
                                                    <option value="">Pilih...</option>
                                                    <option value="Married" {{ $application['status_perkawinan'] == 'Married' ? 'selected' : '' }}>Menikah</option>
                                                    <option value="Single" {{ $application['status_perkawinan'] == 'Single' ? 'selected' : '' }}>Belum Menikah</option>
                                                    <option value="Widowed" {{ $application['status_perkawinan'] == 'Widowed' ? 'selected' : '' }}>Cerai Mati</option>
                                                    <option value="Divorced" {{ $application['status_perkawinan'] == 'Divorced' ? 'selected' : '' }}>Cerai</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="upload_npwp">Upload NPWP</label>
                                                <input type="file" class="form-control-file" id="upload_npwp" name="upload_npwp" accept="image/*" onchange="previewNPWP(event)">
                                                <div id="npwpPreview" style="margin-top: 10px;">
                                                    <img src="{{ asset($application['upload_npwp']) }}" id="npwpPreview" style="margin-top: 10px; width: 150px;">
                                                    <a href="{{ asset($application['upload_npwp']) }}" download="npwp.png" style="display: block; margin-top: 10px;">Download NPWP</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="slip_gaji">Upload Slip Gaji</label>
                                                <input type="file" class="form-control-file" id="slip_gaji" name="slip_gaji" accept="image/*" onchange="previewSlipGaji(event)">
                                                <div id="slipGajiPreview" style="margin-top: 10px;">
                                                    <img src="{{ asset($application['slip_gaji']) }}" id="slipGajiPreview" style="margin-top: 10px; width: 150px;">
                                                    <a href="{{ asset($application['slip_gaji']) }}" download="slip gaji.png" style="display: block; margin-top: 10px;">Download Slip Gaji</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section>
                                    <h4>Informasi Data Pekerjaan</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama_instansi">Nama Instansi</label>
                                                <input type="text" class="form-control" id="nama_instansi" name="job[nama_instansi]" value="{{ $application['job']['nama_instansi'] }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_instansi">No Instansi</label>
                                                <input type="text" class="form-control" id="no_instansi" name="job[no_instansi]" value="{{ $application['job']['no_instansi'] }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="golongan_jabatan">Golongan/Jabatan</label>
                                                <input type="text" class="form-control" id="golongan_jabatan" name="job[golongan_jabatan]" value="{{ $application['job']['golongan_jabatan'] }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nip">NIP</label>
                                                <input type="text" class="form-control" id="nip" name="job[nip]" value="{{ $application['job']['nip'] }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="masa_kerja">Masa Kerja (Tanggal)</label>
                                                <input type="date" class="form-control" id="masa_kerja" name="job[tanggal_mulai_kerja]" value="{{ $application['job']['tanggal_mulai_kerja'] }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama_atasan">Nama Atasan</label>
                                                <input type="text" class="form-control" id="nama_atasan" name="job[nama_atasan]" value="{{ $application['job']['nama_atasan'] }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="alamat_kantor">Alamat Kantor</label>
                                                <input type="text" class="form-control" id="alamat_kantor" name="job[alamat_kantor]" value="{{ $application['job']['alamat_kantor'] }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                            <!-- Dokumen Lain -->
                            <section>
                                <h4>Dokumen Checklist</h4>
                                <table class="table" id="dokumenTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Dokumen</th>
                                            <th>Checklist</th>
                                            <th>Upload</th>
                                            <th>Download</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($application['documents'] as $index => $document)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <input type="text" class="form-control" name="documents[{{ $index }}][name]" value="{{ $document['dokumen_name'] }}" required>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="documents[{{ $index }}][status]" {{ $document['checklist_status'] ? 'checked' : '' }}>
                                                </td>
                                                <td>
                                                    <input type="file" class="form-control-file" name="documents[{{ $index }}][file_path]" onchange="handleFileUpload(this)">
                                                    <input type="hidden" class="uploaded-file" value="{{ $document['file_path'] }}">
                                                </td>
                                                <td>
                                                    <a href="{{ asset($document['file_path']) }}" class="btn btn-secondary" download>Download</a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger" onclick="removeRow(this)">Hapus</button>
                                                </td>
                                                <input type="hidden" name="documents[{{ $index }}][deleted]" value="false">
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button class="btn btn-primary" onclick="addRow()">Tambah Dokumen</button>
                            </section>


                            <section>
                                <h4>Data Pengajuan Biaya</h4>

                                <div class="form-group">
                                    <label for="total_angsuran">Total Angsuran Biaya</label>
                                    <input type="text" class="form-control" id="total_angsuran" name="financing_request[total_angsuran_biaya]"
                                           value="{{ $application['financing_request']['total_angsuran_biaya'] }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="jangka_waktu">Jangka Waktu (Autofill)</label>
                                    <input type="text" class="form-control" id="jangka_waktu_readonly" name="financing_request[jangka_waktu]"
                                           value="{{ $application['financing_request']['jangka_waktu'] }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="cabang">Cabang</label>
                                    <select class="form-control" id="cabang" name="financing_request[cabang]" required>
                                        <option value="">Pilih Cabang...</option>
                                        <option value="cabang1" {{ $application['financing_request']['cabang'] == 'cabang1' ? 'selected' : '' }}>Cabang 1</option>
                                        <option value="cabang2" {{ $application['financing_request']['cabang'] == 'cabang2' ? 'selected' : '' }}>Cabang 2</option>
                                        <!-- Add more branches as needed -->
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="capem">Capem</label>
                                    <select class="form-control" id="capem" name="financing_request[capem]" required>
                                        <option value="">Pilih Capem...</option>
                                        <option value="capem1" {{ $application['financing_request']['capem'] == 'capem1' ? 'selected' : '' }}>Capem 1</option>
                                        <option value="capem2" {{ $application['financing_request']['capem'] == 'capem2' ? 'selected' : '' }}>Capem 2</option>
                                        <!-- Add more capems as needed -->
                                    </select>
                                </div>

                                <input type="hidden" id="nama_ao" name="nama_ao" value="{{ $application['nama_ao'] }}"> <!-- Using the name from the application data -->
                            </section>



                            <!-- Tombol Submit -->
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Edit Permohonan</button>
                            </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <script>
            function previewKTP(event) {
                const file = event.target.files[0];
                const previewDiv = document.getElementById('ktpPreview');

                // Clear previous previews
                previewDiv.innerHTML = '';

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Menampilkan pratinjau gambar
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.width = '100px'; // Ukuran pratinjau
                        img.style.height = 'auto';
                        previewDiv.appendChild(img);

                        // Tambahkan tautan unduh
                        const downloadLink = document.createElement('a');
                        downloadLink.href = e.target.result; // Gambar di sini akan jadi URL untuk download
                        downloadLink.download = file.name; // Nama file untuk diunduh
                        downloadLink.innerHTML = 'Download KTP';
                        downloadLink.style.display = 'block'; // Tampilkan sebagai block
                        downloadLink.style.marginTop = '10px'; // Jarak atas
                        previewDiv.appendChild(downloadLink);
                    }
                    reader.readAsDataURL(file); // Membaca file sebagai URL data
                }
            }
            function previewNPWP(event) {
                const file = event.target.files[0];
                const previewDiv = document.getElementById('npwpPreview');

                // Clear previous previews
                previewDiv.innerHTML = '';

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Menampilkan pratinjau gambar
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.width = '100px'; // Ukuran pratinjau
                        img.style.height = 'auto';
                        previewDiv.appendChild(img);

                        // Tambahkan tautan unduh
                        const downloadLink = document.createElement('a');
                        downloadLink.href = e.target.result; // Gambar di sini akan jadi URL untuk download
                        downloadLink.download = file.name; // Nama file untuk diunduh
                        downloadLink.innerHTML = 'Download NPWP';
                        downloadLink.style.display = 'block'; // Tampilkan sebagai block
                        downloadLink.style.marginTop = '10px'; // Jarak atas
                        previewDiv.appendChild(downloadLink);
                    }
                    reader.readAsDataURL(file); // Membaca file sebagai URL data
                }
            }
            function previewSlipGaji(event) {
                const file = event.target.files[0];
                const previewDiv = document.getElementById('slipGajiPreview');

                // Clear previous previews
                previewDiv.innerHTML = '';

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Menampilkan pratinjau gambar
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.width = '100px'; // Ukuran pratinjau
                        img.style.height = 'auto';
                        previewDiv.appendChild(img);

                        // Tambahkan tautan unduh
                        const downloadLink = document.createElement('a');
                        downloadLink.href = e.target.result; // Gambar di sini akan jadi URL untuk download
                        downloadLink.download = file.name; // Nama file untuk diunduh
                        downloadLink.innerHTML = 'Download Slip Gaji';
                        downloadLink.style.display = 'block'; // Tampilkan sebagai block
                        downloadLink.style.marginTop = '10px'; // Jarak atas
                        previewDiv.appendChild(downloadLink);
                    }
                    reader.readAsDataURL(file); // Membaca file sebagai URL data
                }
            }


            let rowCount = 1;

            function addRow() {
                rowCount++;
                const tableBody = document.getElementById("dokumenTable").querySelector("tbody");
                const newRow = `
                    <tr>
                        <td>${rowCount}</td>
                        <td>
                            <input type="text" class="form-control" name="documents[][name]" required>
                        </td>
                        <td>
                            <input type="checkbox" name="documents[][status]">
                        </td>
                        <td>
                            <input type="file" class="form-control-file" name="documents[][file_path]" onchange="handleFileUpload(this)">
                            <input type="hidden" class="uploaded-file" value="{{ $document['file_path'] }}">
                        </td>
                        <td>
                            <a href="#" class="btn btn-secondary" disabled>Download</a>
                        </td>
                        <td>
                            <button class="btn btn-danger" onclick="removeRow(this)">Hapus</button>
                        </td>
                        <input type="hidden" name="documents[{{ $index }}][deleted]" value="false">
                    </tr>
                `;
                tableBody.insertAdjacentHTML('beforeend', newRow);
            }

            function removeRow(button) {
                const row = button.closest("tr");
                row.remove();
                rowCount--;
                updateRowNumbers();
            }

            function updateRowNumbers() {
                const rows = document.querySelectorAll("#dokumenTable tbody tr");
                rows.forEach((row, index) => {
                    row.cells[0].textContent = index + 1;
                });
            }

            function handleFileUpload(input) {
                const uploadedFile = input.files[0];
                const filePathElement = input.nextElementSibling;
                const downloadLink = input.closest("tr").querySelector("a.btn-secondary");

                if (uploadedFile) {
                    filePathElement.value = uploadedFile.name;
                    const fileURL = URL.createObjectURL(uploadedFile);
                    downloadLink.href = fileURL;
                    downloadLink.download = uploadedFile.name;
                    downloadLink.disabled = false;
                } else {
                    downloadLink.href = "#";
                    downloadLink.download = "";
                    downloadLink.disabled = true;
                }
            }

            document.getElementById('calculate').addEventListener('click', function() {
                const jumlahPenghasilan = parseFloat(document.getElementById('jumlah_penghasilan').value) || 0;
                const jumlahPenghasilanLainnya = parseFloat(document.getElementById('jumlah_penghasilan_lainnya').value) || 0;
                const jumlahPermohonan = parseFloat(document.getElementById('jumlah_permohonan').value) || 0;
                const jangkaWaktu = parseFloat(document.getElementById('jangka_waktu').value) || 0;

                // Calculate maksimal pembiayaan
                const maksimalPembiayaan = (jumlahPenghasilan + jumlahPenghasilanLainnya) * jangkaWaktu * 0.5; // Adjust the formula as needed
                document.getElementById('maksimal_pembiayaan').value = maksimalPembiayaan;

                console.log((jumlahPenghasilan + jumlahPenghasilanLainnya)* jangkaWaktu);
                return

                // Calculate total angsuran biaya
                const totalAngsuran = jumlahPermohonan * jangkaWaktu;
                document.getElementById('total_angsuran').value = totalAngsuran;
                document.getElementById('jangka_waktu_readonly').value = jangkaWaktu;

                // Validation for enabling/disabling the submit button
                // const submitButton = document.getElementById('submit_button'); // Replace with your actual button ID
                // if (totalAngsuran > maksimalPembiayaan) {
                //     submitButton.disabled = true; // Disable the button if total angsuran exceeds maksimal pembiayaan
                // } else {
                //     submitButton.disabled = false; // Enable the button otherwise
                // }
            });
        </script>
@endsection
