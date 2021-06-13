@extends('layouts.index')
@section('content')
@php
    $rs1 = App\Models\Pengarang::all();
    $rs2 = App\Models\Penerbit::all();
    $rs3 = App\Models\Kategori::all();
@endphp
    <h3>Form Edit Buku</h3>
    @foreach ($data as $rs)
        <form method="POST" action="{{ route('buku.update',$rs->id) }}">
            @csrf
            @method('put')
            <div class="form-group">
            <label>ISBN</label>
            <input type="text" name="isbn" value="{{ $rs->isbn }}" class="form-control"/>
        </div>
        <div class="form-group">
            <label>Judul Buku</label>
            <input type="text" name="judul" value="{{ $rs->judul }}" class="form-control"/>
        </div>
        <div class="form-group">
            <label>Tahun Cetak</label>
            <input type="text" name="tahun_cetak" value="{{ $rs->tahun_cetak }}" class="form-control"/>
        </div>
        <div class="form-group">
            <label>Stok</label>
            <input type="text" name="stok" value="{{ $rs->stok }}" class="form-control">
        </div>
        <div class="form-group">
            <label>Pengarang</label>
            <select class="form-control" name="idpengarang">
            <option value="">-- Pilih Pengarang --</option>
            @foreach ($rs1 as $pgr)
            @php
                $sel1 = ($pgr->id == $rs->idpengarang) ? 'selected' : '';
            @endphp
                <option value="{{ $pgr->id }}" {{ $sel1 }}>{{ $pgr->nama }}</option>
            @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Penerbit</label>
            <select class="form-control" name="idpenerbit" required>
            <option value="">-- Pilih Penerbit --</option>
            @foreach ($rs2 as $pnb)
            @php
                $sel2 = ($pnb->id == $rs->idpenerbit) ? 'selected' : '';
            @endphp
                <option value="{{ $pnb->id }}" {{ $sel2 }}>{{ $pnb->nama }}</option>
            @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Kategori</label><br/>
            @foreach ($rs3 as $katgor)
            @php
                $cek = ($katgor->id == $rs->idkategori) ? 'checked' : '';
            @endphp
                <input type="radio" name="idkategori" 
                value="{{ $katgor->id }}" {{ $cek }} required/> {{ $katgor->nama }} &nbsp;
            @endforeach
        </div>
        <div class="form-group">
                <label>Foto Pengarang</label>
                <input type="text" name="cover" value="{{ $rs->cover }}" class="form-control"/>
            </div>
            <button type="submit" class="btn btn-primary" name="proses">Edit</button>
            <a href="{{ url('/buku') }}" class="btn btn-danger">Cancel</a>
        </form>
    @endforeach
@endsection