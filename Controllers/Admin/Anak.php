<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use \Config\Services;

class Anak extends BaseController
{
    public function index()
    {
        return redirect()->to('/admin/pegawai');
    }

    public function tambah()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/pegawai');

        if (!$this->validate([
            'nama_anak' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'nik_anak'                   => [
                'rules'     => 'required|is_unique[anak.nik]',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  'NIK sudah terdaftar'
                ]
            ],
            'ttl_anak'                 => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'jenis_kelamin'                 => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'pekerjaan_anak'                   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'hubungan_anak'                   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'pendidikan_anak'                   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
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

        $pegawai = $this->pegawaiM->getPegawaiNIK($this->session->get('nik'));

        $this->anakM->save([
            'id_pegawai' => $pegawai['id_pegawai'],
            'nama' => $this->request->getVar('nama_anak'),
            'nik' => $this->request->getVar('nik_anak'),
            'ttl' => $this->request->getVar('ttl_anak'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'pekerjaan' => $this->request->getVar('pekerjaan_anak'),
            'hubungan' => $this->request->getVar('hubungan_anak'),
            'pendidikan' => $this->request->getVar('pendidikan_anak'),
        ]);

        $output = [
            'redirect' => '/admin/pegawai/' . $pegawai['nik'],
            'error' => [],
            csrf_token() => csrf_hash()
        ];

        $this->session->setFlashdata('pesan', 'Keluarga Berhasil Ditambahkan');

        return $this->response->setJSON($output);
    }

    public function get()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/pegawai');

        $output = [
            'anak' => $this->anakM->find($this->request->getVar('id')),
            csrf_token() => csrf_hash()
        ];

        $this->session->set('id_anak', $this->request->getVar('id'));

        return $this->response->setJSON($output);
    }
    public function edit()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/pegawai');

        $anak = $this->anakM->find($this->session->get('id_anak'));

        if ($this->request->getVar('nik') != $anak['nik'])
            $valNIK = '|is_unique[anak.nik]';
        else
            $valNIK = '';

        if (!$this->validate([
            'nama_anak' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'nik_anak'                   => [
                'rules'     => "required|$valNIK",
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  'NIK sudah terdaftar'
                ]
            ],
            'ttl_anak'                 => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'jenis_kelamin'                 => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'pekerjaan_anak'                   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'hubungan_anak'                   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'pendidikan_anak'                   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
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

        $pegawai = $this->pegawaiM->getPegawaiNIK($this->session->get('nik'));

        $this->anakM->save([
            'id_anak' => $anak['id_anak'],
            'id_pegawai' => $pegawai['id_pegawai'],
            'nama' => $this->request->getVar('nama_anak'),
            'nik' => $this->request->getVar('nik_anak'),
            'ttl' => $this->request->getVar('ttl_anak'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'pekerjaan' => $this->request->getVar('pekerjaan_anak'),
            'hubungan' => $this->request->getVar('hubungan_anak'),
            'pendidikan' => $this->request->getVar('pendidikan_anak'),
        ]);

        $output = [
            'redirect' => '/admin/pegawai/' . $pegawai['nik'],
            'error' => [],
            csrf_token() => csrf_hash()
        ];

        $this->session->setFlashdata('pesan', 'Keluarga Berhasil Ditambahkan');

        return $this->response->setJSON($output);
    }

    public function delete($nik)
    {
        if ($this->request->getMethod(true) != 'DELETE')
            return redirect()->to('/admin/pegawai/' . $this->session->get('nik'));

        $anak = $this->anakM->getAnakNIK($nik);
        $pegawai = $this->pegawaiM->getPegawaiNIK($this->session->get('nik'));

        if ($anak['id_pegawai'] != $pegawai['id_pegawai'])
            return redirect()->to('/admin/pegawai/' . $pegawai['nik']);

        $this->anakM->delete($anak['id_anak']);

        $this->session->setFlashdata('pesan', 'Keluarga Berhasil Dihapus');

        return redirect()->to('/admin/pegawai/' . $pegawai['nik']);
    }
}
