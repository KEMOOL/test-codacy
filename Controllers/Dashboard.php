<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'pegawai' => $this->pegawaiM->getPegawaiEmail($this->session->get('email'))
        ];

        return view('dashboard', $data);
    }
}
