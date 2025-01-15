<?php

namespace App\Http\Controllers\Penduduk;

use App\Http\Controllers\Controller;
use App\Models\Birth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KelahiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $births = Birth::where('created_by', $user->id)->get();

        return view('penduduk.kelahiran.index', compact('births'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penduduk.kelahiran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $validatedData = $this->validateData($request);

        // if ($user->hasRole('penduduk') && isset($validatedData['nomor_surat'])) {
        //     unset($validatedData['nomor_surat']);
        // }

        $validatedData['created_by'] = $user->id;
        $validatedData['status_data'] = 'Diajukan';

        $validatedData['foto_kk'] = $this->handleFileUpload($request, 'foto_kk');
        $validatedData['foto_akta_lahir'] = $this->handleFileUpload($request, 'foto_akta_lahir');


        Birth::create($validatedData);

        return redirect()
            ->route('kelahiranpenduduk.index')
            ->with('success', 'Data kelahiran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $birth = Birth::findOrFail($id);
        return view('penduduk.kelahiran.detail', compact('birth'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $user = $request->user();

        // $validatedData = $this->validateData($request, $id);

        // if ($user->hasRole('penduduk')) {
        //     unset($validatedData['nomor_surat']);
        // }

        $birth = Birth::findOrFail($id);

        // Kembalikan view dengan data kelahiran untuk ditampilkan (hanya untuk melihat detail)
        return view('penduduk.kelahiran.detail', compact('birth'));

        // $validatedData['foto_kk'] = $this->handleFileUpload($request, 'foto_kk', $birth->foto_kk ?? null);
        // $validatedData['foto_akta_lahir'] = $this->handleFileUpload($request, 'foto_akta_lahir', $birth->foto_akta_lahir ?? null);

        // $birth->update($validatedData);

        // return redirect()
        //     ->route('kelahiranpenduduk.index')
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
        $birth = Birth::findOrFail($id);

        // Sanitize file name to prevent issues with invalid characters
        $safeNomorSurat = preg_replace('/[\/\\\\]/', '-', $birth->nomor_surat);

        try {
            $pdf = Pdf::loadView('admin.suratpdf.suratkelahiran', ['births' => $birth]);

            return $pdf->download('surat_kelahiran_' . $safeNomorSurat . '.pdf');
        } catch (\Exception $e) {
            return redirect()
                ->route('kelahiranpenduduk.index')
                ->with('error', 'Gagal mengunduh PDF: ' . $e->getMessage());
        }
    }

    /**
     * Validate the request data.
     */
    private function validateData(Request $request, $id = null)
    {
        return $request->validate([
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
            'foto_kk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_akta_lahir' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    }

}
