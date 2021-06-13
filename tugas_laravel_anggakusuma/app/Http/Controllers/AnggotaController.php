<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Anggota;
use Illuminate\Support\Facades\Redirect;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_anggota = DB::table('anggota')
            ->get();

        return view('anggota.index', compact('ar_anggota'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('anggota.form');
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
                'nama' => 'required',
                'email' => 'required',
                'hp' => 'required|numeric',
                'foto' => 'image|mimes:jpg,png|max:2048',
            ],

            [
                'nama.required' => 'Nama Wajib di Isi',
                'email.required' => 'Email Wajib di Isi',
                'hp.required' => 'No. HP Wajib di Isi',
                'hp.numeric' => 'No. HP Harus Berupa Angka',
                'foto.image' => 'File Ektensi Harus jpg,png',
                'foto.max' => 'Ukuran File Maksimal 2048 KB',
            ]
        );

        if (!empty($request->foto)) {
            $fileName = $request->nama . '.' . $request->foto->extension();
            $request->foto->move(public_path('img'), $fileName);
        } else {
            $fileName = '';
        }

        DB::table('anggota')->insert(
            [
                'nama' => $request->nama,
                'email' => $request->email,
                'hp' => $request->hp,
                'foto' => $fileName,
            ]
        );

        return redirect('/anggota');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ar_anggota = DB::table('anggota')->where('anggota.id', $id)->get();

        return view('anggota.show', compact('ar_anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('anggota')->where('id', $id)->get();

        return view('anggota.form_edit', compact('data'));
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
        DB::table('anggota')->where('id', $id)->update(
            [
                'nama' => $request->nama,
                'email' => $request->email,
                'hp' => $request->hp,
                'foto' => $request->foto,
            ]
        );

        return redirect('/anggota' . '/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('anggota')->where('id', $id)->delete();

        return redirect('/anggota');
    }
}
