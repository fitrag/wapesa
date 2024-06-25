<form method="POST" action="" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="">
                            @if(Auth::user()->level === "admin")
                                <div class="form-group">
                                    <label for="alias">Nama Guru</label>
                                    <select class="form-control" name="guru_id">
                                        < @foreach($guru as $item)
                                            <option value="{{$item->kon_id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            @else
                                <div class="form-group">
                                    <label for="alias">Nama Guru</label>
                                    <select class="form-control" name="guru_id">
                                        <option value="{{ $guru_id->id }}">{{ $guru_id->nm_guru}}</option>
                                    </select>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="alias">Mata Pelajaran</label>
                                <select class="form-control" name="mapel_id">
                                    @foreach($mapel as $item)
                                        <option value="{{$item->mapel_id}}">{{$item->alias}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="alias">Kelas</label>
                                <select class="form-control" name="kelas_id">
                                    @foreach($kelas as $item)
                                        <option value="{{$item->id}}">{{$item->nm_kls}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="alias">Tahun Pelajaran</label>
                                <select class="form-control" name="tp_id">
                                    @foreach($tp as $item)
                                        <option value="{{$item->id}}">{{$item->nm_tp}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Tanggal</label>
                                <input id="tgl" type="date" class="form-control" value="{{ date('Y-m-d') }}" name="tgl" tabindex="1"  required autofocus>
                                @error('tgl')
                                <div class="alert alert-danger">Mohon di isi tanggal</div>
                                @enderror
                                <div class="invalid-feedback">
                                Mohon di isi tanggal 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Jam Ke</label>
                                <input id="jamke" type="text" class="form-control"  name="jamke" value="{{ old('jamke') }}"  placeholder="contoh: 1 - 3">
                                @error('jamke')
                                    <div class="alert alert-danger">Mohon di isi Jam Ke</div>
                                @enderror
                                <div class="invalid-feedback">
                                    Mohon di isi Jam Ke 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Kompetensi dasar / materi pokok / sub materi</label>
                                <textarea name="materi" class="form-control" id="" cols="30" rows="6" >{{ old('materi') }}</textarea>
                                @error('materi')
                                    <div class="alert alert-danger">Mohon di isi materi</div>
                                @enderror
                                <div class="invalid-feedback">
                                    Mohon di isi materi 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Pertemuan Ke (contoh: 1 )</label>
                                <input id="tmke" type="number" class="form-control"  name="tmke" value="{{ old('tmke') }}">
                                @error('tmke')
                                    <div class="alert alert-danger">Mohon di isi pertemuan ke</div>
                                @enderror
                                <div class="invalid-feedback">
                                    Mohon di isi pertemuan ke 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Selesai/tidak selesai, alasan</label>
                                <textarea name="status" class="form-control" id="" cols="30" rows="6">{{ old('status') }}</textarea>
                                @error('status')
                                    <div class="alert alert-danger">Mohon di isi selesai/tidak selesai</div>
                                @enderror
                                <div class="invalid-feedback">
                                    Mohon di isi selesai/tidak selesai 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Absensi (contoh: Nihil / Anis (S) / Adi (I))</label>
                                <textarea name="absensi" class="form-control" id="" cols="30" rows="6">{{ old('absensi') }}</textarea>
                                @error('absensi')
                                    <div class="alert alert-danger">Mohon di isi absensi</div>
                                @enderror
                                <div class="invalid-feedback">
                                    Mohon di isi absensi 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Keterangan (contoh: Alpha lari jam ke-4)</label>
                                <textarea name="ket" class="form-control" id="" cols="30" rows="6">{{ old('ket') }}</textarea>
                                @error('ket')
                                    <div class="alert alert-danger">Mohon di isi keterangan</div>
                                @enderror
                                <div class="invalid-feedback">
                                    Mohon di isi keterangan 
                                </div>
                            </div>

                            

                            <button type="submit" class="btn btn-primary pull-left mr-1" id="submit">
                                        Simpan
                            </button>
                            <a href="{{route('jurnal.index')}}" class="btn btn-dark pull-left">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>