<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;

class SettingParameterController extends Controller
{
    public function form(Request $request)
    {
        $item = [
            'nama_akun' => null,
        ];

        $data = array(
            'title'      => 'Setting Parameter',
            'header'     => 'Setting Biaya Sampah',
            'item'       => (object) $item,
            'submit_url' => url()->current(),
        );

        //jika form sumbit
        if($request->post())
        {
            $header = $request->input('f');
            DB::beginTransaction();
            try {
                DB::table('config')->where('key', 'biaya_jasa')->update(['value' => $header['biaya_jasa']]);
                DB::table('config')->where('key', 'upah_pungut')->update(['value' => $header['upah_pungut']]);
                DB::table('config')->where('key', 'biaya_vendor')->update(['value' => $header['biaya_vendor']]);
                DB::commit();
    
                $response = [
                    "message" => 'Data setting parameter berhasil disimpan',
                    'status' => 'success',
                    'code' => 200,
                ];
    
            } catch (\Exception $e) {
                DB::rollback();
                $response = [
                    "message" => $e->getMessage(),
                    'status' => 'error',
                    'code' => 500,
                    
                ];
            }
    
            return Response::json($response);
        }

        return view('setting_parameter.form', $data);

    }

}
