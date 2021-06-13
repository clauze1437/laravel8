<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Buku;
use Symfony\Contracts\Service\Attribute\Required;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_buku = DB::table('buku')
            ->join('pengarang', 'pengarang.id', '=', 'buku.idpengarang')
            ->join('penerbit', 'penerbit.id', '=', 'buku.idpenerbit')
            ->join('kategori', 'kategori.id', '=', 'buku.idkategori')
            ->select('buku.*', 'pengarang.nama', 'penerbit.nama AS pgr', 'kategori.nama AS katgor')
            ->get();

        return view('buku.index', compact('ar_buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buku.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate(
            [
                'isbn' => 'required|numeric|unique:buku',
                'judul' => 'required',
                'tahun_cetak' => 'required|numeric',
                'stok' => 'required|numeric',
                'idpengarang' => 'required|numeric',
                'idpenerbit' => 'required|numeric',
                'idkategori' => 'required|numeric',
                'cover' => 'image|mimes:jpg,png|max:2048',
            ],

            [
                'isbn.required' => 'ISBN Wajib di Isi',
                'isbn.numeric' => 'ISBN Harus Berupa Angka',
                'isbn.unique' => 'ISBN Tidak Boleh Sama',
                'judul.required' => 'Judul Wajib di Isi',
                'tahun_cetak.required' => 'Tahun Cetak Wajib di Isi',
                'tahun_cetak.numeric' => 'Tahun Cetak Harus Berupa Angka',
                'stok.required' => 'Stok Wajib di Isi',
                'stok.numeric' => 'Stok Harus Berupa Angka',
                'idpengarang.required' => 'Pengarang Wajib di Isi',
                'idpenerbit.required' => 'Penerbit Wajib di Isi',
                'idkategori.required' => 'Kategori Buku Wajib di Isi',
                'cover.image' => 'File Ektensi Harus jpg,png',
                'cover.max' => 'Ukuran File Maksimal 2048 KB',
            ]
        );

        if (!empty($request->cover)) {
            $fileName = $request->isbn . '.' . $request->cover->extension();
            $request->cover->move(public_path('img'), $fileName);
        } else {
            $fileName = '';
        }

        DB::table('buku')->insert(
            [
                'isbn' => $request->isbn,
                'judul' => $request->judul,
                'tahun_cetak' => $request->tahun_cetak,
                'stok' => $request->stok,
                'idpengarang' => $request->idpengarang,
                'idpenerbit' => $request->idpenerbit,
                'idkategori' => $request->idpenerbit,
                'cover' => $fileName,
            ]
        );

        return redirect('/buku');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ar_buku = DB::table('buku')
            ->join('pengarang', 'pengarang.id', '=', 'buku.idpengarang')
            ->join('penerbit', 'penerbit.id', '=', 'buku.idpenerbit')
            ->join('kategori', 'kategori.id', '=', 'buku.idkategori')
            ->select('buku.*', 'pengarang.nama', 'penerbit.nama AS pgr', 'kategori.nama AS katgor')
            ->where('buku.id', $id)->get();

        return view('buku.show', compact('ar_buku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('buku')->where('id', $id)->get();

        return view('buku.form_edit', compact('data'));
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
        DB::table('buku')->where('id', $id)->update(
            [
                'isbn' => $request->isbn,
                'judul' => $request->judul,
                'tahun_cetak' => $request->tahun_cetak,
                'stok' => $request->stok,
                'idpengarang' => $request->idpengarang,
                'idpenerbit' => $request->idpenerbit,
                'idkategori' => $request->idpenerbit,
                'cover' => $request->cover,
            ]
        );

        return redirect('/buku' . '/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('buku')->where('id', $id)->delete();

        return redirect('/buku');
    }
}