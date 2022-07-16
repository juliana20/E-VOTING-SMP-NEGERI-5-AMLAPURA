<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Pinjaman_m extends Model
{
	protected $table = 'tb_pinjaman';
	protected $index_key = 'id';
	protected $index_key2 = 'id_pinjaman';
    public $timestamps  = false;

	public $rules;

    public function __construct()
	{
		$this->rules = [
            'insert' => [
                'id_pinjaman' => "required|unique:{$this->table}",
				'id_nasabah' => "required",
				'id_user' => "required",
				'tgl_realisasi' => "required",
				'no_rek_tabungan' => "required",
				'jangka_waktu' => "required",
				'jatuh_tempo' => "required",
            ],
			'update' => [
				'id_nasabah' => "required",
				'id_user' => "required",
				'tgl_realisasi' => "required",
				'no_rek_tabungan' => "required",
				'jangka_waktu' => "required",
				'jatuh_tempo' => "required",
            ],
        ];

	}

    function get_all()
    {
		$query = DB::table("{$this->table} as a")
				 ->join('tb_nasabah as b','a.id_nasabah','=','b.id_nasabah')
				 ->join('tb_user as c','a.id_user','=','c.id')
				 ->select('a.*','b.nama_nasabah','b.tanggal_daftar','c.nama_user');

		return 	$query->get();
    }

	function get_all_angsuran($params)
    {
		$query = DB::table("{$this->table} as a")
				->join('tb_pinjaman_detail as b','a.id_pinjaman','=','b.id_pinjaman')
				->join('tb_nasabah as c','a.id_nasabah','=','c.id_nasabah')
				->select('b.*','c.nama_nasabah','a.id_nasabah','a.no_rek_tabungan');

		if(!empty($params['proses']) && $params['proses'] == 1){
			$query->where('b.proses', '=', 1);
		}else{
			$query->where('b.proses', '=', 0);
		}
		if(!empty($params['date_start']) && !empty($params['date_end'])){
			$query->where('b.tanggal', '>=', date('Y-m-d', strtotime($params['date_start'])));
			$query->where('b.tanggal', '<=', date('Y-m-d', strtotime($params['date_end'])));
		}
		return $query->get();
    }

	function get_all_nasabah()
    {
		$query = DB::table("tb_nasabah as a")
				 ->where('anggota', 1)
				 ->select('a.*');

		return 	$query->get();
    }

    function insert_data($data)
	{
		return self::insert($data);
	}

	function get_one($id)
	{
		$query = DB::table("{$this->table} as a")
				 ->join('tb_nasabah as b','a.id_nasabah','=','b.id_nasabah')
				 ->join('tb_user as c','a.id_user','=','c.id')
				 ->select('a.*','b.nama_nasabah','b.tanggal_daftar','c.nama_user')
				 ->where("a.{$this->index_key}", $id);

		return 	$query->first();
	}

	function get_by( $where )
	{
		$query = DB::table("{$this->table} as a")
				 ->join('tb_nasabah as b','a.id_nasabah','=','b.id_nasabah')
				 ->join('tb_user as c','a.id_user','=','c.id')
				 ->select('a.*','b.nama_nasabah','b.tanggal_daftar','c.nama_user')
				 ->where($where);

		return 	$query->first();

	}

	function get_by_in( $where, $data )
	{
		$query = DB::table("{$this->table} as a")
				 ->join('tb_nasabah as b','a.id_nasabah','=','b.id_nasabah')
				 ->join('tb_user as c','a.id_user','=','c.id')
				 ->select('a.*','b.nama_nasabah','b.tanggal_daftar','c.nama_user')
				 ->whereIn($where, $data);

		return 	$query->get();

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

	function gen_no_pinjaman( $format )
	{
		$max_number = DB::table($this->table)->get()->max($this->index_key2);
		$noUrut = (int) substr($max_number, 3, 3);
		$noUrut++;
		$date = date('dmY');
		$code = $format . $date;
		$no_generate = $code . sprintf("%03s", $noUrut);

		return (string) $no_generate;
	}

	function get_all_pinjaman_nasabah($params)
    {
		$query = DB::table('tb_pinjaman as a')
				->join('tb_pinjaman_detail as b','a.id_pinjaman','=','b.id_pinjaman')
				->join('tb_nasabah as c','a.id_nasabah','=','c.id_nasabah')
				->select('b.*','c.nama_nasabah')
				->orderBy('b.tanggal');

		if(!empty($params['id_nasabah'])){
			$query->where('a.id_nasabah', '=', $params['id_nasabah']);
		}
		
		return $query->get();
    }

}
