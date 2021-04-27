<?php

namespace App\Controllers\Admin\Tunjangan;

use App\Controllers\BaseController;
use Config\Services;

class Pengaturan extends BaseController
{
    public function index()
    {
        $data = [
            'jabatan' => $this->tunjanganM->getTunjangan('Jabatan'),
            'operasional' => $this->tunjanganM->getTunjangan('Operasional'),
            'lain_lain' => $this->tunjanganM->getTunjangan('teller'),
            'rumus' => $this->rumusM->findAll()
        ];

        foreach ($this->tunjanganM->getTunjangan('auditor') as $value)
            array_push($data['lain_lain'], $value);

        return view('admin/tunjangan/pengaturan', $data);
    }

    public function tambah()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/pengaturan-tunjangan');

        $jabatan = $this->request->getVar('jabatan');
        $jenisTunjangan = $this->request->getVar('jenis_tunjangan');
        $valJabatan = '';

        foreach ($this->tunjanganM->getTunjangan($jenisTunjangan) as $value)
            if (in_array($jabatan, $value))
                $valJabatan = '|is_unique[tunjangan.jabatan]';

        if (!$this->validate([
            'jabatan' => [
                'rules'     => 'required' . $valJabatan,
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique'  =>  'Jabatan sudah ada',
                ]
            ],
            'jenis_tunjangan' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                ]
            ], 'nominal' => [
                'rules'     => 'required|is_natural',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_natural'  =>  'Nominal harus lebih dari 0',
                ]
            ]
        ])) {
            $errors = Services::validation()->getErrors();

            $output = [
                'error' => $errors,
                csrf_token() => csrf_hash()
            ];

            return $this->response->setJSON($output);
        }

        $this->tunjanganM->save([
            'jabatan' => $jabatan,
            'jenis_tunjangan' => $jabatan,
            'nominal' => $this->request->getVar('nominal')
        ]);

        $this->session->setFlashdata('pesan', 'Tunjangan Berhasil Ditambahkan');

        $output = [
            'redirect' => '/admin/pengaturan-tunjangan',
            'error' => [],
            csrf_token() => csrf_hash()
        ];

        return $this->response->setJSON($output);
    }

    public function get()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/pengaturan-tunjangan');

        $output = [
            'pengaturan' => $this->tunjanganM->find($this->request->getVar('id')),
            csrf_token() => csrf_hash()
        ];

        $this->session->set('id_tunjangan', $this->request->getVar('id'));

        return $this->response->setJSON($output);
    }

    public function edit()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/pengaturan-tunjangan');

        $id = $this->session->get('id_tunjangan');
        $jabatan = $this->request->getVar('jabatan');
        $tunjangan = $this->tunjanganM->find($id);
        $valJabatan = '';

        if ($tunjangan['jabatan'] != $jabatan)
            foreach ($this->tunjanganM->getTunjangan($tunjangan['jenis_tunjangan']) as $element)
                if (in_array($jabatan, $element))
                    $valJabatan = '|is_unique[tunjangan.jabatan]';

        if (!$this->validate([
            'jabatan' => [
                'rules'     => 'required' . $valJabatan,
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique'  =>  'Jabatan sudah ada',
                ]
            ], 'nominal' => [
                'rules'     => 'required|is_natural|less_than_equal_to[2147483647]',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_natural'  =>  'Nominal harus lebih dari 0',
                ]
            ]
        ])) {
            $errors = Services::validation()->getErrors();

            $output = [
                'error' => $errors,
                csrf_token() => csrf_hash()
            ];

            return $this->response->setJSON($output);
        }

        $this->tunjanganM->save([
            'id_tunjangan' => $id,
            // 'jabatan' => $jabatan,
            'nominal' => $this->request->getVar('nominal')
        ]);

        // if ($tunjangan['jabatan'] != $jabatan) {
        //     $pegawai = $this->pegawaiM->getPegawaiJabatan($tunjangan['jabatan']);
        //     foreach ($pegawai as $value) :
        //         $this->pegawaiM->save([
        //             'id_pegawai' => $value['id_pegawai'],
        //             'jabatan' => $jabatan,
        //         ]);
        //     endforeach;
        // }

        $this->payroll($this->pegawaiM->findAll());

        $this->session->remove('id_tunjangan');
        $this->session->setFlashdata('pesan', 'Tunjangan Berhasil Diperbarui');

        $output = [
            'redirect' => '/admin/pengaturan-tunjangan',
            'error' => [],
            csrf_token() => csrf_hash()
        ];

        return $this->response->setJSON($output);
    }
}
