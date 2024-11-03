@extends('templates.app')
@section('isi')
<div class="page-body">
    {{-- Pesan Sukses --}}
@if(session('success'))
    {{var_dump(session())}}
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

    <h2>Form Permohonan</h2>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="container mt-5">
                    <form action="{{ route('permohonan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <!-- Data Nasabah -->
                    <section>
                        <h4>Data Nasabah</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nasabah[nama]" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nasabah[nik]" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="nasabah[tempat_lahir]" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="nasabah[tanggal_lahir]" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="nasabah[jenis_kelamin]" required>
                                        <option value="">Pilih...</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alamat_lengkap">Alamat Lengkap</label>
                                    <input type="text" class="form-control" id="alamat_lengkap" name="nasabah[alamat_lengkap]" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kelurahan">Kelurahan</label>
                                    <input type="text" class="form-control" id="kelurahan" name="nasabah[kelurahan]" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="text" class="form-control" id="kecamatan" name="nasabah[kecamatan]" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kabupaten">Kabupaten</label>
                                    <input type="text" class="form-control" id="kabupaten" name="nasabah[kabupaten]" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="provinsi">Provinsi</label>
                                    <input type="text" class="form-control" id="provinsi" name="nasabah[provinsi]" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kode_pos">Kode Pos</label>
                                    <input type="text" class="form-control" id="kode_pos" name="nasabah[kode_pos]" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_rekening">No Rek Tabungan</label>
                                    <input type="text" class="form-control" id="no_rekening" name="nasabah[no_rekening_tabungan]" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_hp">No HP <span class="highlight">(+62)</span></label>
                                    <input type="text" class="form-control" id="no_hp" name="nasabah[no_hp]" required pattern="[0-9]*" placeholder="Masukkan nomor tanpa 0/62">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Alamat Email</label>
                                    <input type="email" class="form-control" id="email" name="nasabah[email]" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ktp">Upload KTP</label>
                            <input type="file" class="form-control-file" id="ktp" name="nasabah[ktp]" accept="image/*" required onchange="previewKTP(event)">
                            <div id="ktpPreview" style="margin-top: 10px;"></div>
                        </div>

                    </section>

                    <section>
                        <h4>Informasi Permohonan</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jumlah_penghasilan">Jumlah Penghasilan</label>
                                    <input type="number" class="form-control" id="jumlah_penghasilan" name="jumlah_penghasilan" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jumlah_penghasilan_lainnya">Jumlah Penghasilan Lainnya</label>
                                    <input type="number" class="form-control" id="jumlah_penghasilan_lainnya" name="jumlah_penghasilan_lainnya">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jumlah_permohonan">Jumlah Permohonan</label>
                                    <input type="number" class="form-control" id="jumlah_permohonan" name="jumlah_permohonan" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jangka_waktu">Jangka Waktu (bulan)</label>
                                    <input type="number" class="form-control" id="jangka_waktu" name="jangka_waktu" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="maksimal_pembiayaan">Maksimal Pembiayaan yang diajukan</label>
                                    <input type="text" class="form-control" id="maksimal_pembiayaan" name="maksimal_pembiayaan" readonly>
                                    <button type="button" class="btn btn-secondary mt-2" id="calculate">Hitung</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tujuan_pembiayaan">Tujuan Pembiayaan</label>
                                    <input type="text" class="form-control" id="tujuan_pembiayaan" name="tujuan_pembiayaan" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status_perkawinan">Status Perkawinan</label>
                                    <select class="form-control" id="status_perkawinan" name="status_perkawinan" required>
                                        <option value="">Pilih...</option>
                                        <option value="Married">Menikah</option>
                                        <option value="Single">Belum Menikah</option>
                                        <option value="Widowed">Cerai Mati</option>
                                        <option value="Divorced">Cerai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="npwp">Upload NPWP</label>
                                    <input type="file" class="form-control-file" id="npwp" name="upload_npwp" accept="image/*" required onchange="previewNPWP(event)">
                                    <div id="npwpPreview" style="margin-top: 10px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="slip_gaji">Upload Slip Gaji</label>
                                    <input type="file" class="form-control-file" id="slip_gaji" name="slip_gaji" accept="image/*" required onchange="previewSlipGaji(event)">
                                    <div id="slipGajiPreview" style="margin-top: 10px;"></div>
                                </div>
                            </div>
                        </div>
                    </section>


                    <!-- Data Pekerjaan -->
                    <section>
                        <h4>Informasi Data Pekerjaan</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_instansi">Nama Instansi</label>
                                    <input type="text" class="form-control" id="nama_instansi" name="job[nama_instansi]" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_instansi">No Instansi</label>
                                    <input type="text" class="form-control" id="no_instansi" name="job[no_instansi]" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="golongan_jabatan">Golongan/Jabatan</label>
                                    <input type="text" class="form-control" id="golongan_jabatan" name="job[golongan_jabatan]" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input type="text" class="form-control" id="nip" name="job[nip]" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="masa_kerja">Masa Kerja (Tanggal)</label>
                                    <input type="date" class="form-control" id="masa_kerja" name="job[masa_kerja]" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_atasan">Nama Atasan</label>
                                    <input type="text" class="form-control" id="nama_atasan" name="job[nama_atasan]" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="alamat_kantor">Alamat Kantor</label>
                                    <input type="text" class="form-control" id="alamat_kantor" name="job[alamat_kantor]" required>
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
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <input type="text" class="form-control" name="documents[][name]" required>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="documents[][status]">
                                    </td>
                                    <td>
                                        <input type="file" class="form-control-file" name="documents[][file_path]" onchange="handleFileUpload(this)">
                                        <span class="uploaded-file"></span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-secondary" disabled>Download</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger" onclick="removeRow(this)">Hapus</button>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                        <button class="btn btn-primary" onclick="addRow()">Tambah Dokumen</button>
                    </section>

                    <section>
                        <h4>Data Pengajuan Biaya</h4>

                        <div class="form-group">
                            <label for="total_angsuran">Total Angsuran Biaya</label>
                            <input type="text" class="form-control" id="total_angsuran" name="financing_request[total_angsuran_biaya]" readonly>
                        </div>

                        <div class="form-group">
                            <label for="jangka_waktu">Jangka Waktu (Autofill)</label>
                            <input type="text" class="form-control" id="jangka_waktu_readonly" name="financing_request[jangka_waktu]" readonly>
                        </div>

                        <div class="form-group">
                            <label for="cabang">Cabang</label>
                            <select class="form-control" id="cabang" name="financing_request[cabang]" required>
                                <option value="">Pilih Cabang...</option>
                                <option value="cabang1">Cabang 1</option>
                                <option value="cabang2">Cabang 2</option>
                                <!-- Add more branches as needed -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="capem">Capem</label>
                            <select class="form-control" id="capem" name="financing_request[capem]" required>
                                <option value="">Pilih Capem...</option>
                                <option value="capem1">Capem 1</option>
                                <option value="capem2">Capem 2</option>
                                <!-- Add more capems as needed -->
                            </select>
                        </div>

                        <input type="hidden" id="nama_ao" name="nama_ao" value="{{$nama_oa}}"> <!-- Replace with actual auth data -->
                    </section>


                    <!-- Tombol Submit -->
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Kirim Permohonan</button>
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
                        <span class="uploaded-file"></span>
                    </td>
                    <td>
                        <a href="#" class="btn btn-secondary" disabled>Download</a>
                    </td>
                    <td>
                        <button class="btn btn-danger" onclick="removeRow(this)">Hapus</button>
                    </td>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


@endsection
