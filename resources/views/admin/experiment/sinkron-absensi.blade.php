@extends('layouts.app', ['title' => 'Experiment'])

@push('scripts')

<script>
    function sinkronAbsen(){
        $.ajax({
            headers:{
                'Access-Control-Allow-Origin': '*' 
            },
            url:"{{ route('sinkron-absensi-proses') }}",
            type:"POST",
            data:{
                '_token':"{{ @csrf_token() }}"
            },
            success:function(e){
                const data = JSON.parse(e)
                if(data.statusCode == 200){
                    $('#berhasil').html(data.message)
                    $('#berhasil').removeClass('d-none')
                }else{
                    $('#gagal').html(data.message)
                    $('#gagal').removeClass('d-none')
                }
            }
        })
    }
</script>

@endpush

@section('content')

    <section class="section">
        <div class="section-header">
        <h1>Sinkron Absensi</h1>
        </div>

        <div class="section-body">
            <div class="alert alert-danger d-none" id="gagal"></div>
            <div class="alert alert-success d-none" id="berhasil"></div>
            <div class="card">
                <div class="card-body">
                    <button onclick="sinkronAbsen()" class="btn btn-success btn-lg w-100">Sinkron Absensi</button>
                </div>
            </div>
        </div>
    </section>

@endsection