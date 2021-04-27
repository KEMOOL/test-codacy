<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use \Config\Services;

class Cuti extends BaseController
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
            'tanggal_cuti' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ], 'jenis_cuti' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ], 'alasan' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ], 'lama_cuti' => [
                'rules'     => 'required|is_natural_no_zero',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_natural_no_zero'  =>  'Lama cuti minimal 1 hari'
                ]
            ], 'dokumen_cuti' => [
                'rules' => 'max_size[dokumen_cuti,2048]|mime_in[dokumen_cuti,application/pdf,image/jpeg,image/png]',
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
        $sisaCuti = $this->maxCuti;
        $error = [];

        if ($this->request->getVar('jenis_cuti') == 'Tahunan') {
            $cuti = $this->cutiM->getCutiTahunan($pegawai['id_pegawai']);
            foreach ($cuti as $value) :
                $sisaCuti = $sisaCuti - $value['lama'];
            endforeach;
        }

        if ($sisaCuti - $this->request->getVar('lama_cuti') >= 0 || $this->request->getVar('jenis_cuti') == 'Non-tahunan') {
            $dokumen = $this->request->getFile('dokumen_cuti');
            $filename = $dokumen->getRandomName();

            $dokumen->move('dokumen/cuti/' . $pegawai['id_pegawai'], $filename);

            $this->cutiM->save([
                'id_pegawai' => $pegawai['id_pegawai'],
                'tanggal' => $this->request->getVar('tanggal_cuti'),
                'jenis_cuti' => $this->request->getVar('jenis_cuti'),
                'alasan' => $this->request->getVar('alasan'),
                'lama' => $this->request->getVar('lama_cuti'),
                'dokumen' => $filename,
            ]);

            $this->session->setFlashdata('pesan', 'Cuti Berhasil Ditambahkan');
        } else $error = ['lama_cuti' => 'Lama cuti melebihii sisa cuti yang diperbolehkan'];


        $output = [
            'redirect' => '/admin/pegawai/' . $pegawai['nik'],
            'error' => $error,
            csrf_token() => csrf_hash()
        ];

        return $this->response->setJSON($output);
    }

    public function get()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/pegawai');

        $output = [
            'cuti' => $this->cutiM->find($this->request->getVar('id')),
            csrf_token() => csrf_hash()
        ];

        $this->session->set('id_cuti', $this->request->getVar('id'));

        return $this->response->setJSON($output);
    }

    public function edit()
    {
        if ($this->request->getMethod(true) != 'POST') {
            return redirect()->to('/admin');
        }

        if (!$this->validate([
            'tanggal_cuti' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ], 'jenis_cuti' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ], 'alasan' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ], 'lama_cuti' => [
                'rules'     => 'required|is_natural_no_zero',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_natural_no_zero'  =>  'Lama cuti minimal 1 hari'
                ]
            ], 'dokumen_cuti' => [
                'rules' => 'max_size[dokumen_cuti,2048]|mime_in[dokumen_cuti,application/pdf,image/jpeg,image/png]',
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
        $editCuti = $this->cutiM->find($this->session->get('id_cuti'));
        $sisaCuti = $this->maxCuti;
        $error = [];

        if ($this->request->getVar('jenis_cuti') == 'Tahunan') {
            $cuti = $this->cutiM->getCutiTahunan($pegawai['id_pegawai']);
            foreach ($cuti as $value) :
                if ($value['id_cuti'] == $editCuti['id_cuti'])
                    continue;

                $sisaCuti = $sisaCuti - $value['lama'];
            endforeach;
        }

        if ($sisaCuti - $this->request->getVar('lama_cuti') >= 0 || $this->request->getVar('jenis_cuti') == 'Non-tahunan') {
            $data = [
                'id_cuti' => $editCuti['id_cuti'],
                'id_pegawai' => $pegawai['id_pegawai'],
                'tanggal' => $this->request->getVar('tanggal_cuti'),
                'jenis_cuti' => $this->request->getVar('jenis_cuti'),
                'alasan' => $this->request->getVar('alasan'),
                'lama' => $this->request->getVar('lama_cuti'),
            ];

            $dokumen = $this->request->getFile('dokumen_cuti');

            if ($dokumen->getName() != '') {
                unlink('dokumen/cuti/' . $pegawai['id_pegawai'] . '/' . $editCuti['dokumen']);

                $filename = $dokumen->getRandomName();
                $dokumen->move('dokumen/cuti/' . $pegawai['id_pegawai'], $filename);

                $data['dokumen'] = $filename;
            }

            $this->cutiM->save($data);

            $this->session->setFlashdata('pesan', 'Cuti Berhasil Ditambahkan');
        } else $error = ['lama_cuti' => 'Lama cuti melebihii sisa cuti yang diperbolehkan'];

        $output = [
            'redirect' => '/admin/pegawai/' . $pegawai['nik'],
            'error' => $error,
            csrf_token() => csrf_hash()
        ];

        return $this->response->setJSON($output);
    }

    public function delete($id)
    {
        if ($this->request->getMethod(true) != 'DELETE')
            return redirect()->to('/admin/pegawai/' . $this->session->get('nik'));

        $cuti = $this->cutiM->find($id);
        $pegawai = $this->pegawaiM->getPegawaiNIK($this->session->get('nik'));

        if ($cuti['id_pegawai'] != $pegawai['id_pegawai'])
            return redirect()->to('/admin/pegawai/' . $pegawai['nik']);

        unlink('dokumen/cuti/' . $pegawai['id_pegawai'] . '/' . $cuti['dokumen']);

        $this->cutiM->delete($id);

        $this->session->setFlashdata('pesan', 'Cuti Berhasil Dihapus');

        return redirect()->to('/admin/pegawai/' . $pegawai['nik']);
    }
}
