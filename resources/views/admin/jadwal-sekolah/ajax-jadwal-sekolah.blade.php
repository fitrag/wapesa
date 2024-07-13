<div class="row">
    <div class="col-xl-2 col-lg-4 col-md-3 hari py-3" style="min-height:200px" data-hari="Senin">
        <h6>Senin</h6>
        @foreach($kelas->jadwal_sekolahs()->orderBy('updated_at')->whereHari('senin')->get() as $jadwal)
            <div class="kartu border mb-1 p-2 rounded" draggable="true" data-id="{{ $jadwal->id }}">
                <div class="row align-items-center">
                    <div class="col-9">{{ $jadwal->mapel->nm_mapel }}</div>
                    <div class="col-3">
                        <a href="{{ route('admin.jadwal-sekolah.delete', ['id'=> $jadwal->id]) }}">
                            <span class="close" style="font-size:13px">&times;</span>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-xl-2 col-lg-4 col-md-3 hari py-3" style="min-height:200px" data-hari="Selasa">
        <h6>Selasa</h6>
        @foreach($kelas->jadwal_sekolahs()->orderBy('updated_at')->whereHari('selasa')->get() as $jadwal)
            <div class="kartu border mb-1 p-2 rounded" draggable="true" data-id="{{ $jadwal->id }}">
                <div class="row align-items-center">
                    <div class="col-9">{{ $jadwal->mapel->nm_mapel }}</div>
                    <div class="col-3">
                        <a href="{{ route('admin.jadwal-sekolah.delete', ['id'=> $jadwal->id]) }}">
                            <span class="close" style="font-size:13px">&times;</span>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-xl-2 col-lg-4 col-md-3 hari py-3" style="min-height:200px" data-hari="Rabu">
        <h6>Rabu</h6>
        @foreach($kelas->jadwal_sekolahs()->orderBy('updated_at')->whereHari('rabu')->get() as $jadwal)
            <div class="kartu border mb-1 p-2 rounded" draggable="true" data-id="{{ $jadwal->id }}">
                <div class="row align-items-center">
                    <div class="col-9">{{ $jadwal->mapel->nm_mapel }}</div>
                    <div class="col-3">
                        <a href="{{ route('admin.jadwal-sekolah.delete', ['id'=> $jadwal->id]) }}">
                            <span class="close" style="font-size:13px">&times;</span>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-xl-2 col-lg-4 col-md-3 hari py-3" style="min-height:200px" data-hari="Kamis">
        <h6>Kamis</h6>
        @foreach($kelas->jadwal_sekolahs()->orderBy('updated_at')->whereHari('kamis')->get() as $jadwal)
            <div class="kartu border mb-1 p-2 rounded" draggable="true" data-id="{{ $jadwal->id }}">
                <div class="row align-items-center">
                    <div class="col-9">{{ $jadwal->mapel->nm_mapel }}</div>
                    <div class="col-3">
                        <a href="{{ route('admin.jadwal-sekolah.delete', ['id'=> $jadwal->id]) }}">
                            <span class="close" style="font-size:13px">&times;</span>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-xl-2 col-lg-4 col-md-3 hari py-3" style="min-height:200px" data-hari="Jumat">
        <h6>Jumat</h6>
        @foreach($kelas->jadwal_sekolahs()->orderBy('updated_at')->whereHari('jumat')->get() as $jadwal)
            <div class="kartu border mb-1 p-2 rounded" draggable="true" data-id="{{ $jadwal->id }}">
                <div class="row align-items-center">
                    <div class="col-9">{{ $jadwal->mapel->nm_mapel }}</div>
                    <div class="col-3">
                        <a href="{{ route('admin.jadwal-sekolah.delete', ['id'=> $jadwal->id]) }}">
                            <span class="close" style="font-size:13px">&times;</span>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-xl-2 col-lg-4 col-md-3 hari py-3" style="min-height:200px" data-hari="Sabtu">
        <h6>Sabtu</h6>
        @foreach($kelas->jadwal_sekolahs()->orderBy('updated_at')->whereHari('sabtu')->get() as $jadwal)
            <div class="kartu border mb-1 p-2 rounded" draggable="true" data-id="{{ $jadwal->id }}">
                <div class="row align-items-center">
                    <div class="col-9">{{ $jadwal->mapel->nm_mapel }}</div>
                    <div class="col-3">
                        <a href="{{ route('admin.jadwal-sekolah.delete', ['id'=> $jadwal->id]) }}">
                            <span class="close" style="font-size:13px">&times;</span>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
const kartus = document.querySelectorAll(".kartu");
const all_hari = document.querySelectorAll(".hari");
let draggableTodo = null;
let hari;

kartus.forEach((kartu) => {
    kartu.addEventListener("dragstart", dragStart);
    kartu.addEventListener("dragend", dragEnd);
});

function dragStart() {
    draggableTodo = this;
    setTimeout(() => {
        this.style.display = "none";
    }, 0);
    console.log('Drag dimulai')
}

function dragEnd() {
    draggableTodo = null;
    setTimeout(() => {
        this.style.display = "block";
    }, 0);
    console.log('Drag selesai')

    $.ajax({
        url:"{{ route('admin.jadwal-sekolah.update') }}",
        type:'POST',
        data:{
            '_token':"{{ csrf_token() }}",
            'id':$(this).data('id'),
            'hari':hari
        }
    })
}

all_hari.forEach((hari) => {
    hari.addEventListener("dragover", dragOver);
    hari.addEventListener("dragenter", dragEnter);
    hari.addEventListener("dragleave", dragLeave);
    hari.addEventListener("drop", dragDrop);
});

function dragOver(e) {
    e.preventDefault();
}

function dragEnter() {
    this.style.border = "1px dashed #ccc";
    console.log("dragEnter");
}

function dragLeave() {
    this.style.border = "none";
    console.log("dragLeave");
}

function dragDrop() {
    this.style.border = "none";
    this.appendChild(draggableTodo);
    hari = $(this).data('hari');
}
</script>