<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use \Config\Services;

class Pelatihan extends BaseController
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
            'judul_pelatihan' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'penyelenggara'                   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  '{field} sudah ada'
                ]
            ],
            'tanggal_pelatihan'                 => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'lokasi'                   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ], 'dokumen_pelatihan' => [
                'rules' => 'max_size[dokumen_pelatihan,2048]|mime_in[dokumen_pelatihan,application/pdf,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran file tidak boleh lebih dari 2 MB',
                    'mime_in' => 'file file salah'
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

        $files = $this->request->getFiles();
        $file = '';
        foreach ($files['dokumen_pelatihan'] as $dokumen) {
            if ($dokumen->isValid() && !$dokumen->hasMoved()) {
                $filename = $dokumen->getRandomName();
                $dokumen->move('dokumen/pelatihan/' . $pegawai['id_pegawai'], $filename);
                $file .= $filename . '|';
            }
        }

        $tanggal = explode('-', $this->request->getVar('tanggal_pelatihan'));
        $tanggal = trim($tanggal[0]) . ' - ' . trim($tanggal[1]);

        $this->pelatihanM->save([
            'id_pegawai' => $pegawai['id_pegawai'],
            'judul' => $this->request->getVar('judul_pelatihan'),
            'penyelenggara' => $this->request->getVar('penyelenggara'),
            'tanggal' => $tanggal,
            'lokasi' => $this->request->getVar('lokasi'),
            'dokumen' => rtrim($file, '|')
        ]);

        $output = [
            'redirect' => '/admin/pegawai/' . $pegawai['nik'],
            'error' => [],
            csrf_token() => csrf_hash()
        ];

        $this->session->setFlashdata('pesan', 'Pelatihan Berhasil Ditambahkan');

        return $this->response->setJSON($output);
    }

    public function get()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/pegawai');

        $output = [
            'pelatihan' => $this->pelatihanM->find($this->request->getVar('id')),
            csrf_token() => csrf_hash()
        ];

        $this->session->set('id_pelatihan', $this->request->getVar('id'));

        return $this->response->setJSON($output);
    }
    public function edit()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/pegawai');

        if (!$this->validate([
            'judul_pelatihan' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'penyelenggara'                   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'tanggal_pelatihan'                 => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'lokasi'                   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ], 'dokumen_pelatihan' => [
                'rules' => 'max_size[dokumen_pelatihan,2048]|mime_in[dokumen_pelatihan,application/pdf,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran file tidak boleh lebih dari 2 MB',
                    'mime_in' => 'file file salah'
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
        $pelatihan = $this->pelatihanM->find($this->session->get('id_pelatihan'));

        $data = [
            'id_pelatihan' => $pelatihan['id_pelatihan'],
            'id_pegawai' => $pegawai['id_pegawai'],
            'judul' => $this->request->getVar('judul_pelatihan'),
            'penyelenggara' => $this->request->getVar('penyelenggara'),
            'tanggal' => $this->request->getVar('tanggal_pelatihan'),
            'lokasi' => $this->request->getVar('lokasi'),
        ];

        $files = $this->request->getFiles();
        $file = '';

        foreach ($files['dokumen_pelatihan'] as $dokumen) {
            if ($dokumen->isValid() && !$dokumen->hasMoved()) {
                $filename = $dokumen->getRandomName();
                $dokumen->move('dokumen/pelatihan/' . $pegawai['id_pegawai'], $filename);
                $file .= $filename . '|';
            }
        }

        if ($file != '') {
            $dokumen = explode('|', $pelatihan['dokumen']);

            foreach ($dokumen as $value) :
                unlink('dokumen/pelatihan/' . $pegawai['id_pegawai'] . '/' . $value);
            endforeach;

            $data['dokumen'] = rtrim($file, '|');
        }

        $this->pelatihanM->save($data);

        $output = [
            'redirect' => '/admin/pegawai/' . $pegawai['nik'],
            'error' => [],
            csrf_token() => csrf_hash()
        ];

        $this->session->setFlashdata('pesan', 'Pelatihan Berhasil Diperbarui');

        return $this->response->setJSON($output);
    }

    public function delete($id)
    {
        if ($this->request->getMethod(true) != 'DELETE')
            return redirect()->to('/admin/pegawai/' . $this->session->get('nik'));

        $pelatihan = $this->pelatihanM->find($id);
        $pegawai = $this->pegawaiM->getPegawaiNIK($this->session->get('nik'));

        if ($pelatihan['id_pegawai'] != $pegawai['id_pegawai'])
            return redirect()->to('/admin/pegawai/' . $pegawai['nik']);

        $dokumen = explode('|', $pelatihan['dokumen']);

        foreach ($dokumen as $dokumen) :
            unlink('dokumen/pelatihan/' . $pegawai['id_pegawai'] . '/' . $dokumen);
        endforeach;

        $this->pelatihanM->delete($id);

        $this->session->setFlashdata('pesan', 'Pelatihan Berhasil Dihapus');

        return redirect()->to('/admin/pegawai/' . $pegawai['nik']);
    }
}
