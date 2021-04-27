<?php

namespace App\Controllers\Admin\Tunjangan;

use App\Controllers\BaseController;
use \Config\Services;
use DateTime;

class Lembur extends BaseController
{
    public function index()
    {
        $tanggal = new DateTime();

        $data = [
            'pegawai' => $this->TLemburM->getTunjangan($tanggal->format('n/Y')),
            'bulan' => $this->bulan,
            'tahun' => $this->TLemburM->getTahun(),
        ];

        return view('admin/tunjangan/lembur', $data);
    }

    public function tambah()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/tunjangan/lembur');

        if (!$this->validate([
            'nik' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
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

        $tanggal = new DateTime();
        $nik = $this->request->getVar('nik');
        $pegawai = $this->pegawaiM->getPegawaiNIK($nik);
        $error = [];

        if ($pegawai) {
            if (!$this->TLemburM->getTunjangan($tanggal->format('n/Y'), $pegawai['id_pegawai'])) {
                $this->TLemburM->save([
                    'id_pegawai' => $pegawai['id_pegawai'],
                    'bulan_tahun' => $tanggal->format('n/Y'),
                    'nominal' => $this->request->getVar('nominal')
                ]);

                $this->session->setFlashdata('pesan', 'Tunjangan Berhasil Ditambahkan');
            } else
                $error['nik'] = 'Pegawai telah memiliki tunjangan pada bulan ini';
        } else
            $error['nik'] = 'NIK tidak terdaftar';

        $output = [
            'redirect' => '/admin/tunjangan/lembur',
            'error' => $error,
            csrf_token() => csrf_hash()
        ];

        return $this->response->setJSON($output);
    }

    public function get()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/tunjangan/lembur');

        $tunjangan = $this->TLemburM->getTunjanganID($this->request->getVar('id'));

        if (!$tunjangan)
            $tunjangan = [];

        $output = [
            'lembur' => $tunjangan,
            csrf_token() => csrf_hash()
        ];

        $this->session->set('id_lembur', $this->request->getVar('id'));

        return $this->response->setJSON($output);
    }

    public function edit()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/tunjangan/lembur');

        if (!$this->validate([
            'nik' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
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

        $tanggal = new DateTime();
        $nik = $this->request->getVar('nik');
        $tunjanganSession = $this->TLemburM->find($this->session->get('id_lembur'));
        $pegawai = $this->pegawaiM->find($tunjanganSession['id_pegawai']);
        $error = [];

        if ($nik != $pegawai['nik']) {
            $pegawai = $this->pegawaiM->getPegawaiNIK($nik);
            if ($pegawai) {
                if ($this->TLemburM->getTunjangan($tanggal->format('n/Y'), $pegawai['id_pegawai'])) {
                    $error['nik'] = 'Pegawai telah memiliki tunjangan pada bulan ini';
                }
            } else
                $error['nik'] = 'NIK tidak terdaftar';
        }

        if (count($error) == 0) {
            $this->TLemburM->save([
                'id' => $this->session->get('id_lembur'),
                'id_pegawai' => $pegawai['id_pegawai'],
                'nominal' => $this->request->getVar('nominal')
            ]);

            $this->session->setFlashdata('pesan', 'Tunjangan Berhasil Diperbarui');
        }

        $output = [
            'redirect' => '/admin/tunjangan/lembur',
            'error' => $error,
            csrf_token() => csrf_hash()
        ];

        return $this->response->setJSON($output);
    }

    public function tampil()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/tunjangan/lembur');

        $data = [
            'pegawai' => $this->TLemburM->getTunjangan($this->request->getVar('bulan') . '/' . $this->request->getVar('tahun')),
            csrf_token() => csrf_hash()
        ];

        return $this->response->setJSON($data);
    }

    public function delete($id)
    {
        if ($this->request->getMethod(true) != 'DELETE')
            return redirect()->to('/admin/tunjangan/lembur');

        $this->TLemburM->delete($id);

        $this->session->setFlashdata('pesan', 'Tunjangan Berhasil Dihapus');

        return redirect()->to('/admin/tunjangan/lembur');
    }
}
