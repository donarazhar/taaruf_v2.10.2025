<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Karyawan;
use App\Models\Biodata;
use App\Models\Kriteriapasangan;

class ProfileService
{
    public function updateBasicProfile($user, $request)
    {
        $email = $user->email;
        $nama = $request->nama;
        $password = $request->password;

        $foto = $user->foto;
        if ($request->hasFile('foto')) {
            $foto = $email . '.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->storeAs('public/uploads/karyawan/img/', $foto);
        }

        $data = [
            'nama' => $nama,
            'foto' => $foto,
        ];

        if (!empty($password)) {
            $data['password'] = Hash::make($password);
        }

        $user->update($data);
    }

    public function updateBiodata($user, $request)
    {
        $email = $user->email;

        $adaData = Biodata::find($email);

        // Get video logic
        $video = $adaData ? $adaData->video : null;
        if ($request->hasFile('video')) {
            $video = $email . '.' . $request->file('video')->getClientOriginalExtension();
            $request->file('video')->storeAs('public/uploads/karyawan/video/', $video);
        }

        Biodata::updateOrCreate(
            ['email' => $email],
            [
                'nohp' => $request->nohp,
                'tempatlahir' => $request->tempatlahir,
                'tgllahir' => $request->tgllahir,
                'tinggi' => $request->tinggi,
                'berat' => $request->berat,
                'goldar' => $request->goldar,
                'statusnikah' => $request->statusnikah,
                'pekerjaan' => $request->pekerjaan,
                'suku' => $request->suku,
                'pendidikan' => $request->pendidikan,
                'hobi' => $request->hobi,
                'motto' => $request->motto,
                'alamat' => $request->alamat,
                'video' => $video,
            ]
        );
    }

    public function updateKriteria($user, $request)
    {
        $email = $user->email;

        Kriteriapasangan::updateOrCreate(
            ['email' => $email],
            [
                'kriteriaumur' => $request->umurRange,
                'kriteriatinggi' => $request->tinggiRange,
                'kriteriaberat' => $request->beratRange,
                'kriteriasuku' => $request->sukupilihan,
                'kriteriaumum' => $request->kriteriaumum,
            ]
        );
    }
}
