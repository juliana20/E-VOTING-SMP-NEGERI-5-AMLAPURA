<?php

namespace App\Http\Controllers;

use App\Http\Model\Kriteria_m;
use Illuminate\Http\Request;
use App\Http\Model\Sub_kriteria_m;
use Validator;
use DataTables;
use Illuminate\Validation\Rule;
use DB;
use Response;

class SubKriteriaController extends Controller
{
    protected $model;
    protected $model_kriteria;
    public function __construct(Sub_kriteria_m $model, Kriteria_m $model_kriteria)
    {
        $this->model = $model;
        $this->model_kriteria = $model_kriteria;
        $this->nameroutes = 'sub-kriteria';
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
                'title'             => 'Sub Kriteria',
                'header'            => 'Data Sub Kriteria',
                'breadcrumb'        => 'List Data Sub Kriteria',
                'headerModalTambah' => 'Tambah Data Sub Kriteria',
                'headerModalEdit'   => 'Ubah Data Sub Kriteria',
                'urlDatatables'     => 'sub-kriteria/datatables',
                'idDatatables'      => 'dt_datatables'
            );
            return view('sub_kriteria.datatable',$data);
    }

    public function create(Request $request)
    {
        $item = [
            'kode_sub_kriteria' => $this->model->gen_code('Y'),
            'nama__sub_kriteria' => null,
        ];

        $data = array(
            'item'                  => (object) $item,
            'submit_url'            => url()->current(),
            'is_edit'               => FALSE,
            'nameroutes'            => $this->nameroutes,
            'kriteria'              => $this->model_kriteria->get_all()
        );

        //jika form sumbit
        if($request->post())
        {
            $header = $request->input('f');
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
                    "message" => 'Data sub kriteria berhasil dibuat',
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

        return view('sub_kriteria.form', $data);

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
            'kriteria'              => $this->model_kriteria->get_all()
        ];

        //jika form sumbit
        if($request->post())
        {
            //request dari view
            $header = $request->input('f');
           //validasi dari model
           $validator = Validator::make( $header,[
                'kode_sub_kriteria' => ['required', Rule::unique('m_sub_kriteria')->ignore($get_data->kode_sub_kriteria, 'kode_sub_kriteria')],
                'nama_sub_kriteria' => ['required'],
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
                    "message" => 'Data sub kriteria berhasil diperbarui',
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
        
        return view('sub_kriteria.form', $data);
    }

    public function datatables_collection()
    {
        $data = $this->model->get_all();
        return Datatables::of($data)->make(true);
    }

}
