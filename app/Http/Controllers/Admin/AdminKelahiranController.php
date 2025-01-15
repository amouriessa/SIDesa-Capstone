<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Birth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminKelahiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $user = $request->user();

        $user = Auth::user();
        $births = Birth::all();

        return view('admin.daftarpermohonan.kelahiran.index', compact('births'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.daftarpermohonan.kelahiran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $validatedData = $this->validateData($request);

        $validatedData['created_by'] = $user->id;
        $validatedData['status_data'] = $validatedData['status_data'] ?? 'Diajukan';

        $validatedData['foto_kk'] = $this->handleFileUpload($request, 'foto_kk', $birth->foto_kk ?? null);
        $validatedData['foto_akta_lahir'] = $this->handleFileUpload($request, 'foto_akta_lahir', $birth->foto_akta_lahir ?? null);

        Birth::create($validatedData);

        return redirect()
            ->route('kelahiranadmin.index')
            ->with('success', 'Data kelahiran berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $birth = Birth::findOrFail($id);
        return view('admin.daftarpermohonan.kelahiran.edit', compact('birth'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $this->validateData($request, $id);
        $birth = Birth::findOrFail($id);

        $validatedData['foto_kk'] = $this->handleFileUpload($request, 'foto_kk', $birth->foto_kk ?? null);
        $validatedData['foto_akta_lahir'] = $this->handleFileUpload($request, 'foto_akta_lahir', $birth->foto_akta_lahir ?? null);

        if ($request->input('status_data') === 'Ditolak') {
            $validatedData['alasan_gagal'] = $request->input('alasan_gagal');
        } else {
            $validatedData['alasan_gagal'] = null; // Hapus alasan_gagal jika status bukan Ditolak
        }

        $birth->update($validatedData);

        return redirect()
            ->route('kelahiranadmin.index')
            ->with('success', 'Data kelahiran berhasil diperbarui.');
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
        $birth = Birth::findOrFail($id);
        $birth->delete();

        return redirect()
            ->route('kelahiranadmin.index')
            ->with('success', 'Data kelahiran berhasil dihapus.');
    }

    public function downloadPdf($id)
    {
        $birth = Birth::findOrFail($id);

        // Sanitize file name to prevent issues with invalid characters
        $safeNomorSurat = preg_replace('/[\/\\\\]/', '-', $birth->nomor_surat);

        try {
            $pdf = Pdf::loadView('admin.suratpdf.suratkelahiran', ['births' => $birth]);

            return $pdf->download('surat_kelahiran_' . $safeNomorSurat . '.pdf');
        } catch (\Exception $e) {
            return redirect()
                ->route('kelahiranadmin.index')
                ->with('error', 'Gagal mengunduh surat kelahiran: ' . $e->getMessage());
        }
    }

    /**
     * Validate the request data.
     */
    private function validateData(Request $request, $id = null)
    {
        $uniqueRule = 'unique:births,nomor_surat';
        if ($id) {
            $uniqueRule .= ',' . $id;
        }

        $rules = [
            'nomor_surat' => ['required', 'string', 'max:50', $uniqueRule],
            'nama_anak' => 'required|string|max:255',
            'jenis_kelamin_anak' => 'required|in:Laki-laki,Perempuan',
            'hari_kelahiran' => 'required|string|max:50',
            'tanggal_kelahiran' => 'required|date',
            'tempat_kelahiran' => 'required|string|max:255',
            'alamat_anak' => 'required|string|max:500',
            'urutan_anak' => 'required|integer',
            'total_saudara' => 'required|integer',
            'nama_ayah' => 'required|string|max:255',
            'alamat_ayah' => 'required|string|max:500',
            'nama_ibu' => 'required|string|max:255',
            'alamat_ibu' => 'required|string|max:500',
            'status_data' => 'nullable|in:Diajukan,Ditolak,Disetujui',
            'foto_kk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_akta_lahir' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];

        if ($request->input('status_data') === 'Ditolak') {
            $rules['alasan_gagal'] = 'required|string|max:500';
        }

        return $request->validate($rules, [
            'nomor_surat.unique' => 'Nomor surat sudah digunakan. Silakan gunakan nomor lain.',
            'alasan_gagal.required' => 'Alasan penolakan harus diisi jika status Ditolak.',
        ]);
    }
}
