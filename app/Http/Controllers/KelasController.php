<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Kelas_m;
use App\Http\Model\Pemilih_m;
use Validator;
use DataTables;
use Illuminate\Validation\Rule;
use DB;
use Response;

class KelasController extends Controller
{
    protected $model;
    public function __construct(Kelas_m $model)
    {
        $this->model = $model;
        $this->nameroutes = 'kelas';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
   {
            $data = array(
                'nameroutes'        => $this->nameroutes,
                'title'             => 'Kelas',
                'header'            => 'Data Kelas',
                'breadcrumb'        => 'List Data Kelas',
                'headerModalTambah' => 'Tambah Data Kelas',
                'headerModalEdit'   => 'Ubah Data Kelas',
                'urlDatatables'     => "{$this->nameroutes}/datatables",
                'idDatatables'      => 'dt_kelas'
            );
            return view('kelas.datatable',$data);
    }

    public function create(Request $request)
    {
        $item = [
            'kode_kelas' => $this->model->gen_code('KLS'),
            'nama_kelas' => null,
        ];
        $data = array(
            'item'                  => (object) $item,
            'submit_url'            => url()->current(),
            'is_edit'               => FALSE,
            'nameroutes'            => $this->nameroutes,
        );
        //jika form sumbit
        if($request->post())
        {
            $header = $request->input('f');
            $validator = Validator::make( $header, $this->model->rules['insert']);
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'message' => $validator->errors()->first(),
                    'status' => 'error',
                    'code' => 500,
                ];
                return Response::json($response);
            }

            DB::beginTransaction();
            try {
                $this->model->insert_data($header);
                DB::commit();
    
                $response = [
                    'success' => true,
                    "message" => 'Data kelas berhasil dibuat',
                    'status' => 'success',
                    'code' => 200,
                ];
    
            } catch (\Exception $e) {
                DB::rollback();
                $response = [
                    'success' => false,
                    "message" => $e->getMessage(),
                    'status' => 'error',
                    'code' => 500,
                    
                ];
            }
    
            return Response::json($response);
        }

        return view('kelas.form', $data);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $get_data = $this->model->get_one($id);
        $data = [
            'item'                      => $get_data,
            'is_edit'                   => TRUE,
            'submit_url'                => url()->current(),
            'nameroutes'                => $this->nameroutes,
        ];

        //jika form sumbit
        if($request->post())
        {
            //request dari view
            $header = $request->input('f');
           //validasi dari model
           $validator = Validator::make( $header,[
                'kode_kelas' => ['required', Rule::unique('m_kelas')->ignore($get_data->kode_kelas, 'kode_kelas')],
                'nama_kelas' => ['required', Rule::unique('m_kelas')->ignore($get_data->nama_kelas, 'nama_kelas')],
           ]);
           if ($validator->fails()) {
               $response = [
                   'success' => false,
                   'message' => $validator->errors()->first(),
                   'status' => 'error',
                   'code' => 500,
               ];
               return Response::json($response);
           }
            //insert data
            DB::beginTransaction();
            try {
                $this->model->update_data($header, $id);
                DB::commit();

                $response = [
                    'success' => true,
                    "message" => 'Data kelas berhasil diperbarui',
                    'status' => 'success',
                    'code' => 200,
                ];
           
            } catch (\Exception $e) {
                DB::rollback();
                $response = [
                    'success' => false,
                    "message" => $e->getMessage(),
                    'status' => 'error',
                    'code' => 500,
                    
                ];
            }
            return Response::json($response); 
        }
        
        return view('kelas.form', $data);
    }

    public function daftarSiswa(Kelas_m $kelas)
    {
        $query = Pemilih_m::where('kelas_id', $kelas->id)->get();
        $data = array(
            'nameroutes'        => $this->nameroutes,
            'title'             => 'Daftar Siswa',
            'header'            => 'Daftar Siswa '. $kelas->nama_kelas,
            'breadcrumb'        => 'List Data Siswa Kelas '. $kelas->nama_kelas,
            'collection'        => $query,
        );
        return view('kelas.daftar_siswa',$data);

    }

    public function datatables_collection()
    {
        $data = $this->model->get_all();
        return Datatables::of($data)->make(true);
    }


}
