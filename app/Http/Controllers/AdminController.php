<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Admin_m;
use Validator;
use DataTables;
use DB;
use Response;

class AdminController extends Controller
{
    protected $jabatan = [
        ['id' => 'Admin', 'desc' => 'Admin'],
        ['id' => 'Siswa', 'desc' => 'Siswa']
    ];

    protected $model;
    public function __construct(Admin_m $model)
    {
        $this->model = $model;
        $this->nameroutes = 'admin';
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
            'title'             => 'Admin',
            'header'            => 'Data Admin',
            'breadcrumb'        => 'List Data Admin',
            'headerModalTambah' => 'Tambah Data Admin',
            'headerModalEdit'   => 'Ubah Data Admin',
            'urlDatatables'     => 'admin/datatables',
            'idDatatables'      => 'dt_admin'
        );
        return view('admin.datatable',$data);
    }

    public function create(Request $request)
    {
        $item = [
            'kode_admin' => $this->model->gen_code('A'),
            'nama__admin' => null,
            'username' => null,
            'password' => null,
            'jabatan' => null,
        ];

        $data = array(
            'item'                  => (object) $item,
            'submit_url'            => url()->current(),
            'is_edit'               => FALSE,
            'option_jabatan'         => $this->jabatan,
            'nameroutes'            => $this->nameroutes,
        );

        //jika form sumbit
        if($request->post())
        {
            $header = $request->input('f');
            $header['password'] = bcrypt($header['password']);
            $header['kode_admin'] = $this->model->gen_code('A');

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
                    "message" => 'Data admin berhasil dibuat',
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

        return view('admin.form', $data);

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
            'option_jabatan'            => $this->jabatan,
            'nameroutes'                => $this->nameroutes,
        ];

        //jika form sumbit
        if($request->post())
        {
            //request dari view
            $header = $request->input('f');

           //validasi dari model
           $validator = Validator::make( $header, $this->model->rules['update']);
           if ($validator->fails()) {
               $response = [
                    'success' => false,
                   'message' => $validator->errors()->first(),
                   'status' => 'error',
                   'code' => 500,
               ];
               return Response::json($response);
           }

           $tb_user = [
                'username' => $header['username'],
                'nama_admin' => $header['nama_admin'],
                'jabatan' => $header['jabatan']
            ];

            //cek password berubah/tidak
            if($header['password'] != $get_data->password){
                $tb_user['password'] =  bcrypt($header['password']);
            }

            //insert data
            DB::beginTransaction();
            try {
                $this->model->update_data($tb_user, $id);
                DB::commit();

                $response = [
                    'success' => true,
                    "message" => 'Data admin berhasil diperbarui',
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
        
        return view('admin.form', $data);
    }

    public function datatables_collection()
    {
        $data = $this->model->get_all();
        return Datatables::of($data)->make(true);
    }


}
