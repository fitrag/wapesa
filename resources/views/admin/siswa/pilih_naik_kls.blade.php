@extends('layouts.app', ['title' => 'Update Naik Kelas'])

@section('content')

<section class="section">
    <div class="section-header">
      <h1>Update Naik Kelas</h1>
      <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Master</a></div>
          <div class="breadcrumb-item">Update Naik Kelas</div>
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
                <form action="{{ route('siswa.create') }}" method="get">
                    <div class="row align-items-center">
                        <div class="mb-3 col-lg-10">
                            <label for="" class="form-label">Kelas</label>
                            <select name="kls_id" class="form-control">
                                <option value="">Pilih Kelas</option>
                                @foreach($kelas as $item)
                                    <option value="{{ $item->id }}" {{ (request()->kls_id == $item->id) ? 'selected' : '' }}>{{ $item->nm_kls }}</option>
                                @endforeach
                            </select>
                            @error('kls_id')
                                <span class="text-danger">Kelas belum dipilih</span>
                            @enderror
                        </div>
                        <div class="col-lg-2 mb-3">
                            <input type="submit" value="GO" class="btn btn-primary btn-md w-100">
                        </div>
                    </div>
                </form>
                <div class="mt-3">
                    <form action="{{url('admin/siswa/update_kelas')}}" method="post">
                        @csrf
                        <input type="hidden" name="kls_id" value="{{ request()->kls_id ? request()->kls_id : ''  }}">
                        <div class="table-responsive">
                            <table class="table table table-bordered">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Kelas Lama</th>
                                        <th>Naik Ke Kelas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($siswa as $item)
                                    <input type="hidden" name="nis[]" value="{{ $item->nis }}">
                                    <input type="hidden" name="siswa_id[]" value="{{ $item->id }}">
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nis }}</td>
                                            <td>{{ $item->nm_siswa }}</td>
                                            <td>{{ $item->nm_kls }}</td>
                                            <td>
                                                <select name="kelas_id[]" id="" class="form-control">
                                                    <option value="">Pilih kelas</option>
                                                    @foreach($kelas as $item)
                                                        <option value="{{$item->id}}">{{$item->nm_kls}}</option>
                                                    @endforeach
                                                </select>
                                                    @error('kelas_id.*')
                                                        <span class="text-danger my-1">Naik ke kelas harus dipilih</span>
                                                    @enderror
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if(request()->kls_id)
                            <input type="submit" value="Simpan" class="btn btn-primary w-100">
                        @endif
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

@endsection