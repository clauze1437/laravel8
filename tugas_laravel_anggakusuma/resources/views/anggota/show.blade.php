@extends('layouts.index')
@section('content')
    @foreach ($ar_anggota as $agot)
        <div class="card" style="width: 22rem;">
            @php
            if(!empty($agot->foto)) {
            @endphp
                <img src="{{ asset('img')}}/{{ $agot->foto }}"/>
            @php
            } else {
            @endphp
                <img src="{{ asset('img')}}/kosong.png"/>
            @php
            }
            @endphp
            <div class="card-body">
                <h5 class="card-title">{{ $agot->nama }}</h5>
                <p class="card-text">
                    Email : {{ $agot->email }}
                    <br/>HP : {{ $agot->hp }}
                </p>
                <a href="{{ url('/anggota') }}" class="btn btn-primary">Go Back</a>
            </div>
        </div>
    @endforeach
@endsection