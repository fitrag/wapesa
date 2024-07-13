@forelse($siswaprakerins as $siswaprakerin)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $siswaprakerin->siswa->nis }}</td>
    <td>{{ $siswaprakerin->siswa->nm_siswa }}</td>
    <td>{{ $siswaprakerin->siswa->kelas->nm_kls }}</td>
    <td>
        <button type="button" class="btn btn-danger" onclick="hapusSiswaSudah({{ $siswaprakerin->id }})"><i class="fas fa-trash"></i></button>
    </td>
</tr>
@empty
<tr>
    <td class="text-center" colspan="5">
        Belum ada data
    </td>
</tr>
@endforelse