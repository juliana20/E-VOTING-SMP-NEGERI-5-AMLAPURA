<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Siswa_m;
use App\Http\Model\User_m;
use App\Http\Model\Kelas_m;
use Maatwebsite\Excel\Facades\Excel;
use Helpers;
use DB;
use Redirect;

class Import extends Controller
{
    public function __construct()
    {
        $this->model_siswa = New Siswa_m;
        $this->model_user = New User_m;
        $this->model_kelas = New Kelas_m;
    }

    public function import_siswa(Request $request) 
    {
        if(!Helpers::isLogin()){
            alert()->error('Anda belum login, silahkan login terlebih dahulu!', 'Perhatian!')->persistent('OK');
            return redirect('login');
        }
        else
        { 
        $data = Excel::load($request->file('file'), function($reader) {})->get();
        if(!empty($data) && $data->count())
        {

            foreach($data->toArray() as $row)
            {
                DB::beginTransaction();
                try {
                    //cek nis di tabel
                    $cekNis = $this->model_siswa->get_by(['nis' => $row['nis']]);
                    if(!empty($cekNis))
                    {
                        foreach($this->model_kelas->get_all() as $kls)
                        {
                            $kelas[$kls->tingkat_kelas] = $kls->id;
                        }
                        $this->model_siswa->update_by(['nis' => $row['nis']], 
                            [
                                'nis' => $row['nis'],
                                'nama_siswa' => $row['namasiswa'],
                                'tanggal_lahir' => $row['tanggallahir'],
                                'alamat' => $row['alamat'],
                                // 'telepon_siswa' => $row['teleponsiswa'],
                                'telepon_ortu' => $row['teleponortu'],
                                'angkatan' => $row['angkatan'],
                                // 'email' => $row['email'],
                                'status_siswa' => $row['statussiswa'],
                                'id_kelas' => $kelas[$row['kelas']],
                            ]);
                        // $id_user = $this->model_user->update_by(['id' => $cekNis->id_user], 
                        //     [
                        //         'nama' => $row['namasiswa'],
                        //         'username' => $row['nis'],
                        //         'password' => bcrypt($row['nis']),
                        //         'id_jabatan' => 4,
                        //         'aktif' => 1,
                        //     ]);
                    }else{
                        foreach($this->model_kelas->get_all() as $kls)
                        {
                            $kelas[$kls->tingkat_kelas] = $kls->id;
                        }

                        // $tbl_user = [
                        //     'nama' => $row['namasiswa'],
                        //     'username' => $row['nis'],
                        //     'password' => bcrypt($row['nis']),
                        //     'id_jabatan' => 4,
                        //     'aktif' => 1,
                        // ];

                        // $id_user = User_m::insertGetId($tbl_user);
    
                        $tbl_siswa = [
                            'nis' => $row['nis'],
                            'nama_siswa' => $row['namasiswa'],
                            'tanggal_lahir' => $row['tanggallahir'],
                            'alamat' => $row['alamat'],
                            // 'telepon_siswa' => $row['teleponsiswa'],
                            'telepon_ortu' => $row['teleponortu'],
                            'angkatan' => $row['angkatan'],
                            // 'email' => $row['email'],
                            'status_siswa' => $row['statussiswa'],
                            'id_kelas' => $kelas[$row['kelas']],
                            // 'id_user' => $id_user,
                        ];

                        $this->model_siswa->insert_data($tbl_siswa);
                    }
                    DB::commit();              
                    alert()->success('Data berhasil diimport!', 'Sukses!')->persistent('OK');

                } catch (\Throwable $e) {
                    DB::rollback();
                    throw $e;
                    alert()->warning('Data gagal diimport!', 'Perhatian!')->persistent('OK');
                }
            }

        }
        return Redirect::back(); 
        }
    }


}
