<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $barang = Barang::latest()->paginate(5);

        return view('dashboard', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
     {
         $request->validate([
             'gambar'        => 'image|mimes:jpeg,jpg,png|max:2048',
             'barang'        => 'required|min:1',
             'kategori'      => 'required|min:1',
             'harga'         => 'required|numeric',
             'stok'          => 'required|numeric',
             'tgl_publish'   => 'required|min:1',
         ]);
     
         $gambar = $request->file('gambar');
         $gambarPath = $gambar->store('public/barang');
     
         Barang::create([
             'gambar'       => basename($gambarPath),
             'barang'       => $request->barang,
             'kategori'     => $request->kategori,
             'harga'        => $request->harga,
             'stok'         => $request->stok, 
             'tgl_publish'  => $request->tgl_publish, 
         ]);
     
         return redirect()->route('dashboard')->with(['success' => 'Data Berhasil Disimpan!']);
     }

    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);

        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'gambar'        => 'image|mimes:jpeg,jpg,png|max:2048',
            'barang'        => 'required|min:1',
            'kategori'      => 'required|min:1',
            'harga'         => 'required|numeric',
            'stok'          => 'required|numeric',
            'tgl_publish'   => 'min:1',
        ]);

        $barang = Barang::findOrFail($id);

        if ($request->hasFile('gambar')) {

            $gambar = $request->file('gambar');
            $gambarPath = $gambar->store('public/barang');

            Storage::delete('public/barang/'.$barang->gambar);

            $barang->update([
                'gambar'       => basename($gambarPath),
                'barang'       => $request->barang,
                'kategori'     => $request->kategori,
                'harga'        => $request->harga,
                'stok'         => $request->stok,
                'tgl_publish'  => $request->tgl_publish,
            ]);

        } else {

            $barang->update([
                'barang'       => $request->barang,
                'kategori'     => $request->kategori,
                'harga'        => $request->harga,
                'stok'         => $request->stok,
                'tgl_publish'  => $request->tgl_publish,
            ]);
        }

        return redirect()->route('dashboard')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        $barang = Barang::findOrFail($id);

        Storage::delete('public/barang/'. $barang->gambar);

        $barang->delete();

        return redirect()->route('dashboard')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $barang = Barang::where('barang', 'LIKE', "%$search%")->paginate(5);
        return view('dashboard', compact('barang'));
    }

    public function publish() : View
    {
        $barang = Barang::latest()->paginate(5);

        return view('barang.publish', compact('barang'));
    }
}
