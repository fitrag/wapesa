<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="my-2 col-lg-4 d-flex justify-content-center align-items-center">
                <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}" class="mr-1" style="width:100%">
            </div>
            <div class="my-2 col-lg-8">
                <table class="table table-bordered">
                    <tr>
                        <td>Nama</td>
                        <td>{{ auth()->user()->guru->nm_guru }}</td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td>{{ auth()->user()->guru->nip }}</td>
                    </tr>
                    <tr>
                        <td>NUPTK</td>
                        <td>{{ auth()->user()->guru->nuptk }}</td>
                    </tr>
                    @if(auth()->user()->is_walas)
                    <tr>
                        <td>Wali Kelas</td>
                        <td>{{ auth()->user()->wali_kelass()->latest()->first()?->kelas->nm_kls }}</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>