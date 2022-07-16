<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Pinjaman_detail_m extends Model
{
	protected $table = 'tb_pinjaman_detail';
	protected $index_key = 'id';
	protected $index_ke2 = 'id_pinjaman';
    public $timestamps  = false;

	public $rules;

    public function __construct()
	{

	}

    function get_all()
    {
        return self::get();
    }

	function get_all_collection($id)
    {
        return self::where([$this->index_ke2 => $id])->orderBy('tanggal','DESC')->get();
    }

    function insert_data($data)
	{
		return self::insert($data);
	}

	function get_one($id)
	{
		$query = DB::table("{$this->table} as a")
			     ->join('tb_pinjaman as b','a.id_pinjaman','=','b.id_pinjaman')
				 ->join('tb_nasabah as c','b.id_nasabah','=','c.id_nasabah')
				 ->join('tb_user as d','a.id_user','=','d.id')
				 ->select('a.*','c.nama_nasabah','c.tanggal_daftar','d.nama_user','b.no_rek_tabungan')
				 ->where("a.{$this->index_key}", $id);

		return 	$query->first();
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
	function get_jumlah_sudah_dibayar( $id )
	{
		$query = DB::table($this->table)
				->where($this->index_ke2, $id)
				->sum('total');

		return $query;
	}
	function get_jumlah_pokok_sudah_dibayar( $id )
	{
		$query = DB::table($this->table)
				->where($this->index_ke2, $id)
				->sum('pokok');

		return $query;
	}
	function get_jumlah_bunga_sudah_dibayar( $id )
	{
		$query = DB::table($this->table)
				->where($this->index_ke2, $id)
				->sum('bunga');

		return $query;
	}
	function get_tanggal_bayar_terakhir( $id )
	{
		$query = DB::table($this->table)
				->where($this->index_ke2, $id)
				->orderBy('tanggal','DESC')
				->limit(1);

		return $query;
	}


}
