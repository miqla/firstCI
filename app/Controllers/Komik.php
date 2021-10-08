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
    
    // jika komik tidak ada di tabel
    if(empty($data['komik'])) {
      // utk menampilkan exception dari CI4
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul komik '. $slug . ' tidak ditemukan.');
    }

    return view('komik/detail', $data);
  }

  public function create()
  {
    $data = [
      'title' => 'Form Tambah Data Komik'
    ];

    return view('komik/create', $data);
  }

  // utk mengelola data yg dikirim dari create, utk diinsert kedalam table
  public function save()
  {
    // getVar() = bisa nerima semua method POST dan GET
    // dd($this->request->getVar());

    // url_title() = biar stringnya ramah URL
    $slug = url_title($this->request->getVar('judul'), '-', true);
    // save = INSERT INTO model  (CI4)
    $this->komikModel->save([
      'judul' => $this->request->getVar('judul'),
      'slug' => $slug,
      'penulis' => $this->request->getVar('penulis'),
      'penerbit' => $this->request->getVar('penerbit'),
      'sampul' => $this->request->getVar('sampul')
    ]);

    // buat bikin flashdata
    session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

    return redirect()->to('/komik');
  }
}