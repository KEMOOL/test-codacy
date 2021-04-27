<?php

namespace App\Controllers\Admin\Potongan;

use App\Controllers\BaseController;
use \Config\Services;
use DateTime;

class Lainlain extends BaseController
{
    public function index()
    {
        $tanggal = new DateTime();

        $data = [
            'pegawai' => $this->PLainlainM->getPotongan($tanggal->format('n/Y')),
            'bulan' => $this->bulan,
            'tahun' => $this->PLainlainM->getTahun(),
        ];

        return view('admin/potongan/lain-lain', $data);
    }

    public function tambah()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/potongan/lainlain');

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
            if (!$this->PLainlainM->getPotongan($tanggal->format('n/Y'), $pegawai['id_pegawai'])) {
                $this->PLainlainM->save([
                    'id_pegawai' => $pegawai['id_pegawai'],
                    'bulan_tahun' => $tanggal->format('n/Y'),
                    'nominal' => $this->request->getVar('nominal')
                ]);

                $this->session->setFlashdata('pesan', 'Potongan Berhasil Ditambahkan');
            } else
                $error['nik'] = 'Pegawai telah memiliki potongan pada bulan ini';
        } else
            $error['nik'] = 'NIK tidak terdaftar';

        $output = [
            'redirect' => '/admin/potongan/lain-lain',
            'error' => $error,
            csrf_token() => csrf_hash()
        ];

        return $this->response->setJSON($output);
    }

    public function get()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/potongan/lainlain');

        $potongan = $this->PLainlainM->getPotonganID($this->request->getVar('id'));

        if (!$potongan)
            $potongan = [];

        $output = [
            'lainlain' => $potongan,
            csrf_token() => csrf_hash()
        ];

        $this->session->set('id_lainlain', $this->request->getVar('id'));

        return $this->response->setJSON($output);
    }

    public function edit()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/potongan/lainlain');

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
        $potonganSession = $this->PLainlainM->find($this->session->get('id_lainlain'));
        $pegawai = $this->pegawaiM->find($potonganSession['id_pegawai']);
        $error = [];

        if ($nik != $pegawai['nik']) {
            $pegawai = $this->pegawaiM->getPegawaiNIK($nik);
            if ($pegawai) {
                if ($this->PLainlainM->getPotongan($tanggal->format('n/Y'), $pegawai['id_pegawai']))
                    $error['nik'] = 'Pegawai telah memiliki potongan pada bulan ini';
            } else
                $error['nik'] = 'NIK tidak terdaftar';
        }

        if (count($error) == 0) {
            $this->PLainlainM->save([
                'id' => $this->session->get('id_lainlain'),
                'id_pegawai' => $pegawai['id_pegawai'],
                'nominal' => $this->request->getVar('nominal')
            ]);

            $this->session->setFlashdata('pesan', 'Potongan Berhasil Diperbarui');
        }

        $output = [
            'redirect' => '/admin/potongan/lain-lain',
            'error' => $error,
            csrf_token() => csrf_hash()
        ];

        return $this->response->setJSON($output);
    }

    public function tampil()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/potongan/lainlain');

        $data = [
            'pegawai' => $this->PLainlainM->getPotongan($this->request->getVar('bulan') . '/' . $this->request->getVar('tahun')),
            csrf_token() => csrf_hash()
        ];

        return $this->response->setJSON($data);
    }

    public function delete($id)
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/potongan/lainlain');

        $this->PLainlainM->delete($id);

        $this->session->setFlashdata('pesan', 'Potongan Berhasil Dihapus');

        return redirect()->to('/admin/potongan/lain-lain');
    }
}
