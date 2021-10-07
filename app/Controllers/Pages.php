<?php
// file ini untuk menangani halaman statis 

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
      $data = [
        'title' => 'Home | Mila',
        'tes' => ['satu', 'dua', 'tiga']
      ];
      echo view('layout/header', $data);
      echo view('pages/home');
      echo view('layout/footer');
    }

    public function about()
    {
      $data = [
        'title' => 'About Me'
      ];
      // biar bisa manggil beberapa view pake echo, karna dlm function cuma boleh ada 1 return 
        echo view('layout/header', $data);
        echo view('pages/about');
        echo view('layout/footer');
    }
}

?>