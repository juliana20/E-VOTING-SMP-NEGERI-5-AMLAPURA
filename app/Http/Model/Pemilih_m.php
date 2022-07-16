<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Pemilih_m extends Model
{
	protected $table = 'm_pemilih';
	protected $index_key = 'id';
    public $timestamps  = false;

	public $rules;

    public function __construct()
	{
        $this->rules = [
            'insert' => [
                'nis' => "required|unique:{$this->table}",
				'nama_pemilih' => 'required'
            ],
			'update' => [
				'nis' => 'required',
				'nama_pemilih' => 'required'
            ],
        ];
	}

    function get_all()
    {
		$query = DB::table("{$this->table} as a")
					->join('m_kelas as b','a.kelas_id','=','b.id')
					->join('m_admin as c','a.user_id','=','c.id')
					->select('a.*','b.nama_kelas','c.username','c.password');
        return $query->get();
    }

    function insert_data($data)
	{
		return self::insert($data);
	}

	function get_one($id)
	{
		$query = DB::table("{$this->table} as a")
					->join('m_kelas as b','a.kelas_id','=','b.id')
					->join('m_admin as c','a.user_id','=','c.id')
					->select('a.*','b.nama_kelas','c.username','c.password')
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
