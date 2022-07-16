<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Jurnal_m;
use App\Http\Model\Jurnal_detail_m;
use App\Http\Model\Akun_m;
use Validator;
use DataTables;
use Illuminate\Validation\Rule;
use Helpers;
use DB;
use Response;

class JurnalController extends Controller
{
    public function __construct()
    {
        $this->model = New Jurnal_m;
        $this->model_detail = New Jurnal_detail_m;
        $this->model_akun = New Akun_m;
        $this->nameroutes = 'jurnal';
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
                'title'             => 'Data Transaksi Jurnal Umum',
                'breadcrumb'        => 'List Data Transaksi Jurnal Umum',
                'urlDatatables'     => "{$this->nameroutes}/datatables",
                'idDatatables'      => 'dt_jurnal'
            );
            return view('jurnal.datatable',$data);
    }

    public function create(Request $request)
    {
        $item = [
            'id_jurnal' => $this->model->gen_code('JUM'),
            'tanggal' => date('Y-m-d')
        ];

        $data = array(
            'item'              => (object) $item,
            'title'             => 'Buat Transaksi Jurnal Umum',
            'breadcrumb'        => 'Daftar Transaksi Jurnal Umum',
            'submit_url'            => url()->current(),
            'is_edit'               => FALSE,
            'nameroutes'            => $this->nameroutes,
        );

        //jika form sumbit
        if($request->post())
        {
            //request dari view
            $header = array_merge($item, $request->input('header'));
            $header['id_jurnal'] = $this->model->gen_code('JUM');
            $header['id_user'] = Helpers::getId();
            $header['tanggal'] = date('Y-m-d h:i:s', strtotime($header['tanggal']));
            $details = $request->input('details');

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
                //insert header get id
                $this->model->insert_data($header);
                $data_details = [];
                foreach($details as $row)
                {
                    $row['id_jurnal'] = $header['id_jurnal'];
                    $data_details[] = $row;
                }
                // insert detail
                $this->model_detail->insert_data($data_details);
                DB::commit();
    
                $response = [
                    "message" => 'Data jurnal umum berhasil dibuat',
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

        return view('jurnal.form', $data);

    }

    public function lookup_akun( )
    {
        return view('jurnal.lookup.akun');
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
    public function detail(Request $request, $id)
    {
        $get_data = $this->model->get_one($id);
        $data = [
            'item'                      => $get_data,
            'title'                     => 'Lihat Transaksi Jurnal Umum',
            'breadcrumb'                => 'Daftar Transaksi Jurnal Umum',
            'is_edit'                   => TRUE,
            'submit_url'                => url()->current(),
            'nameroutes'                => $this->nameroutes,
            'collection'                => $this->model_detail->collection($get_data->id_jurnal)
        ];

        //jika form sumbit
        if($request->post())
        {
            //insert data
            DB::beginTransaction();
            try {
                $this->model->update_data(['status_batal' => 1], $id);
                DB::commit();

                $response = [
                    "message" => 'Data jurnal umum berhasil dibatalkan!',
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
        
        return view('jurnal.form', $data);
    }

    public function datatables_collection()
    {
        $data = $this->model->get_all();
        return Datatables::of($data)->make(true);
    }

    public function datatables_collection_no_tabungan()
    {
        $data = $this->model->get_all_no_tabungan();
        return Datatables::of($data)->make(true);
    }


}
