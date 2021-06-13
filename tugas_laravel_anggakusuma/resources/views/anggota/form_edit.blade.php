@extends('layouts.index')
@section('content')
    <h3>Form Edit Anggota</h3>
    @foreach ($data as $rs)
        <form method="POST" action="{{ route('anggota.update',$rs->id) }}">
            @csrf
            @method('put')
            <div class="form-group">
                <label>Nama Anggota</label>
                <input type="text" name="nama" value="{{ $rs->nama }}" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Email Anggota</label>
                <input type="text" name="email" value="{{ $rs->email }}" class="form-control"/>
            </div>
            <div class="form-group">
                <label>HP Anggota</label>
                <input type="text" name="hp" value="{{ $rs->hp }}" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Foto Anggota</label>
                <input type="text" name="foto" value="{{ $rs->foto }}" class="form-control"/>
            </div>
            <button type="submit" class="btn btn-primary" name="proses">Edit</button>
            <a href="{{ url('/anggota') }}" class="btn btn-danger">Cancel</a>
        </form>
    @endforeach
@endsection