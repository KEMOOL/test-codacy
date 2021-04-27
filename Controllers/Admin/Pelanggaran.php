<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use \Config\Services;

class Pelanggaran extends BaseController
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
            'catatan' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ], 'dokumen_pelanggaran' => [
                'rules' => 'max_size[dokumen_pelanggaran,2048]|mime_in[dokumen_pelanggaran,application/pdf,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran file tidak boleh lebih dari 2 MB',
                    'mime_in' => 'file file salah'
                ]
            ]
        ])) {
            $errors = Services::validation()->getErrors();

            $output = [
                'data' => $_POST,
                'error' => $errors,
                csrf_token() => csrf_hash()
            ];

            return $this->response->setJSON($output);
        }

        $pegawai = $this->pegawaiM->getPegawaiNIK($this->session->get('nik'));

        $dokumen = $this->request->getFile('dokumen_pelanggaran');
        $filename = $dokumen->getRandomName();

        $dokumen->move('dokumen/pelanggaran/' . $pegawai['id_pegawai'], $filename);

        $this->pelanggaranM->save([
            'id_pegawai' => $pegawai['id_pegawai'],
            'catatan' => $this->request->getVar('catatan'),
            'dokumen' => $filename,
        ]);

        $output = [
            'redirect' => '/admin/pegawai/' . $pegawai['nik'],
            'error' => [],
            csrf_token() => csrf_hash()
        ];

        $this->session->setFlashdata('pesan', 'Pelanggaran Berhasil Ditambahkan');

        return $this->response->setJSON($output);
    }

    public function get()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/pegawai');

        $output = [
            'pelanggaran' => $this->pelanggaranM->find($this->request->getVar('id')),
            csrf_token() => csrf_hash()
        ];

        $this->session->set('id_pelanggaran', $this->request->getVar('id'));

        return $this->response->setJSON($output);
    }

    public function edit()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/pegawai');

        if (!$this->validate([
            'catatan' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ], 'dokumen_pelanggaran' => [
                'rules' => 'max_size[dokumen_pelanggaran,2048]|mime_in[dokumen_pelanggaran,application/pdf,image/jpeg,image/png]',
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
        $pelanggaran = $this->pelanggaranM->find($this->session->get('id_pelanggaran'));

        $data = [
            'id_pelanggaran' => $pelanggaran['id_pelanggaran'],
            'id_pegawai' => $pegawai['id_pegawai'],
            'catatan' => $this->request->getVar('catatan')
        ];

        $dokumen = $this->request->getFile('dokumen_pelanggaran');
        if ($dokumen->getName() != '') {
            unlink('dokumen/pelanggaran/' . $pegawai['id_pegawai'] . '/' . $pelanggaran['dokumen']);

            $filename = $dokumen->getRandomName();
            $dokumen->move('dokumen/pelanggaran/' . $pegawai['id_pegawai'], $filename);

            $data['dokumen'] = $filename;
        }

        $this->pelanggaranM->save($data);

        $output = [
            'redirect' => '/admin/pegawai/' . $pegawai['nik'],
            'error' => [],
            csrf_token() => csrf_hash()
        ];

        $this->session->setFlashdata('pesan', 'Pelanggaran Berhasil Ditambahkan');

        return $this->response->setJSON($output);
    }

    public function delete($id)
    {
        if ($this->request->getMethod(true) != 'DELETE')
            return redirect()->to('/admin/pegawai/' . $this->session->get('nik'));

        $pelanggaran = $this->pelanggaranM->find($id);
        $pegawai = $this->pegawaiM->getPegawaiNIK($this->session->get('nik'));

        if ($pelanggaran['id_pegawai'] != $pegawai['id_pegawai'])
            return redirect()->to('/admin/pegawai/' . $pegawai['nik']);

        unlink('dokumen/pelanggaran/' . $pegawai['id_pegawai'] . '/' . $pelanggaran['dokumen']);

        $this->pelanggaranM->delete($id);

        $this->session->setFlashdata('pesan', 'Pelanggaran Berhasil Dihapus');

        return redirect()->to('/admin/pegawai/' . $pegawai['nik']);
    }
}
