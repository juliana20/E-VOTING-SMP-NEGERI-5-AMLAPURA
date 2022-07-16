<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Mutasi_kas_detail_m extends Model
{
	protected $table = 'tb_mutasi_kas_detail';
	protected $index_key = 'id';
	protected $index_key2 = 'id_mutasi_kas';
    public $timestamps  = false;

	public $rules;

    public function __construct()
	{
        $this->rules = [
            'insert' => [
                'id_mutasi_kas' => "required",
				'akun_id' => 'required',
            ],
			'update' => [
				'id_mutasi_kas' => "required",
				'akun_id' => 'required',
            ],
        ];
	}

    function get_all()
    {
        return self::get();
    }

	function collection($id)
	{
		$query = DB::table("{$this->table} as a")
				->join('tb_akun as b','b.id_akun','=','a.akun_id')
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


}
