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
      // karna punya data, maka kasih $data
      return view('pages/home', $data);
    }

    public function about()
    {
      $data = [
        'title' => 'About Me'
      ];
        return view('pages/about', $data);
    }

    public function contact()
    {
      $data = [
        'title' => 'Contact Us',
        'alamat' => [
          [
            'tipe' => 'Rumah',
            'alamat' => 'Jl. abc No. 123',
            'kota' => 'Bandung'
          ],
          [
            'tipe' => 'Kantor',
            'alamat' => 'Jl. Setiabudi No. 193',
            'kota' => 'Bandung'
          ]
        ]
      ];
        return view('pages/contact', $data);
    }
}

?>