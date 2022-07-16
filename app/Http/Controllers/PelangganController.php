<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Pelanggan_m;
use Validator;
use DataTables;
use Illuminate\Validation\Rule;
use DB;
use Response;

class PelangganController extends Controller
{
    protected $jenis_kelamin = [
        ['id' => 'Laki-Laki', 'desc' => 'Laki-Laki'],
        ['id' => 'Perempuan', 'desc' => 'Perempuan'],
    ];

    protected $model;
    public function __construct(Pelanggan_m $model)
    {
        $this->model = $model;
        $this->nameroutes = 'pelanggan';
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
                'title'             => 'Pelanggan',
                'header'            => 'Data Pelanggan',
                'breadcrumb'        => 'List Data Pelanggan',
                'headerModalTambah' => 'TAMBAH DATA PELANGGAN',
                'headerModalEdit'   => 'UBAH DATA PELANGGAN',
                'urlDatatables'     => 'pelanggan/datatables',
                'idDatatables'      => 'dt_pelanggan'
            );
            return view('pelanggan.datatable',$data);
    }

    public function create(Request $request)
    {
        $item = [
            'kode' => $this->model->gen_code('PL')
        ];

        $data = array(
            'item'                  => (object) $item,
            'submit_url'            => url()->current(),
            'is_edit'               => FALSE,
            'option_jenis_kelamin'  => $this->jenis_kelamin,
            'nameroutes'            => $this->nameroutes,
        );

        //jika form sumbit
        if($request->post())
        {
            $header = $request->input('f');
            $header['kode'] = $this->model->gen_code('PL');
            $validator = Validator::make( $header, $this->model->rules['insert']);
            if ($validator->fails()) {
                $response = [
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
                    "message" => 'Data pelanggan berhasil dibuat',
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

        return view('pelanggan.form', $data);

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
            'option_jenis_kelamin'      => $this->jenis_kelamin,
            'nameroutes'                => $this->nameroutes,
        ];

        //jika form sumbit
        if($request->post())
        {
            //request dari view
            $header = $request->input('f');
            //validasi dari model
            $validator = Validator::make( $header, [
                'kode' => [Rule::unique('m_pelanggan')->ignore($get_data->kode, 'kode')],
            ]);
            if ($validator->fails()) {
                $response = [
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
                    "message" => 'Data pelanggan berhasil diperbarui',
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
        
        return view('pelanggan.form', $data);
    }

    public function datatables_collection()
    {
        $data = $this->model->get_all();
        return Datatables::of($data)->make(true);
    }


}
