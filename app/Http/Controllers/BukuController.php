<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view('buku.index',['data_buku'=>Buku::paginate(5)] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customMessages = [
            'judul.required' => 'Kolom judul wajib diisi.',
            'judul.string' => 'Kolom judul harus berisi teks.',
            'penulis.required' => 'Kolom penulis wajib diisi.',
            'penulis.string' => 'Kolom penulis harus berisi teks.',
            'penulis.max' => 'Kolom penulis maksimal 30 karakter.',
            'harga.required' => 'Kolom harga wajib diisi.',
            'harga.numeric' => 'Kolom harga harus berisi angka.',
            'tgl_terbit.required' => 'Kolom tanggal terbit wajib diisi.',
            'tgl_terbit.date' => 'Kolom tanggal terbit harus berisi tanggal yang valid.',
        ];
        
        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
        ], $customMessages);

        $buku = new Buku;
        $buku->judul = $request->input('judul');
        $buku->penulis = $request->input('penulis');
        $buku->harga = $request->input('harga');

        $tgl_terbit = \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('tgl_terbit'));
        $buku->tgl_terbit = $tgl_terbit->format('Y-m-d');
        
        $buku->save();
        
        return redirect('/buku')->with ('pesan', 'Data Buku Berhasil di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $buku = Buku::find($id);
            return view('buku.update',compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customMessages = [
            'judul.required' => 'Kolom judul wajib diisi.',
            'judul.string' => 'Kolom judul harus berisi teks.',
            'penulis.required' => 'Kolom penulis wajib diisi.',
            'penulis.string' => 'Kolom penulis harus berisi teks.',
            'penulis.max' => 'Kolom penulis maksimal 30 karakter.',
            'harga.required' => 'Kolom harga wajib diisi.',
            'harga.numeric' => 'Kolom harga harus berisi angka.',
            'tgl_terbit.required' => 'Kolom tanggal terbit wajib diisi.',
            'tgl_terbit.date' => 'Kolom tanggal terbit harus berisi tanggal yang valid.',
        ];
        
        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
        ], $customMessages);

        $buku = Buku::find($id);
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;

        $tgl_terbit = \Carbon\Carbon::createFromFormat('Y-m-d', $request->tgl_terbit);
        $buku->tgl_terbit = $tgl_terbit->format('Y-m-d');
    
        $buku->save();
        return redirect('/buku')->with('pesan', 'Data Buku Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Buku::find($id);
        if ($buku) {
            $buku->delete();
        }
        return redirect('/buku')->with('pesan', 'Data Buku Berhasil Dihapus');
    }

    // * FUNGSI SEARCH
    public function search(Request $request){
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'like', "%".$cari."%")->orwhere('penulis', 'like', "%".$cari."%")
            ->paginate($batas);
        $jumlah_buku = Buku::count();
        $no = 1 + ($batas * ($data_buku->currentPage() - 1));
        return view('buku.search', compact('data_buku','no', 'jumlah_buku', 'cari'));
    }
}
