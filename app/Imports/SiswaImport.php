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
            'name'      => $row['nama'],
            'username'  => $row['nisn'],
            'password'  => Hash::make($row['nisn']),
            'level'     => 'siswa'
        ]);
        return new Siswa([
            'nisn'          => $row['nisn'],
            'nis'           => $row['nis'],
            'nm_siswa'      => $row['nama'],
            'kelas_id'      => $row['kelas_id'],
            'user_id'       => $user->id,
        ]);
    }
}
