<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Services;

class Rumus extends BaseController
{
    public function index()
    {
        return redirect()->to('/admin/pengaturan-tunjangan');
    }

    public function get()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/pengaturan-tunjangan');

        $rumus = $this->rumusM->find($this->request->getVar('id'));

        if ($rumus['nama'] == 'pangan') {
            $temp = explode('|', $rumus['rumus']);
            $rumus['rumus'] = $temp[0];
            $rumus['nominal'] = $temp[1];
        }

        $output = [
            'rumus' => $rumus,
            'nama' => $rumus['nama'],
            csrf_token() => csrf_hash()
        ];

        $this->session->set('id_rumus', $this->request->getVar('id'));

        return $this->response->setJSON($output);
    }

    public function edit()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/pengaturan-tunjangan');

        $validation = [
            'persentase' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ]
        ];

        if ($this->request->getVar('nominal')) {
            $validation['nominal'] = [
                'rules'     => 'required|is_natural|less_than_equal_to[2147483647]',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_natural'  =>  'Nominal harus lebih dari 0',
                ]
            ];
        }

        if (!$this->validate($validation)) {
            $errors = Services::validation()->getErrors();

            $output = [
                'error' => $errors,
                csrf_token() => csrf_hash()
            ];

            return $this->response->setJSON($output);
        }

        $this->rumusM->save([
            'id_rumus' => $this->session->get('id_rumus'),
            'rumus' => $this->request->getVar('persentase') . (($this->request->getVar('nominal')) ? '|' . $this->request->getVar('nominal') : ''),
        ]);

        $this->session->remove('id_rumus');
        $this->session->setFlashdata('pesan', 'Rumus Berhasil Diperbarui');

        $output = [
            'redirect' => '/admin/pengaturan-tunjangan',
            'error' => [],
            csrf_token() => csrf_hash()
        ];

        return $this->response->setJSON($output);
    }
}
