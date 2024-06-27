<?php

namespace App\Imports;

use App\Models\Guru;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuruImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = User::create([
            'name'      => $row['nm_guru'],
            'username'  => $row['username'],
            'password'  => Hash::make($row['username']),
            'level'     => 'guru'
        ]);
        return new Guru([
            'nip'           => $row['nip'],
            'nuptk'         => $row['nuptk'],
            'nm_guru'       => $row['nm_guru'],
            'tmpt_lhr'      => $row['tmpt_lhr'],
            'tgl_lhr'       => $row['tgl_lhr'],
            'jen_kel'       => $row['jen_kel'],
            'agama'         => $row['agama'],
            'almt'          => $row['almt'],
            'no_tlp'        => $row['no_tlp'],
            'user_id'       => $user->id,
        ]);
    }
}
