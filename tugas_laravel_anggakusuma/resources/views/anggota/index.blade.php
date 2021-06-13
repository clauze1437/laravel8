@extends('layouts.index')
@section('content')
@php
    $ar_judul = ['No','Nama','Email','HP','Foto','Action'];
    $no = 1;
@endphp
    <h3>Daftar Anggota</h3>
    <a class="btn btn-primary btn-md" href="{{ route('anggota.create') }}" role="button">Tambah Data</a>
    <br/>
    <table class="table table-striped">
        <thead>
            <tr>
                @foreach ($ar_judul as $jud)
                    <th>{{ $jud }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($ar_anggota as $agot)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $agot->nama }}</td>
                    <td>{{ $agot->email }}</td>
                    <td>{{ $agot->hp }}</td>
                    <td width="15%" align="center">
                        @php
                        if(!empty($agot->foto)) {
                        @endphp
                            <img src="{{ asset('img')}}/{{ $agot->foto }}" width="50%" />
                        @php
                        } else {
                        @endphp
                            <img src="{{ asset('img')}}/kosong.png" width="50%" />
                        @php
                        }
                        @endphp
                    </td>
                    <td>
                        <form method="POST" action="{{ route('anggota.destroy',$agot->id) }}">
                            @csrf
                            @method('delete')
                            <a class="btn btn-info" href="{{ route('anggota.show',$agot->id) }}"><i class="fas fa-info-circle"></i></a>
                            <a class="btn btn-warning" href="{{ route('anggota.edit',$agot->id) }}"><i class="fas fa-user-edit"></i></a>
                            <button class="btn btn-danger" onclick="return confirm('Anda Ingin Menghapus Data Ini?')"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection