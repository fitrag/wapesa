<?php

namespace App\Imports;

use App\Models\{Siswa, User};
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = User::create([
            'name'      => $row['nm_siswa'],
            'username'  => $row['nis'],
            'password'  => Hash::make($row['nis']),
            'level'     => 'siswa'
        ]);
        return new Siswa([
            'nis'           => $row['nis'],
            'nisn'          => $row['nisn'],
            'nm_siswa'      => $row['nm_siswa'],
            'tmpt_lhr'      => $row['tmpt_lhr'],
            'tgl_lhr'       => $row['tgl_lhr'],
            'jen_kel'       => $row['jen_kel'],
            'agama'         => $row['agama'],
            'almt_siswa'    => $row['almt_siswa'],
            'no_tlp'        => $row['no_tlp'],
            'nm_ayah'       => $row['nm_ayah'],
            'kelas_id'      => $row['kelas_id'],
            'user_id'       => $user->id,
        ]);
    }
}
