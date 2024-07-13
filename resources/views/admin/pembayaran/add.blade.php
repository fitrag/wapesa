    @extends('layouts.app', ['title' => 'Tambah Pembayaran'])

    @push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('modules/jquery-ui/jquery-ui.min.js') }}"></script>

    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>

    <script>
        $('#formPembayaran').hide()

        const debounce = (func, delay) => {
            let debounceTimer
            return function(){
                const context = this
                const args = arguments
                clearTimeout(debounceTimer)
                debounceTimer = setTimeout(() => func.apply(context, args), delay)
            }
        }

        function getSiswa(id){
            console.log('Siswa dengan id :'+id)
            $('#tambahPembayaran').hide()
            $('#formPembayaran').show()
        }
        
        $('#query').on('keyup',debounce(function(e){
            $('#hasil').html('')
            if(this.value.length > 0){
                let bodyHTML
                $.ajax({
                    url:"{{ route('ajax-siswa-all') }}",
                    type:"POST",
                    data:{
                        '_token':"{{ csrf_token() }}",
                        'keyword' : this.value
                    },
                    success:function(res){
                        let respon = JSON.parse(res)
                        respon.forEach((data, index) => {
                            $('#hasil').append(`
                            <div class="d-flex justify-content-between bg-white p-3 mb-1 rounded align-items-center border">
                                <div>
                                    <div>${data.nm_siswa}</div>
                                    <div>Kelas : ${data.kelas.nm_kls}</div>
                                </div>
                                <a href="{{ url('admin/pembayaran/tambah/${data.id}') }}" class="btn btn-primary">Pilih</a>
                            </div>
                            
                            `)
                        })
                    }
                })
            
            }
        }, 1000))
    </script>
    @endpush

    @section('content')

    <section class="section">
        <div class="section-header">
        <h1>Tambah Pembayaran</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Pembayaran</a></div>
            <div class="breadcrumb-item">Tambah Pembayaran</div>
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
            
            <div id="tambahPembayaran">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="#" class="needs-validation" novalidate="">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-8 col-lg-10">
                                <input type="text" id="query" placeholder="NIS/Nama Siswa" class="form-control" name="query" tabindex="1" required autofocus>
                                @error('query')
                                    <div class="alert alert-danger">Form tidak boleh kosong</div>
                                @enderror
                                <div class="invalid-feedback">
                                Form tidak boleh kosong
                                </div>
                            </div>
                            <div class="col-4 col-lg-2">
                                <input type="submit" value="Cari" class="btn btn-primary btn-block btn-lg">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div id="hasil"></div>
            </div>
            </div>

        </div>
        </div>
    </section>

    @endsection