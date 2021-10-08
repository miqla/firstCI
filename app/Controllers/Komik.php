<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{
  protected $komikModel;
  public function __construct()
  {
    $this->komikModel = new KomikModel();
  }

  public function index()
  {
    // querySQL, findAll = SELECT * FROM
    // $komik = $this->komikModel->findAll();

    $data = [
      'title' => 'Daftar Komik',
      'komik' => $this->komikModel->getKomik()
    ];

    // cara konek db tanpa model
    // $db = \Config\Database::connect();
    // $komik = $db->query("SELECT * FROM komik");
    // foreach ($komik->getResultArray() as $row) {
    //   d($row);
    // }

    // instansiasi kelas KomikModel
    // $komikModel = new \App\Models\KomikModel();
    // $komikModel = new KomikModel();  pindah keatas, __construct
    

    return view('komik/index', $data);
  }

  public function detail($slug)
  {
    // first() = ambil data pertamanya
    // $komik = $this->komikModel->where(['slug' => $slug])->first();
    
    $data = [
      'title' => 'Detail Komik',
      'komik' => $this->komikModel->getKomik($slug)
    ];
    return view('komik/detail', $data);
  }

}