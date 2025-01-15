<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Death;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminKematianController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua data kematian dari database
        $user = Auth::user();
        $deaths = Death::all();
        return view('admin.daftarpermohonan.kematian.index', compact('deaths'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan form untuk menambahkan data kematian
        return view('admin.daftarpermohonan.kematian.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $validatedDataKem = $this->validateDataKem($request);

        $validatedDataKem['created_by'] = $user->id;
        $validatedDataKem['status_data'] = $validatedDataKem['status_data'] ?? 'Diajukan';

        $validatedDataKem['foto_kk'] = $this->handleFileUpload($request, 'foto_kk', $death->foto_kk ?? null);
        $validatedDataKem['foto_ktp'] = $this->handleFileUpload($request, 'foto_ktp', $death->foto_ktp ?? null);

        // Simpan data ke database
        Death::create($validatedDataKem);

        return redirect()
            ->route('kematianadmin.index')
            ->with('success', 'Data kematian berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Temukan data kematian berdasarkan ID
        $death = Death::findOrFail($id);
        return view('admin.daftarpermohonan.kematian.edit', compact('death'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data input
        $validatedDataKem = $this->validateDataKem($request, $id);

        // Perbarui data di database
        $death = Death::findOrFail($id);

        $validatedDataKem['foto_kk'] = $this->handleFileUpload($request, 'foto_kk', $death->foto_kk ?? null);
        $validatedDataKem['foto_ktp'] = $this->handleFileUpload($request, 'foto_ktp', $death->foto_ktp ?? null);

        if ($request->input('status_data') === 'Ditolak') {
            $validatedDataKem['alasan_gagal'] = $request->input('alasan_gagal');
        } else {
            $validatedDataKem['alasan_gagal'] = null; // Hapus alasan_gagal jika status bukan Ditolak
        }

        $death->update($validatedDataKem);

        return redirect()->route('kematianadmin.index')->with('success', 'Data kematian berhasil diperbarui.');
    }

    private function handleFileUpload(Request $request, $key, $currentFile = null)
    {
        if ($request->hasFile($key)) {
            if ($currentFile && Storage::exists($currentFile)) {
                Storage::delete($currentFile);
            }
            return $request->file($key)->store($key, 'public');
        }
        return $currentFile;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Hapus data kematian
        $death = Death::findOrFail($id);
        $death->delete();

        return redirect()->route('kematianadmin.index')->with('success', 'Data kematian berhasil dihapus.');
    }

    public function downloadPdf($id)
    {
        $death = Death::findOrFail($id);

        // Sanitize file name to prevent issues with invalid characters
        $safeNomorSurat = preg_replace('/[\/\\\\]/', '-', $death->nomor_surat);

        try {
            $pdf = Pdf::loadView('admin.suratpdf.suratkematian', ['deaths' => $death]);

            return $pdf->download('surat_kematian_' . $safeNomorSurat . '.pdf');
        } catch (\Exception $e) {
            return redirect()
                ->route('kematianadmin.index')
                ->with('error', 'Gagal mengunduh surat kematian: ' . $e->getMessage());
        }
    }

    private function validateDataKem(Request $request, $id = null)
    {
        $uniqueRule = 'unique:deaths,nomor_surat_kematian';
        if ($id) {
            $uniqueRule .= ',' . $id;
        }

        $rules = [
            'nomor_surat_kematian' => ['required', 'string', 'max:50', $uniqueRule],
            'nama_alm' => 'required|string|max:255',
            'jenis_kelamin_alm' => 'required|in:Laki-laki,Perempuan',
            'alamat_alm' => 'required|string|max:500',
            'hari_kematian' => 'required|string|max:50',
            'tanggal_kematian' => 'required|date',
            'pukul_kematian' => 'required|string|max:10',
            'tempat_kematian' => 'required|string|max:255',
            'penyebab_kematian' => 'required|string|max:500',
            'umur_almarhum' => 'required|string|max:255',
            'status_data' => 'nullable|in:Diajukan,Ditolak,Disetujui',
            'foto_kk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_ktp' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];

        if ($request->input('status_data') === 'Ditolak') {
            $rules['alasan_gagal'] = 'required|string|max:500';
        }

        return $request->validate($rules, [
            'nomor_surat_kematian.unique' => 'Nomor surat sudah digunakan. Silakan gunakan nomor lain.',
            'alasan_gagal.required' => 'Alasan penolakan harus diisi jika status Ditolak.',
        ]);
    }
}
