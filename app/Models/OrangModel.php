<?php

namespace App\Models;

use CodeIgniter\Model;

class OrangModel extends Model
{
  protected $table = 'orang';
  protected $useTimeStamps = true;
  // field mana aja yg boleh kita input dari form tambah data
  protected $allowedFields = ['nama','alamat'];

  // bikin pencarian berdasarkan keyword
  public function search($keyword)
  {
    // $builder = $this->table('orang');
    // $builder->like('nama', $keyword);
    // return $builder;

    return $this->table('orang')->like('nama', $keyword)->orLike('alamat', $keyword);
  }
}