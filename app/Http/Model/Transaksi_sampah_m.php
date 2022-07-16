<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Transaksi_sampah_m extends Model
{
	protected $table = 't_sampah';
	protected $index_key = 'id';
	protected $index_key2 = 'kode_transaksi_sampah';
    public $timestamps  = false;

	public $rules;

    public function __construct()
	{
        $this->rules = [
            'insert' => [
                'kode_transaksi_sampah' => "required|unique:{$this->table}",
				'pelanggan_id' => 'required',
				'user_id' => 'required',
				'tanggal' => 'required',
				'jumlah' => 'required|numeric',
            ],
			'update' => [
				'pelanggan_id' => 'required',
				'user_id' => 'required',
				'tanggal' => 'required',
				'jumlah' => 'required|numeric',
            ],
        ];
	}

    function get_all()
    {
		$query = DB::table("{$this->table} as a")
				->join('m_pelanggan as b','a.pelanggan_id','=','b.id')
				->join('m_user as c','a.user_id','=','c.id')
				->select(
					'a.*',
					'b.nama as nama_pelanggan', 
					'c.nama as nama_user'
				)->get();
		
		return $query;
    }

    function insert_data($data)
	{
		return self::insert($data);
	}


	function get_one($id)
	{
		$query = DB::table("{$this->table} as a")
				->join('m_pelanggan as b','a.pelanggan_id','=','b.id')
				->join('m_user as c','a.user_id','=','c.id')
				->where("a.{$this->index_key}", $id)
				->select(
					'a.*',
					'b.nama as nama_pelanggan', 
					'c.nama as nama_user'
				)->first();

		return $query;
	}

	function get_by( $where )
	{
		$query = DB::table("{$this->table} as a")
				->join('m_pelanggan as b','a.pelanggan_id','=','b.id')
				->join('m_user as c','a.user_id','=','c.id')
				->where($where)
				->select(
					'a.*',
					'b.nama as nama_pelanggan', 
					'c.nama as nama_user'
				)->first();

		return $query;

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
		$noUrut = (int) substr($max_number, 5, 5);
		$noUrut++;
		$code = $format;
		$no_generate = $code . sprintf("%05s", $noUrut);

		return (string) $no_generate;
	}

}
