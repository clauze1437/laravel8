@extends('layouts.index')
@section('content')
    @foreach ($ar_buku as $bk)
        <div class="card" style="width: 19rem;">
            @php
            if(!empty($bk->cover)) {
            @endphp
                <img src="{{ asset('img')}}/{{ $bk->cover }}"/>
            @php
            } else {
            @endphp
                <img src="{{ asset('img')}}/kosong.png"/>
            @php
            }
            @endphp
            <div class="card-body">
                <h5 class="card-title">{{ $bk->judul }}</h5>
                <p class="card-text">
                    ISBN : {{ $bk->isbn }}
                    <br/>Tahun Cetak : {{ $bk->tahun_cetak }}
                    <br/>Stok : {{ $bk->stok }}
                    <br/>Pengarang : {{ $bk->nama }}
                    <br/>Penerbit : {{ $bk->pgr }}
                    <br/>Kategori : {{ $bk->katgor }}
                </p>
                <a href="{{ url('/buku') }}" class="btn btn-primary">Go Back</a>
            </div>
        </div>
    @endforeach
@endsection