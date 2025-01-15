<?php

namespace App\Http\Controllers\Penduduk;

use App\Http\Controllers\Controller;
use App\Models\Death;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KematianController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        // Ambil semua data kematian dari database
        $deaths = Death::where('created_by', $user->id)->get();

        return view('penduduk.kematian.index', compact('deaths'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan form untuk menambahkan data kematian
        return view('penduduk.kematian.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $validatedData = $this->validateDataKem($request);

        $validatedData['created_by'] = $user->id;
        $validatedData['status_data'] = 'Diajukan';

        // if ($request->hasFile('foto_persyaratan')) {
        //     $file = $request->file('foto_persyaratan');
        //     $filename = time() . '.' . $file->getClientOriginalExtension();
        //     $path = $file->storeAs('foto_persyaratan', $filename, 'public'); // Menyimpan di storage/app/public/foto_persyaratan

        //     // Add the file path to validated data
        //     $validatedData['foto_persyaratan'] = $path; // Simpan path yang benar
        // }

        $validatedData['foto_kk'] = $this->handleFileUpload($request, 'foto_kk');
        $validatedData['foto_ktp'] = $this->handleFileUpload($request, 'foto_ktp');

        Death::create($validatedData);

        return redirect()->route('kematianpenduduk.index')->with('success', 'Data kematian berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $death = Death::findOrFail($id);
        return view('penduduk.kematian.detail', compact('death'));
    }

    public function update(Request $request, $id)
    {
        // $validatedData = $this->validateDataKem($request, $id);

        $death = Death::findOrFail($id);

        return view('penduduk.kematian.detail', compact('death'));

        // if ($request->hasFile('foto_persyaratan')) {
        //     // Hapus file lama jika ada
        //     if ($death->foto_persyaratan && Storage::exists($death->foto_persyaratan)) {
        //         Storage::delete($death->foto_persyaratan);
        //     }

        //     // Simpan file baru
        //     $filePath = $request->file('foto_persyaratan')->store('foto_persyaratan', 'public');
        //     $validatedData['foto_persyaratan'] = $filePath;
        // } else {
        //     // Jika tidak ada file baru, gunakan data lama
        //     $validatedData['foto_persyaratan'] = $death->foto_persyaratan;
        // }

        // $death->update($validatedData);

        // return redirect()
        //     ->route('kematianpenduduk.index')
        //     ->with('success', 'Data kelahiran berhasil diperbarui.');
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

    public function downloadPdf($id)
    {
        $death = Death::findOrFail($id);

        // Sanitize file name to prevent issues with invalid characters
        $safeNomorSurat = preg_replace('/[\/\\\\]/', '-', $death->nomor_surat_kematian);

        try {
            $pdf = Pdf::loadView('admin.suratpdf.suratkematian', ['deaths' => $death]);

            return $pdf->download('surat_kematian_' . $safeNomorSurat . '.pdf');
        } catch (\Exception $e) {
            return redirect()
                ->route('kematianpenduduk.index')
                ->with('error', 'Gagal mengunduh PDF: ' . $e->getMessage());
        }
    }

    private function validateDataKem(Request $request, $id = null)
    {
        return $request->validate([
            'nama_alm' => 'required|string|max:255',
            'jenis_kelamin_alm' => 'required|in:Laki-laki,Perempuan',
            'alamat_alm' => 'required|string|max:500',
            'hari_kematian' => 'required|string|max:50',
            'tanggal_kematian' => 'required|date',
            'pukul_kematian' => 'required|string|max:10',
            'tempat_kematian' => 'required|string|max:255',
            'penyebab_kematian' => 'required|string|max:500',
            'umur_almarhum' => 'required|string|max:255',
            'foto_kk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_ktp' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    }
}
