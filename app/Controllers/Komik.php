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
    // karna input terkirim di session, kita kasih session() buat nangkep
    // session();     dipindahin ke baseController
    $data = [
      'title' => 'Form Tambah Data Komik',
      'validation' => \Config\Services::validation()
    ];

    return view('komik/create', $data);
  }


  // utk mengelola data yg dikirim dari create, utk diinsert kedalam table
  public function save()
  {
    // validasi input
    // jika this tdk tervalidasi, maka buat kondisi
    if(!$this->validate([
      // 'judul' => 'required|is_unique[komik.judul]'

      // custom pesan error
      'judul' => [
        'rules' => 'required|is_unique[komik.judul]',
        'errors' => [
          'required' => '{field} komik harus diisi',
          'is_unique' => '{field} komik sudah terdaftar'
        ]
        ],
        'sampul' => 'uploaded[sampul]'
    ])) {
      // menampilkan pesan kesalahan
      $validation = \Config\Services::validation();             // key , value
      return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
    }
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

  public function delete($id)
  {
    $this->komikModel->delete($id);
    session()->setFlashdata('pesan', 'Data berhasil dihapus.');
    return redirect()->to('/komik');
  }

  public function edit($slug)
  {
    $data = [
      'title' => 'Form Ubah Data Komik',
      'validation' => \Config\Services::validation(),
      'komik' => $this->komikModel->getKomik($slug)
    ];

    return view('komik/edit', $data);
  }

  public function update($id)
  {
    // cek judul
    $komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
    if($komikLama['judul'] == $this->request->getVar('judul')) {
      $rule_judul = 'reuired';
    } else {
      $rule_judul = 'required|is_unique[komik.judul]';
    }

    if(!$this->validate([
      // 'judul' => 'required|is_unique[komik.judul]'

      // custom pesan error
      'judul' => [
        'rules' => $rule_judul,
        'errors' => [
          'required' => '{field} komik harus diisi',
          'is_unique' => '{field} komik sudah terdaftar'
        ]
        ],
        // gambar wajib diisi
        'sampul' =>'uploaded[sampul]'
    ])) {
      // menampilkan pesan kesalahan
    //  $validation = \Config\Services::validation();             // key , value
      // return redirect()->to('/komik/edit/'. $this->request->getVar('slug'))->withInput()->with('validation', $validation);
      return redirect()->to('/komik/edit/'. $this->request->getVar('slug'))->withInput();
    }

    // getvar() gausah diisi karna mau ambil semua inputannya
    // dd($this->request->getVar());

    $slug = url_title($this->request->getVar('judul'), '-', true);
    // save = INSERT INTO model  (CI4)
    $this->komikModel->save([
      'id' => $id,
      'judul' => $this->request->getVar('judul'),
      'slug' => $slug,
      'penulis' => $this->request->getVar('penulis'),
      'penerbit' => $this->request->getVar('penerbit'),
      'sampul' => $this->request->getVar('sampul')
    ]);

    session()->setFlashdata('pesan', 'Data berhasil diubah.');

    return redirect()->to('/komik');
  }

}