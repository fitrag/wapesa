@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')

    <section class="section">
        <div class="section-header">
        <h1>Dashboard</h1>
        </div>

        <div class="section-body">
            @if(auth()->user()->level == 'guru')
                <x-wali-kelas/>
                <x-guru/>
            @endif
        </div>
    </section>

@endsection