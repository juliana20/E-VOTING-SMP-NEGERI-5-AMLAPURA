<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Admin;
use App\Http\Model\Admin_m;
use App\Http\Model\Kelas_m;
use Illuminate\Http\Request;
use App\Http\Model\Pemilih_m;
use Validator;
use DataTables;
use Illuminate\Validation\Rule;
use DB;
use Response;

class PemilihController extends Controller
{
    protected $jenis_kelamin = [
        ['id' => 'Laki-Laki', 'desc' => 'Laki-Laki'],
        ['id' => 'Perempuan', 'desc' => 'Perempuan'],
    ];

    protected $agama = [
        ['id' => 'Islam', 'desc' => 'Islam'],
        ['id' => 'Protestan', 'desc' => 'Protestan'],
        ['id' => 'Katolik', 'desc' => 'Katolik'],
        ['id' => 'Hindu', 'desc' => 'Hindu'],
        ['id' => 'Budha', 'desc' => 'Budha'],
        ['id' => 'Khonghucu', 'desc' => 'Khonghucu'],
    ];

    protected $model;
    protected $model_admin;
    public function __construct(Pemilih_m $model, Admin_m $model_admin)
    {
        $this->model = $model;
        $this->model_admin = $model_admin;
        $this->nameroutes = 'pemilih';
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
                'title'             => 'Pemilih',
                'header'            => 'Data Pemilih',
                'breadcrumb'        => 'List Data Pemilih',
                'headerModalTambah' => 'Tambah Data Pemilih',
                'headerModalEdit'   => 'Ubah Data Pemilih',
                'urlDatatables'     => 'pemilih/datatables',
                'idDatatables'      => 'dt_datatables'
            );
            return view('pemilih.datatable',$data);
    }

    public function create(Request $request)
    {
        $item = [
            'nis' => null,
            'nama_pemilih' => null,
        ];
        

        $data = array(
            'item'                  => (object) $item,
            'submit_url'            => url()->current(),
            'is_edit'               => FALSE,
            'nameroutes'            => $this->nameroutes,
            'jenis_kelamin'         => $this->jenis_kelamin,
            'agama'                 => $this->agama,
            'kelas'                 => Kelas_m::get()            
        );

        //jika form sumbit
        if($request->post())
        {
            $header = $request->input('f');

            $user = $request->input('u');
            $user['kode_admin'] = $this->model_admin->gen_code('A');
            $user['nama_admin'] = $header['nama_pemilih'];
            $user['jabatan'] = 'Siswa';
            $user['password'] = bcrypt($user['password']);

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
                $id_user = Admin_m::insertGetId($user);
                $header['user_id'] = $id_user;
                $this->model->insert_data($header);
                DB::commit();
    
                $response = [
                    'success' => true,
                    "message" => 'Data pemilih berhasil dibuat',
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

        return view('pemilih.form', $data);

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
            'jenis_kelamin'         => $this->jenis_kelamin,
            'agama'                 => $this->agama,
            'kelas'                 => Kelas_m::get()   
        ];

        //jika form sumbit
        if($request->post())
        {
            //request dari view
            $header = $request->input('f');
            $user = $request->input('u');
            $user['nama_admin'] = $header['nama_pemilih'];
            if($user['password'] != $get_data->password)
            {
                $user['password'] = bcrypt($user['password']);
            }
           //validasi dari model
           $validator = Validator::make( $header,[
                'nis' => ['required', Rule::unique('m_pemilih')->ignore($get_data->nis, 'nis')],
                'nama_pemilih' => ['required'],
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
                if(empty($get_data->user_id) || $get_data->user_id == "")
                {
                    $user['kode_admin'] = $this->model_admin->gen_code('A');
                    $user['jabatan'] = 'Siswa';

                    $id_user = Admin_m::insertGetId($user);
                    $header['user_id'] = $id_user;
                    $this->model->update_data($header, $id);
                }else{
                    $this->model->update_data($header, $id);
                    $this->model_admin->update_data($user, $get_data->user_id);
                }
                DB::commit();

                $response = [
                    'success' => true,
                    "message" => 'Data pemilih berhasil diperbarui',
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
        
        return view('pemilih.form', $data);
    }

    public function datatables_collection()
    {
        $data = $this->model->get_all();
        return Datatables::of($data)->make(true);
    }

}
