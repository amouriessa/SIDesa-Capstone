<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataPersyaratan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataPersyaratanController extends Controller
{
    // Menampilkan semua data persyaratan
    public function index()
    {
        $data_persyaratan = DataPersyaratan::all(); // Mengambil semua data dari tabel
        return view('admin.datapersyaratan.index', compact('data_persyaratan'));
    }

    public function landingPage()
    {
        $data_persyaratan1 = DataPersyaratan::all(); // Mengambil semua data dari tabel
        return view('landingpage.welcome', compact('data_persyaratan1'));
    }

    // Menampilkan form untuk membuat data persyaratan baru
    public function create()
    {
        return view('admin.datapersyaratan.create');
    }

    // Menyimpan data persyaratan baru
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateData($request);

        $validatedData['gambar_lp'] = $this->handleFileUpload($request, 'gambar_lp', $data_persyaratan->gambar_lp ?? null);

        // Menyimpan file gambar jika ada
        // if ($request->hasFile('gambar_lp')) {
        //     $validated['gambar_lp'] = $request->file('gambar_lp')->store('data_persyaratan');
        // }

        // // Mengubah persyaratan_kelahiran dan persyaratan_kematian menjadi format JSON
        // $validated['persyaratan_kelahiran'] = $request->input('persyaratan_kelahiran');
        // $validated['persyaratan_kematian'] = $request->input('persyaratan_kematian');


        // Membuat data persyaratan baru di database
        DataPersyaratan::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('datapersyaratan.index')->with('success', 'Data persyaratan berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit data persyaratan
    public function edit($id)
    {
        $data_persyaratan = DataPersyaratan::findOrFail($id);
        return view('admin.datapersyaratan.edit', compact('data_persyaratan'));
    }

    // Mengupdate data persyaratan
    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $this->validateData($request, $id);
        $data_persyaratan = DataPersyaratan::findOrFail($id);

        $validatedData['gambar_lp'] = $this->handleFileUpload($request, 'gambar_lp', $data_persyaratan->gambar_lp ?? null);

        // // Menyimpan file gambar baru jika ada
        // if ($request->hasFile('gambar_lp')) {
        //     // Hapus gambar lama jika ada
        //     if ($data_persyaratan->gambar_lp && Storage::exists($data_persyaratan->gambar_lp)) {
        //         Storage::delete($data_persyaratan->gambar_lp);
        //     }
        //     // Simpan file baru
        //     $validated['gambar_lp'] = $request->file('gambar_lp')->store('data_persyaratan');
        // }

        // Update data persyaratan di database
        $data_persyaratan->update($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('datapersyaratan.index')->with('success', 'Data persyaratan berhasil diupdate.');
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


    // Menghapus data persyaratan
    public function destroy($id)
    {
        // Hapus gambar jika ada
        // if ($data_persyaratan->gambar_lp) {
        //     Storage::delete($data_persyaratan->gambar_lp);
        // }

        $data_persyaratan = DataPersyaratan::findOrFail($id);
        // Hapus data persyaratan
        $data_persyaratan->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('datapersyaratan.index')->with('success', 'Data persyaratan berhasil dihapus.');
    }

    public function showPersyaratan() {
        $data_persyaratan = DataPersyaratan::first(); // or any relevant query to fetch data
        return view('landingpage.welcome', compact('data_persyaratan'));
    }



    public function validateData(Request $request, $id = null)
    {
        return $request->validate([
            'tentang_website' => 'nullable|string',
            'persyaratan_kelahiran' => 'nullable|string',
            'persyaratan_kematian' => 'nullable|string',
            'gambar_lp' => 'nullable|image|max:2048',
        ]);
    }
}
