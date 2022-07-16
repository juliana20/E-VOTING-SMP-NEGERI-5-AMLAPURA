<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Simpanan_anggota_m extends Model
{
	protected $table = 'tb_nasabah';
	protected $index_key = 'id';
	protected $index_key2 = 'no_anggota';
    public $timestamps  = false;

	public $rules;

    public function __construct()
	{
        $this->rules = [
            'insert' => [
                'id_nasabah' => 'required|unique:tb_nasabah',
				'nama_nasabah' => 'required',
            ],
			'update' => [
				'nama_nasabah' => 'required',
            ],
			'insert_simpanan_wajib' => [
                'id_simpanan_wajib' => 'required|unique:tb_simpanan_wajib',
				'id_nasabah' => 'required',
				'tanggal' => 'required',
				'id_user' => 'required',
            ],
			'insert_simpanan_pokok' => [
                'id_simpanan_pokok' => 'required|unique:tb_simpanan_pokok',
				'id_nasabah' => 'required',
				'tanggal' => 'required',
				'id_user' => 'required',
            ],
        ];
	}

    function get_all($params)
    {
		$query = DB::table($this->table)
				->where(['anggota' => 1,'aktif' => 1 ]);

		if(!empty($params['proses']) && $params['proses'] == 1){
			$query->where('berhenti_anggota', '=', 1);
		}else{
			$query->where('berhenti_anggota', '=', 0);
		}
		return $query->get();
    }

    function insert_data($data)
	{
		return self::insert($data);
	}
	

	function insert_data_simpanan_wajib($data)
	{
		return DB::table('tb_simpanan_wajib')->insert($data);
	}
	function insert_data_simpanan_pokok($data)
	{
		return DB::table('tb_simpanan_pokok')->insert($data);
	}

	function get_one($id)
	{
		return self::where($this->index_key, $id)->first();
	}

	function get_by( $where )
	{
		return self::where($where)->first();
	}

	function get_by_in( $where, $data )
	{
		return self::whereIn($where, $data)->get();
	}

	function update_data($data, $id)
	{
		return self::where($this->index_key, $id)->update($data);
	}

	function update_by($data, Array $where)
	{
		$query = DB::table($this->table)->where($where);
		return $query->update($data);
	}

	function gen_code( $format )
	{
		$max_number = self::all()->max($this->index_key2);
		$noUrut = (int) substr($max_number, 3, 3);
		$noUrut++;
		$code = $format;
		$no_generate = $code . sprintf("%03s", $noUrut);

		return (string) $no_generate;
	}

	function gen_code_anggota( $format )
	{
		$max_number = self::all()->max('no_anggota');
		$noUrut = (int) substr($max_number, 3, 3);
		$noUrut++;
		$code = $format;
		$no_generate = $code . sprintf("%03s", $noUrut);

		return (string) $no_generate;
	}

	function gen_no_bukti_setoran_wajib( $format )
	{
		$max_number = DB::table('tb_simpanan_wajib')->get()->max('id_simpanan_wajib');
		$noUrut = substr($max_number, 3, 11);
		$noUrut++;
		// $date = date('dmY');
		$code = $format;
		$no_generate = $code . sprintf("%03s", $noUrut);

		return (string) $no_generate;
	}

	function gen_no_bukti_setoran_pokok( $format )
	{
		$max_number = DB::table('tb_simpanan_pokok')->get()->max('id_simpanan_pokok');
		$noUrut = (int) substr($max_number, 3, 11);
		$noUrut++;
		// $date = date('dmY');
		$code = $format;
		$no_generate = $code . sprintf("%03s", $noUrut);

		return (string) $no_generate;
	}

	function get_debet_simpanan_wajib( $id_nasabah )
	{
		$query = DB::table('tb_simpanan_wajib')
				->where('id_nasabah', $id_nasabah)
				->sum('debet');

		return $query;
	}
	function get_kredit_simpanan_wajib( $id_nasabah )
	{
		$query = DB::table('tb_simpanan_wajib')
				->where('id_nasabah', $id_nasabah)
				->sum('kredit');

		return $query;
	}	
	function get_debet_simpanan_pokok( $id_nasabah )
	{
		$query = DB::table('tb_simpanan_pokok')
				->where('id_nasabah', $id_nasabah)
				->sum('debet');

		return $query;
	}
	function get_kredit_simpanan_pokok( $id_nasabah )
	{
		$query = DB::table('tb_simpanan_pokok')
				->where('id_nasabah', $id_nasabah)
				->sum('kredit');

		return $query;
	}
	function get_collection_simpanan_wajib( $id_nasabah )
	{
		$query = DB::table('tb_simpanan_wajib')
				->where('id_nasabah', $id_nasabah)
				->select('*');

		return $query->get();
	}

	function get_collection_simpanan_pokok( $id_nasabah )
	{
		$query = DB::table('tb_simpanan_pokok')
				->where('id_nasabah', $id_nasabah)
				->select('*');

		return $query->get();
	}

	function get_all_tabungan_nasabah($params)
    {
		$query = DB::table('tb_simpanan_wajib as a')
				->join('tb_nasabah as b','a.id_nasabah','=','b.id_nasabah')
				->select('a.*','b.nama_nasabah')
				->orderBy('a.tanggal');

		if(!empty($params['id_nasabah'])){
			$query->where('a.id_nasabah', '=', $params['id_nasabah']);
		}
		
		return $query->get();
    }

	function get_all_tabungan_pokok_nasabah($params)
    {
		$query = DB::table('tb_simpanan_pokok as a')
				->join('tb_nasabah as b','a.id_nasabah','=','b.id_nasabah')
				->select('a.*','b.nama_nasabah')
				->orderBy('a.tanggal');

		if(!empty($params['id_nasabah'])){
			$query->where('a.id_nasabah', '=', $params['id_nasabah']);
		}
		
		return $query->get();
    }


}
