<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use \Config\Services;

class Penilaian extends BaseController
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
            'indikator' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ], 'nilai' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ], 'dokumen_penilaian' => [
                'rules' => 'max_size[dokumen_penilaian,2048]|mime_in[dokumen_penilaian,application/pdf,image/jpeg,image/png]',
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

        $dokumen = $this->request->getFile('dokumen_penilaian');
        $filename = $dokumen->getRandomName();

        $dokumen->move('dokumen/penilaian/' . $pegawai['id_pegawai'], $filename);

        foreach ($this->request->getVar('indikator') as $key => $value) :
            $this->penilaianM->save([
                'id_pegawai' => $pegawai['id_pegawai'],
                'indikator' => $value,
                'nilai' => $this->request->getVar('nilai')[$key],
                'dokumen' => $filename
            ]);
        endforeach;

        $output = [
            'redirect' => '/admin/pegawai/' . $pegawai['nik'],
            'error' => [],
            csrf_token() => csrf_hash()
        ];

        $this->session->setFlashdata('pesan', 'Penilaian Berhasil Ditambahkan');

        return $this->response->setJSON($output);
    }

    public function get()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/pegawai');

        $output = [
            'penilaian' => $this->penilaianM->find($this->request->getVar('id')),
            csrf_token() => csrf_hash()
        ];

        $this->session->set('id_penilaian', $this->request->getVar('id'));

        return $this->response->setJSON($output);
    }

    public function edit()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/pegawai');

        if (!$this->validate([
            'indikator' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ], 'nilai' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ], 'dokumen_penilaian' => [
                'rules' => 'max_size[dokumen_penilaian,2048]|mime_in[dokumen_penilaian,application/pdf,image/jpeg,image/png]',
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
        $penilaian = $this->penilaianM->find($this->session->get('id_penilaian'));

        $data = [
            'id_penilaian' => $penilaian['id_penilaian'],
            'id_pegawai' => $pegawai['id_pegawai'],
            'indikator' => $this->request->getVar('indikator'),
            'nilai' => $this->request->getVar('nilai'),
        ];

        $dokumen = $this->request->getFile('dokumen_penilaian');

        if ($dokumen->getName() != '') {
            unlink('dokumen/penilaian/' . $pegawai['id_pegawai'] . '/' . $penilaian['dokumen']);

            $filename = $dokumen->getRandomName();
            $dokumen->move('dokumen/penilaian/' . $pegawai['id_pegawai'], $filename);

            $data['dokumen'] = $filename;
        }

        $this->penilaianM->save($data);

        $output = [
            'redirect' => '/admin/pegawai/' . $pegawai['nik'],
            'error' => [],
            'data' => $data,
            csrf_token() => csrf_hash()
        ];

        $this->session->setFlashdata('pesan', 'Penilaian Berhasil Ditambahkan');

        return $this->response->setJSON($output);
    }

    public function delete($id)
    {
        if ($this->request->getMethod(true) != 'DELETE')
            return redirect()->to('/admin/pegawai/' . $this->session->get('nik'));

        $pegawai = $this->pegawaiM->getPegawaiNIK($this->session->get('nik'));
        $hapusPenilaian = $this->penilaianM->find($id);
        $penilaian = $this->penilaianM->getPenilaian($pegawai['id_pegawai']);
        $flag = true;

        if ($hapusPenilaian['id_pegawai'] != $pegawai['id_pegawai'])
            return redirect()->to('/admin/pegawai/' . $pegawai['nik']);

        foreach ($penilaian as $penilaian) :
            if ($penilaian['id_penilaian'] != $hapusPenilaian['id_penilaian'] && $penilaian['dokumen'] == $hapusPenilaian['dokumen'])
                $flag = false;
        endforeach;

        if ($flag)
            unlink('dokumen/penilaian/' . $pegawai['id_pegawai'] . '/' . $hapusPenilaian['dokumen']);

        $this->penilaianM->delete($id);

        $this->session->setFlashdata('pesan', 'Penilaian Berhasil Dihapus');

        return redirect()->to('/admin/pegawai/' . $pegawai['nik']);
    }
}
