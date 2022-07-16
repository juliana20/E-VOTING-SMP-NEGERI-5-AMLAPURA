<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Sub_kriteria_m extends Model
{
	protected $table = 'm_sub_kriteria';
	protected $index_key = 'id';
	protected $index_key2 = 'kode_sub_kriteria';
    public $timestamps  = false;

	public $rules;

    public function __construct()
	{
        $this->rules = [
            'insert' => [
                'kode_sub_kriteria' => "required|unique:{$this->table}",
				'nama_sub_kriteria' => 'required'
            ],
			'update' => [
				'nama_sub_kriteria' => 'required'
            ],
        ];
	}

    function get_all()
    {
		$query = DB::table("{$this->table} as a")
					->join('m_kriteria as b','b.id','=','a.kriteria_id')
					->select('a.*','b.nama_kriteria');

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

	function gen_code( $format )
	{
		$max_number = self::all()->max($this->index_key2);
		$noUrut = (int) substr($max_number, 1, 3);
		$noUrut++;
		$code = $format;
		$no_generate = $code . sprintf("%03s", $noUrut);

		return (string) $no_generate;
	}

}
