<?php

// perhatikan namespace nya
namespace App\Controllers\Admin;

// pake use biar bisa extends ke luar folder
use App\Controllers\BaseController;

class Users extends BaseController
{
    public function index ()
         {
             echo "ini adalah controller Coba method index";
         }
     
        public function about($nama = '')
        {
            echo "Halo nama saya $nama";
        }
}
