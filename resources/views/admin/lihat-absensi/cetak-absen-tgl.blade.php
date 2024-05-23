@extends('layouts.app', ['title' => 'Cetak Absensi Pertanggal'])

@section('content')

<section class="section">
    <div class="section-header">
      <h1>Cetak Absensi Berdasarkan Tanggal</h1>
      <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Absensi</a></div>
          <div class="breadcrumb-item">Cetak Absensi</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
          <div class="card">
            <div class="card-body">
                  <form method="POST" action="{{ route('proses_cetakabsensi_tgl') }}" enctype="multipart/form-data" target="_blank">
                      {{ csrf_field() }}
                        <div class="row py-3">
                            <div class="col-md-4">
                                <select class="form-control" name="id_kls" required="">
                                    <option value="">(Pilih Kelas)</option>
                                    @foreach($kelas as $item)
                                        <option value="{{$item->id}}">{{$item->nm_kls}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Dari Tanggal</label>
                                    <input id="tgl" type="date"" name="tgl_awal" value="{{ date('Y-m-d') }}" id="tgl_awal" class="date form-control @error('tgl_awal') is-invalid @enderror" placeholder="yyyy/mm/dd" >
                                    @error('tgl_awal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Sampai Tanggal</label>
                                    <input id="tgl" type="date"" name="tgl_akhir" value="{{ date('Y-m-d') }}" id="tgl_akhir" class="date form-control @error('tgl_akhir') is-invalid @enderror" placeholder="yyyy/mm/dd" >
                                    @error('tgl_akhir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary pull-left mr-2" id="submit">
                                    Go
                        </button>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
</section>

@endsection

