@extends('layouts.index')
@section('content')
@php
    $ar_judul = ['No','ISBN','Judul','Stok','Pengarang','Penerbit','Kategori','Action'];
    $no = 1;
@endphp
    <h3>Daftar Buku</h3>
    <a class="btn btn-primary btn-md" href="{{ route('buku.create') }}" role="button">Tambah Data</a>
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
            @foreach ($ar_buku as $bk)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $bk->isbn }}</td>
                    <td>{{ $bk->judul }}</td>
                    <td>{{ $bk->stok }}</td>
                    <td>{{ $bk->nama }}</td>
                    <td>{{ $bk->pgr }}</td>
                    <td>{{ $bk->katgor }}</td>
                    <td>
                        <form method="POST" action="{{ route('buku.destroy',$bk->id) }}">
                            @csrf
                            @method('delete')
                            <a class="btn btn-info" href="{{ route('buku.show',$bk->id) }}"><i class="fas fa-info-circle"></i></a>
                            <a class="btn btn-warning" href="{{ route('buku.edit',$bk->id) }}"><i class="fas fa-user-edit"></i></a>
                            <button class="btn btn-danger" onclick="return confirm('Anda Ingin Menghapus Data Ini?')"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection