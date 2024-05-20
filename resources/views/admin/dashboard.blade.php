@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')

    <section class="section">
        <div class="section-header">
        <h1>Dashboard</h1>
        </div>

        <div class="section-body">
            @if(auth()->user()->level == 'guru')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="my-2 col-lg-4 d-flex justify-content-center align-items-center">
                            <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}" class="rounded-circle mr-1" style="width:100px">
                        </div>
                        <div class="my-2 col-lg-8">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>{{ auth()->user()->guru->nm_guru }}</td>
                                </tr>
                                <tr>
                                    <td>NIP</td>
                                    <td>:</td>
                                    <td>{{ auth()->user()->guru->nip }}</td>
                                </tr>
                                <tr>
                                    <td>NUPTK</td>
                                    <td>:</td>
                                    <td>{{ auth()->user()->guru->nuptk }}</td>
                                </tr>
                                @if(auth()->user()->is_walas)
                                <tr>
                                    <td>Wali Kelas</td>
                                    <td>:</td>
                                    <td>{{ auth()->user()->is_walas }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>

@endsection