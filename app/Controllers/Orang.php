<?php

namespace App\Controllers;

use App\Models\OrangModel;

class Orang extends BaseController
{
  protected $orangModel;
  public function __construct()
  {
    $this->orangModel = new OrangModel();
  }

  public function index()
  {

    //klo di url nya ada keterangan angka page brp maka angka itu akan jadi current page, klo gada currentPage nya = 1
    $currentPage = $this->request->getVar('page_orang') ? $this->request->getVar('page_orang') : 1;

    // nangkap input dari user di kolom search
    $keyword = $this->request->getVar('keyword');
    if ($keyword) {
      $orang = $this->orangModel->search($keyword);
    } else {
      $orang = $this->orangModel;
    }

    $data = [
      'title' => 'Daftar Orang',
      // 'orang' => $this->orangModel->findAll()
      // kalo ngubah jumlah paginate, jgn lupa ubah perhitungannya di index
      // 'orang' => $this->orangModel->paginate(10, 'orang'),
      'orang' => $orang->paginate(10, 'orang'),
      'pager' => $this->orangModel->pager,
      'currentPage' => $currentPage
    ];
    
    return view('orang/index', $data);
  }

}