<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Kelas_m extends Model
{
	protected $table = 'm_kelas';
	protected $index_key = 'id';
	protected $index_key2 = 'kode_kelas';
    public $timestamps  = false;

	public $rules;

    public function __construct()
	{
        $this->rules = [
            'insert' => [
				'kode_kelas' => "required|unique:{$this->table}",
                'nama_kelas' => "required|unique:{$this->table}",
            ],
			'update' => [
				'kode_kelas' => "required",
				'nama_kelas' => 'required',
            ],
        ];
	}

    function get_all()
    {
        return self::get();
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
		$noUrut = (int) substr($max_number, 3, 3);
		$noUrut++;
		$code = $format;
		$no_generate = $code . sprintf("%03s", $noUrut);

		return (string) $no_generate;
	}
}
