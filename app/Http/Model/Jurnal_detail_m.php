<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Jurnal_detail_m extends Model
{
	protected $table = 'tb_detail_jurnal';
	protected $index_key = 'id';
	protected $index_key2 = 'id_jurnal';
    public $timestamps  = false;

	public $rules;

    public function __construct()
	{
        $this->rules = [
            'insert' => [
                'id_jurnal' => "required",
            ],
			'update' => [
				'id_jurnal' => 'required',
            ],
        ];
	}

    function get_all()
    {
		$query = DB::table("{$this->table} as a")
				->join('tb_akun as b','a.id_akun','=','b.id_akun')
				->select('a.*','b.nama_akun');
        return $query->get();
    }
	function collection($id)
	{
		$query = DB::table("{$this->table} as a")
				->join('tb_akun as b','b.id_akun','=','a.id_akun')
				->select('a.*','b.nama_akun')
				->where("a.{$this->index_key2}", $id);
				
		return $query->get();
	}

    function insert_data($data)
	{
		return self::insert($data);
	}

	function get_one($id)
	{
		$query = DB::table("{$this->table} as a")
				->join('tb_akun as b','a.id_akun','=','b.id_akun')
				->select('a.*','b.nama_akun')
				->where("a.{$this->index_key}", $id);

		return $query->first();
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

}
