<?php

namespace App\Controllers\Admin\Tunjangan;

use App\Controllers\BaseController;
use \Config\Services;
use DateTime;

class Auditor extends BaseController
{
    public function index()
    {
        $tanggal = new DateTime();

        $data = [
            'pegawai' => $this->TAuditorM->getTunjangan($tanggal->format('n/Y')),
            'bulan' => $this->bulan,
            'tahun' => $this->TAuditorM->getTahun(),
        ];

        return view('admin/tunjangan/auditor', $data);
    }

    public function tambah()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/tunjangan/auditor');

        if (!$this->validate([
            'nik' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                ]
            ], 'jabatan' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
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
            $jabatan = $this->request->getVar('jabatan');
            $auditor = $this->tunjanganM->getTunjanganSpesifik($jabatan);

            if ($auditor) {
                if (!$this->TAuditorM->getTunjangan($tanggal->format('n/Y'), $pegawai['id_pegawai'])) {
                    $this->TAuditorM->save([
                        'id_pegawai' => $pegawai['id_pegawai'],
                        'bulan_tahun' => $tanggal->format('n/Y'),
                        'jabatan' => $jabatan,
                        'nominal' => $auditor['nominal'],
                    ]);

                    $this->session->setFlashdata('pesan', 'Tunjangan Berhasil Ditambahkan');
                } else
                    $error['nik'] = 'Pegawai telah memiliki tunjangan pada bulan ini';
            } else
                $error['jabatan'] = 'Pilihan jawaban telah termodifikasi';
        } else
            $error['nik'] = 'NIK tidak terdaftar';

        $output = [
            'redirect' => '/admin/tunjangan/auditor',
            'error' => $error,
            csrf_token() => csrf_hash()
        ];

        return $this->response->setJSON($output);
    }

    public function get()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/tunjangan/auditor');

        $tanggal = new DateTime();
        $tunjangan = $this->TAuditorM->getTunjanganID($this->request->getVar('id'), $tanggal->format('m/Y'));

        if (!$tunjangan)
            $tunjangan = [];

        $output = [
            'auditor' => $tunjangan,
            csrf_token() => csrf_hash()
        ];

        $this->session->set('id_auditor', $this->request->getVar('id'));

        return $this->response->setJSON($output);
    }

    public function edit()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/tunjangan/auditor');

        if (!$this->validate([
            'nik' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                ]
            ], 'jabatan' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
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
        $tunjanganSession = $this->TAuditorM->find($this->session->get('id_auditor'));
        $pegawai = $this->pegawaiM->find($tunjanganSession['id_pegawai']);
        $jabatan = $this->request->getVar('jabatan');
        $auditor = $this->tunjanganM->getTunjanganSpesifik($jabatan);
        $error = [];

        if (!$auditor) $error['jabatan'] = 'Pilihan jawaban telah termodifikasi';

        if ($nik != $pegawai['nik']) {
            $pegawai = $this->pegawaiM->getPegawaiNIK($nik);
            if ($pegawai) {
                if ($this->TAuditorM->getTunjangan($tanggal->format('n/Y'), $pegawai['id_pegawai']))
                    $error['nik'] = 'Pegawai telah memiliki tunjangan pada bulan ini';
            } else
                $error['nik'] = 'NIK tidak terdaftar';
        }

        if (count($error) == 0) {
            $this->TAuditorM->save([
                'id' => $this->session->get('id_auditor'),
                'id_pegawai' => $pegawai['id_pegawai'],
                'jabatan' => $jabatan,
                'nominal' => $auditor['nominal'],
            ]);

            $this->session->setFlashdata('pesan', 'Tunjangan Berhasil Diperbarui');
        }

        $output = [
            'redirect' => '/admin/tunjangan/auditor',
            'error' => $error,
            csrf_token() => csrf_hash()
        ];

        return $this->response->setJSON($output);
    }

    public function tampil()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/tunjangan/auditor');

        $data = [
            'pegawai' => $this->TAuditorM->getTunjangan($this->request->getVar('bulan') . '/' . $this->request->getVar('tahun')),
            csrf_token() => csrf_hash()
        ];

        return $this->response->setJSON($data);
    }

    public function delete($id)
    {
        if ($this->request->getMethod(true) != 'DELETE')
            return redirect()->to('/admin/tunjangan/auditor');

        $this->TAuditorM->delete($id);

        $this->session->setFlashdata('pesan', 'Tunjangan Berhasil Dihapus');

        return redirect()->to('/admin/tunjangan/auditor');
    }
}
