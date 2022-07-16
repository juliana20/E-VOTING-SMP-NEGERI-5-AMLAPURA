<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Mutasi_kas_m;
use App\Http\Model\Mutasi_kas_detail_m;
use App\Http\Model\Akun_m;
use Validator;
use DataTables;
use Illuminate\Validation\Rule;
use Helpers;
use DB;
use Response;

class MutasiController extends Controller
{
    protected $jenis_mutasi = [
        ['id' => 'Penerimaan', 'desc' => 'Penerimaan Kas'],
        ['id' => 'Pengeluaran', 'desc' => 'Pengeluaran Kas'],
    ];

    public function __construct()
    {
        $this->model = New Mutasi_kas_m;
        $this->model_detail = New Mutasi_kas_detail_m;
        $this->model_akun = New Akun_m;
        $this->nameroutes = 'mutasi-kas';
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
                'title'             => 'Data Mutasi Kas',
                'breadcrumb'        => 'List Data Mutasi Kas',
                'urlDatatables'     => "{$this->nameroutes}/datatables",
                'idDatatables'      => 'dt_mutasi_kas'
            );
            return view('mutasi_kas.datatable',$data);
    }

    public function create(Request $request)
    {
        $item = [
            'id_mutasi_kas' => $this->model->gen_code('MUT'),
            'tanggal' => date('Y-m-d')
        ];

        $data = array(
            'item'              => (object) $item,
            'title'             => 'Buat Mutasi Kas',
            'breadcrumb'        => 'Daftar Mutasi Kas',
            'submit_url'            => url()->current(),
            'is_edit'               => FALSE,
            'jenis_mutasi'          => $this->jenis_mutasi,
            'nameroutes'            => $this->nameroutes,
        );

        //jika form sumbit
        if($request->post())
        {
            //request dari view
            $header = array_merge($item, $request->input('header'));
            $header['id_mutasi_kas'] = $this->model->gen_code('MUT');
            $header['debet'] = ($header['jenis_mutasi'] == 'Penerimaan') ? $header['total'] : 0;
            $header['kredit'] = ($header['jenis_mutasi'] == 'Pengeluaran') ? $header['total'] : 0;
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
                    $data_details[] = [
                        'id_mutasi_kas' => $header['id_mutasi_kas'],
                        'nominal' => ($header['jenis_mutasi'] == 'Pengeluaran') ? $row['nominal'] : 0,
                        'kredit' => ($header['jenis_mutasi'] == 'Penerimaan') ? $row['nominal'] : 0,
                        'keterangan' => $row['keterangan'],
                        'akun_id' => $row['akun_id'],
                    ];
                }

                // insert detail
                $this->model_detail->insert_data($data_details);
                DB::commit();
    
                $response = [
                    "message" => 'Data mutasi berhasil dibuat',
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

        return view('mutasi_kas.form', $data);

    }

    public function lookup_detail( $id = null)
    {
        $data = [
            'jenis_mutasi' => $id
        ];
        return view('mutasi_kas.lookup.lookup_detail', $data);
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
            'title'                     => 'Lihat Mutasi Kas',
            'breadcrumb'                => 'Daftar Mutasi Kas',
            'is_edit'                   => TRUE,
            'submit_url'                => url()->current(),
            'jenis_mutasi'              => $this->jenis_mutasi,
            'nameroutes'                => $this->nameroutes,
            'collection'                => $this->model_detail->collection($get_data->id_mutasi_kas)
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
                    "message" => 'Data mutasi berhasil dibatalkan!',
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
        
        return view('mutasi_kas.form', $data);
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
