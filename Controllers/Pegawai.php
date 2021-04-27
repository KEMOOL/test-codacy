<?php

namespace App\Controllers;

class Pegawai extends BaseController
{
    public function index()
    {
        $data = [
            'pegawai' => $this->pegawaiM->getPegawaiEmail($this->session->get('email'))
        ];

        return view('dashboard-pegawai', $data);
    }

    public function profil()
    {
        $pegawai = $this->pegawaiM->getPegawaiEmail($this->session->get('email'));
        $pasangan = $this->pasanganM->getPasangan($pegawai['id_pegawai']);
        $anak = $this->anakM->getanak($pegawai['id_pegawai']);
        $pendidikan = $this->pendidikanM->getpendidikan($pegawai['id_pegawai']);
        $pelatihan = $this->pelatihanM->getpelatihan($pegawai['id_pegawai']);
        $pelanggaran = $this->pelanggaranM->getPelanggaran($pegawai['id_pegawai']);
        $cuti = $this->cutiM->getCuti($pegawai['id_pegawai']);
        $penilaian = $this->penilaianM->getPenilaian($pegawai['id_pegawai']);
        $this->session->set('nik', $pegawai['nik']);

        $data = [
            'pegawai' => $pegawai,
            'pasangan' => $pasangan,
            'anak' => $anak,
            'pendidikan' => $pendidikan,
            'pelatihan' => $pelatihan,
            'pelanggaran' => $pelanggaran,
            'cuti' => $cuti,
            'penilaian' => $penilaian,
        ];

        return view("profil", $data);
    }

    public function dokumen()
    {
        return view("dokumen");
    }
}
