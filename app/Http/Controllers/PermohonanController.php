<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
class PermohonanController extends Controller
{
    public function index(Request $request)
    {
        // Get the access token from session
        $token = Session::get('access_token');

        // Check if token is available
        if (!$token) {
            return redirect()->route('login')->withErrors(['message' => 'Please log in first.']);
        }

        // Fetch data from external API
        $response = Http::withToken($token)->get('https://apipermohonan.explorasi.com/api/applications');

        // Check if response is successful
        if ($response->successful()) {
            $applications = $response->json('applications');
            return view('permohonan.index', compact('applications'));
        }

        // Handle the case where the user is unauthenticated
        return redirect()->route('login')->withErrors(['message' => $response->json('message') ?? 'An error occurred.']);
    }

    public function showFormPengajuan()
    {
        if (!session()->has('access_token')) {
            return redirect()->route('login');
        }

        $response = Http::withToken(session('access_token'))->get('https://apipermohonan.explorasi.com/api/profile');

        // Check if the response is successful
        if ($response->successful()) {
            $userProfile = $response->json();
            $nama_oa = $userProfile['user']['name'];
        } else {
            // Handle error (e.g., log it, return an error message, etc.)
            return redirect()->route('login')->withErrors('Unable to fetch user profile');
        }
        return view('permohonan.create', compact('nama_oa'));
    }




    public function store(Request $request)
    {
        if (!session()->has('access_token')) {
            return redirect()->route('login');
        }
        $validatedData = $request->validate([
            // Validasi Data Nasabah
            'nasabah.nama' => 'required|string|max:255',
            'nasabah.nik' => 'required|string|max:20', // NIK biasanya 16 digit
            'nasabah.tempat_lahir' => 'required|string|max:255',
            'nasabah.tanggal_lahir' => 'required|date',
            'nasabah.jenis_kelamin' => 'required|in:L,P', // L=Male, P=Female
            'nasabah.alamat_lengkap' => 'required|string|max:255',
            'nasabah.kelurahan' => 'required|string|max:255',
            'nasabah.kecamatan' => 'required|string|max:255',
            'nasabah.kabupaten' => 'required|string|max:255',
            'nasabah.provinsi' => 'required|string|max:255',
            'nasabah.kode_pos' => 'required|string|max:10',
            'nasabah.no_rekening_tabungan' => 'required|string|max:20',
            'nasabah.no_hp' => 'required|string|max:15',
            'nasabah.email' => 'required|email|max:255',
            'nasabah.ktp' => 'required|file|max:2048', // Maksimal 2MB, hanya PDF

            // Validasi Informasi AO
            'nama_ao' => 'required|string|max:255',

            // Validasi Permohonan
            'jumlah_penghasilan' => 'required|numeric|min:0',
            'jumlah_permohonan' => 'required|numeric|min:0',
            'jumlah_penghasilan_lainnya' => 'nullable|numeric|min:0',
            'jangka_waktu' => 'required|integer|min:1',
            'maksimal_pembiayaan' => 'required|numeric|min:0',
            'tujuan_pembiayaan' => 'required|string|max:255',
            'status_perkawinan' => 'required', // Contoh status

            // Validasi Dokumen Pendukung
            'upload_npwp' => 'required|file|max:2048', // Maksimal 2MB, hanya PDF
            'slip_gaji' => 'required|file|max:2048', // Maksimal 2MB, hanya PDF

            // Validasi Informasi Pekerjaan
            'job.nama_instansi' => 'required|string|max:255',
            'job.no_instansi' => 'required|string|max:50',
            'job.golongan_jabatan' => 'required|string|max:50',
            'job.nip' => 'required|string|max:50',
            'job.masa_kerja' => 'required',
            'job.nama_atasan' => 'required|string|max:255',
            'job.alamat_kantor' => 'required|string|max:255',

            // Validasi Permohonan Pembiayaan
            'financing_request.total_angsuran_biaya' => 'required|numeric|min:0',
            'financing_request.jangka_waktu' => 'required|integer|min:1',
            'financing_request.cabang' => 'required|string|max:255',
            'financing_request.capem' => 'required|string|max:255',
        ]);

        // Handle file uploads with additional checks
        $ktpPath = $request->file('nasabah.ktp') ? $request->file('nasabah.ktp')->store('uploads/ktp') : null;
        $npwpPath = $request->file('upload_npwp') ? $request->file('upload_npwp')->store('uploads/npwp') : null;
        $slipGajiPath = $request->file('slip_gaji') ? $request->file('slip_gaji')->store('uploads/slip_gaji') : null;

        $documentPaths = [];
        $documents = $request->input('documents', []);
        $files = $request->file('documents', []);

        $documentEntries = [];
        for ($i = 0; $i < count($documents); $i++) {
            $doc = $documents[$i];

            if (isset($doc['name'])) {
                $documentEntries[] = [
                    'name' => $doc['name'],
                    'status' => '0',
                    'file_path' => null,
                ];
            }
            if (isset($doc['status'])) {
                $documentEntries[count($documentEntries) - 1]['status'] = '1'; // Update status
            }
        }

        foreach ($documentEntries as $index => &$entry) {
            if (isset($files[$index]['file_path']) && $request->hasFile("documents.$index.file_path")) {
                $entry['file_path'] = $files[$index]['file_path']->store('uploads/documents');
            }
            $documentPaths[] = $entry;
        }



        $tanggalMulaiKerja = $request->input('job.masa_kerja');
        $today = now();

        $masaKerja = $today->diffInDays($tanggalMulaiKerja);
        $masaKerjaTahun = floor($masaKerja / 365);
        $masaKerjaBulan = floor(($masaKerja % 365) / 30);
        $masaKerjaHari = $masaKerja % 30;

        $job = [
            'nama_instansi' => $validatedData['job']['nama_instansi'],
            'no_instansi' => $validatedData['job']['no_instansi'],
            'golongan_jabatan' => $validatedData['job']['golongan_jabatan'],
            'nip' => $validatedData['job']['nip'],
            'masa_kerja_hari' => $masaKerjaHari,
            'masa_kerja_bulan' => $masaKerjaBulan,
            'masa_kerja_tahun' => $masaKerjaTahun,
            'nama_atasan' => $validatedData['job']['nama_atasan'],
            'alamat_kantor' => $validatedData['job']['alamat_kantor'],
        ];

        $payload = [
            'nasabah' => [
                'nama' => $validatedData['nasabah']['nama'],
                'nik' => $validatedData['nasabah']['nik'],
                'tempat_lahir' => $validatedData['nasabah']['tempat_lahir'],
                'tanggal_lahir' => $validatedData['nasabah']['tanggal_lahir'],
                'jenis_kelamin' => $validatedData['nasabah']['jenis_kelamin'],
                'alamat_lengkap' => $validatedData['nasabah']['alamat_lengkap'],
                'kelurahan' => $validatedData['nasabah']['kelurahan'],
                'kecamatan' => $validatedData['nasabah']['kecamatan'],
                'kabupaten' => $validatedData['nasabah']['kabupaten'],
                'provinsi' => $validatedData['nasabah']['provinsi'],
                'kode_pos' => $validatedData['nasabah']['kode_pos'],
                'no_rekening_tabungan' => $validatedData['nasabah']['no_rekening_tabungan'],
                'no_hp' => $validatedData['nasabah']['no_hp'],
                'email' => $validatedData['nasabah']['email'],
                'ktp' => $ktpPath,
            ],
            'nama_ao' => $validatedData['nama_ao'],
            'jumlah_penghasilan' => $request->input('jumlah_penghasilan'),
            'jumlah_permohonan' => $request->input('jumlah_permohonan'),
            'jumlah_penghasilan_lainnya' => $request->input('jumlah_penghasilan_lainnya') ?? 0,
            'jangka_waktu' => $request->input('jangka_waktu'),
            'maksimal_pembiayaan' => $request->input('maksimal_pembiayaan'),
            'tujuan_pembiayaan' => $request->input('tujuan_pembiayaan'),
            'status_perkawinan' => $request->input('status_perkawinan'),
            'upload_npwp' => $npwpPath,
            'slip_gaji' => $slipGajiPath,
            'documents' => $documentPaths,
            'job' => $job,
            'financing_request' => $request->input('financing_request'),
        ];

        $response = Http::withToken(session('access_token'))
            ->post('https://apipermohonan.explorasi.com/api/applications', $payload);

        if ($response->successful()) {
            return redirect()->route('permohonan.index')->with([
                'success' => true,
                'message' => 'Permohonan berhasil disimpan!',
            ]);
        } else {
            return redirect()->back()->withInput()->withErrors([
                'message' => 'Permohonan gagal disimpan!',
            ]);
        }

    }

    public function showApplication($id)
    {
        if (!session()->has('access_token')) {
            return redirect()->route('login');
        }

        $response = Http::withToken(session('access_token'))->get('https://apipermohonan.explorasi.com/api/profile');

        // Check if the response is successful
        if ($response->successful()) {
            $userProfile = $response->json();
            $nama_oa = $userProfile['user']['name'];
        } else {
            // Handle error (e.g., log it, return an error message, etc.)
            return redirect()->route('login')->withErrors('Unable to fetch user profile');
        }

        $url = "https://apipermohonan.explorasi.com/api/applications/$id";
        $accessToken = session('access_token');
        $response = Http::withToken($accessToken)->get($url);

        if ($response->successful()) {
            $applicationData = $response->json('application');
            $masaKerjaHari = $applicationData['job']['masa_kerja_hari'];
            $masaKerjaBulan = $applicationData['job']['masa_kerja_bulan'];
            $masaKerjaTahun = $applicationData['job']['masa_kerja_tahun'];

            $startDate = Carbon::now()
                ->subDays($masaKerjaHari)
                ->subMonths($masaKerjaBulan)
                ->subYears($masaKerjaTahun)
                ->toDateString();

            $applicationData['job']['tanggal_mulai_kerja'] = $startDate;

            // dd($applicationData);

            return view('permohonan.show', ['application' => $applicationData]);
        } else {
            return redirect()->back()->withErrors([
                'message' => 'Gagal mengambil data aplikasi!'
            ]);
        }
    }
    public function edit(Request $request, $id)
    {
        // $id = $applications['id'];

        if (!session()->has('access_token')) {
            return redirect()->route('login');
        }

        // Ambil data existing berdasarkan ID
        $url = "https://apipermohonan.explorasi.com/api/applications/$id";
        $accessToken = session('access_token');
        $existingDatas = Http::withToken($accessToken)->get($url);
        if (!$existingDatas->successful()) {
            return redirect()->back()->withErrors(['message' => 'Data tidak ditemukan!']);
        }

        $existingData = $existingDatas->json('application');


        $validatedData = $request->validate([
            // Validasi Data Nasabah
            'nasabah.nama' => 'sometimes|required|string|max:255',
            'nasabah.nik' => 'sometimes|required|string|max:20',
            'nasabah.tempat_lahir' => 'sometimes|required|string|max:255',
            'nasabah.tanggal_lahir' => 'sometimes|required|date',
            'nasabah.jenis_kelamin' => 'sometimes|required|in:L,P',
            'nasabah.alamat_lengkap' => 'sometimes|required|string|max:255',
            'nasabah.kelurahan' => 'sometimes|required|string|max:255',
            'nasabah.kecamatan' => 'sometimes|required|string|max:255',
            'nasabah.kabupaten' => 'sometimes|required|string|max:255',
            'nasabah.provinsi' => 'sometimes|required|string|max:255',
            'nasabah.kode_pos' => 'sometimes|required|string|max:10',
            'nasabah.no_rekening_tabungan' => 'sometimes|required|string|max:20',
            'nasabah.no_hp' => 'sometimes|required|string|max:15',
            'nasabah.email' => 'sometimes|required|email|max:255',
            'nasabah.ktp' => 'sometimes|nullable|file|max:2048',

            // Validasi Informasi AO
            'nama_ao' => 'sometimes|required|string|max:255',

            // Validasi Permohonan
            'jumlah_penghasilan' => 'sometimes|required|numeric|min:0',
            'jumlah_permohonan' => 'sometimes|required|numeric|min:0',
            'jumlah_penghasilan_lainnya' => 'sometimes|nullable|numeric|min:0',
            'jangka_waktu' => 'sometimes|required|integer|min:1',
            'maksimal_pembiayaan' => 'sometimes|required|numeric|min:0',
            'tujuan_pembiayaan' => 'sometimes|required|string|max:255',
            'status_perkawinan' => 'sometimes|required',

            // Validasi Dokumen Pendukung
            // 'upload_npwp' => 'sometimes|nullable|file|max:2048',
            // 'slip_gaji' => 'sometimes|nullable|file|max:2048',

            // Validasi Informasi Pekerjaan
            'job.nama_instansi' => 'sometimes|required|string|max:255',
            'job.no_instansi' => 'sometimes|required|string|max:50',
            'job.golongan_jabatan' => 'sometimes|required|string|max:50',
            'job.nip' => 'sometimes|required|string|max:50',
            'job.masa_kerja' => 'sometimes|required',
            'job.nama_atasan' => 'sometimes|required|string|max:255',
            'job.alamat_kantor' => 'sometimes|required|string|max:255',

            // Validasi Permohonan Pembiayaan
            'financing_request.total_angsuran_biaya' => 'sometimes|required|numeric|min:0',
            'financing_request.jangka_waktu' => 'sometimes|required|integer|min:1',
            'financing_request.cabang' => 'sometimes|required|string|max:255',
            'financing_request.capem' => 'sometimes|required|string|max:255',
        ]);

        // Handle file uploads with additional checks
        $ktpPath = ($request->file('nasabah.ktp'))
        ? $request->file('nasabah.ktp')->store('uploads/ktp')
        : (isset($existingData['nasabah']['ktp']) ? $existingData['nasabah']['ktp'] : null);

        $npwpPath = $request->file('upload_npwp')
            ? $request->file('upload_npwp')->store('uploads/npwp')
            : (isset($existingData['upload_npwp']) ? $existingData['upload_npwp'] : null);

        $slipGajiPath = $request->file('slip_gaji')
            ? $request->file('slip_gaji')->store('uploads/slip_gaji')
            : (isset($existingData['slip_gaji']) ? $existingData['slip_gaji'] : null);


        $documentPaths = [];
        $documents = $request->input('documents', []);
        $files = $request->file('documents', []);

        $documentEntries = [];
        foreach ($documents as $doc) {
            if (isset($doc['name'])) {
                $documentEntries[] = [
                    'name' => $doc['name'],
                    'status' => '0',
                    'file_path' => null,
                ];
            }

            if (isset($doc['status'])) {
                $documentEntries[count($documentEntries) - 1]['status'] = '1'; // Update status

            }
        }

        foreach ($documentEntries as $index => &$entry) {
            if (isset($files[$index]['file_path']) && $request->hasFile("documents.$index.file_path")) {
                $entry['file_path'] = $files[$index]['file_path']->store('uploads/documents');
            } else {
                $entry['file_path'] = $existingData['documents'][$index]['file_path'] ?? null;
            }
            $documentPaths[] = $entry;
        }

        $tanggalMulaiKerja = $request->input('job.tanggal_mulai_kerja');
        $today = now();

        $masaKerja = $today->diffInDays($tanggalMulaiKerja);
        $masaKerjaTahun = floor($masaKerja / 365);
        $masaKerjaBulan = floor(($masaKerja % 365) / 30);
        $masaKerjaHari = $masaKerja % 30;

        $job = [
            'nama_instansi' => $validatedData['job']['nama_instansi'],
            'no_instansi' => $validatedData['job']['no_instansi'],
            'golongan_jabatan' => $validatedData['job']['golongan_jabatan'],
            'nip' => $validatedData['job']['nip'],
            'masa_kerja_hari' => $masaKerjaHari,
            'masa_kerja_bulan' => $masaKerjaBulan,
            'masa_kerja_tahun' => $masaKerjaTahun,
            'nama_atasan' => $validatedData['job']['nama_atasan'],
            'alamat_kantor' => $validatedData['job']['alamat_kantor'],
        ];

        $payload = [
            'nasabah' => [
                'nama' => $validatedData['nasabah']['nama'],
                'nik' => $validatedData['nasabah']['nik'],
                'tempat_lahir' => $validatedData['nasabah']['tempat_lahir'],
                'tanggal_lahir' => $validatedData['nasabah']['tanggal_lahir'],
                'jenis_kelamin' => $validatedData['nasabah']['jenis_kelamin'],
                'alamat_lengkap' => $validatedData['nasabah']['alamat_lengkap'],
                'kelurahan' => $validatedData['nasabah']['kelurahan'],
                'kecamatan' => $validatedData['nasabah']['kecamatan'],
                'kabupaten' => $validatedData['nasabah']['kabupaten'],
                'provinsi' => $validatedData['nasabah']['provinsi'],
                'kode_pos' => $validatedData['nasabah']['kode_pos'],
                'no_rekening_tabungan' => $validatedData['nasabah']['no_rekening_tabungan'],
                'no_hp' => $validatedData['nasabah']['no_hp'],
                'email' => $validatedData['nasabah']['email'],
                'ktp' => $ktpPath,
            ],
            'nama_ao' => $validatedData['nama_ao'],
            'jumlah_penghasilan' => $request->input('jumlah_penghasilan'),
            'jumlah_permohonan' => $request->input('jumlah_permohonan'),
            'jumlah_penghasilan_lainnya' => $request->input('jumlah_penghasilan_lainnya') ?? 0,
            'jangka_waktu' => $request->input('jangka_waktu'),
            'maksimal_pembiayaan' => $request->input('maksimal_pembiayaan'),
            'tujuan_pembiayaan' => $request->input('tujuan_pembiayaan'),
            'status_perkawinan' => $request->input('status_perkawinan'),
            'upload_npwp' => $npwpPath,
            'slip_gaji' => $slipGajiPath,
            'documents' => $documentPaths,
            'job' => $job,
            'financing_request' => $request->input('financing_request'),
        ];



        $response = Http::withToken(session('access_token'))
            ->put("https://apipermohonan.explorasi.com/api/applications/{$id}", $payload);

        if ($response->successful()) {
            return redirect()->route('permohonan.index')->with([
                'success' => true,
                'message' => 'Permohonan berhasil diperbarui!',
            ]);
        } else {
            return redirect()->back()->withErrors(['message' => 'Terjadi kesalahan saat memperbarui data!']);
        }
    }

    public function destroy($id)
    {
        $token = session('access_token');
        // dd($token);
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete("https://apipermohonan.explorasi.com/api/applications/{$id}");

        if ($response->successful()) {
            return redirect()->route('permohonan.index')->with([
                'success' => true,
                'message' => 'Application deleted successfully.'
            ]);
        } elseif ($response->failed()) {
            return redirect()->back()->withInput()->withErrors([
                'message' => 'Failed to delete application.',
            ]);
        }
        return redirect()->back()->withInput()->withErrors([
            'message' => 'An unexpected error occurred.',
        ]);
    }
}
