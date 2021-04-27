<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use \Config\Services;

class Pendidikan extends BaseController
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
            'nama_sekolah' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'tahun_lulus'                   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'tingkat_pendidikan'                   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'alamat_sekolah'                   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ], 'dokumen_ijasah' => [
                'rules' => 'max_size[dokumen_ijasah,2048]|mime_in[dokumen_ijasah,application/pdf,image/jpeg,image/png]',
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

        $ijasah = $this->request->getFile('dokumen_ijasah');
        $filename = $ijasah->getRandomName();

        $ijasah->move('dokumen/pendidikan/' . $pegawai['id_pegawai'], $filename);

        if (
            $this->request->getvar('tingkat_pendidikan') != "SD atau Setingkat" &&
            $this->request->getvar('tingkat_pendidikan') != "SMP atau Setingkat"
        )
            $jurusan = $this->request->getvar('jurusan');
        else
            $jurusan = '-';

        $this->pendidikanM->save([
            'id_pegawai' => $pegawai['id_pegawai'],
            'nama' => $this->request->getVar('nama_sekolah'),
            'tahun_lulus' => $this->request->getVar('tahun_lulus'),
            'tingkat' => $this->request->getvar('tingkat_pendidikan'),
            'jurusan' => $jurusan,
            'alamat' => $this->request->getVar('alamat_sekolah'),
            'ijazah' => $ijasah->getName()
        ]);

        if (array_search($pegawai['pendidikan_terakhir'], $this->tingkatPendidikan) < array_search($this->request->getvar('tingkat_pendidikan'), $this->tingkatPendidikan))
            $this->pegawaiM->save([
                'id_pegawai' => $pegawai['id_pegawai'],
                'pendidikan_terakhir' => $this->request->getvar('tingkat_pendidikan')
            ]);

        $output = [
            'redirect' => '/admin/pegawai/' . $pegawai['nik'],
            'error' => [],
            csrf_token() => csrf_hash()
        ];

        $this->session->setFlashdata('pesan', 'Pendidikan Berhasil Ditambahkan');

        return $this->response->setJSON($output);
    }

    public function get()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/pegawai');

        $output = [
            'pendidikan' => $this->pendidikanM->find($this->request->getVar('id')),
            csrf_token() => csrf_hash()
        ];

        $this->session->set('id_pendidikan', $this->request->getVar('id'));

        return $this->response->setJSON($output);
    }
    public function edit()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/pegawai');

        if (!$this->validate([
            'nama_sekolah' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'tahun_lulus'                   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  '{field} sudah ada'
                ]
            ],
            'tingkat_pendidikan'                   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'alamat_sekolah'                   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ], 'dokumen_ijasah' => [
                'rules' => 'max_size[dokumen_ijasah,2048]|mime_in[dokumen_ijasah,application/pdf,image/jpeg,image/png]',
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
        $pendidikan = $this->pendidikanM->find($this->session->get('id_pendidikan'));

        if (
            $this->request->getvar('tingkat_pendidikan') != "SD atau Setingkat" &&
            $this->request->getvar('tingkat_pendidikan') != "SMP atau Setingkat"
        )
            $jurusan = $this->request->getvar('jurusan');
        else
            $jurusan = '-';

        $data = [
            'id_pendidikan' => $pendidikan['id_pendidikan'],
            'id_pegawai' => $pegawai['id_pegawai'],
            'nama' => $this->request->getVar('nama_sekolah'),
            'tahun_lulus' => $this->request->getVar('tahun_lulus'),
            'tingkat' => $this->request->getVar('tingkat_pendidikan'),
            'jurusan' => $jurusan,
            'alamat' => $this->request->getVar('alamat_sekolah')
        ];

        if ($this->request->getFile('dokumen_ijasah')->getName()) {
            $ijasah = $this->request->getFile('dokumen_ijasah');
            $filename = $ijasah->getRandomName();

            $ijasah->move('dokumen/pendidikan/' . $pegawai['id_pegawai'], $filename);

            $data['ijazah'] = $ijasah->getName();
        }

        $this->pendidikanM->save($data);

        $output = [
            'redirect' => '/admin/pegawai/' . $pegawai['nik'],
            'error' => [],
            csrf_token() => csrf_hash()
        ];

        $this->session->setFlashdata('pesan', 'Pendidikan Berhasil Diperbarui');

        return $this->response->setJSON($output);
    }

    public function delete($id)
    {
        if ($this->request->getMethod(true) != 'DELETE')
            return redirect()->to('/admin/pegawai/' . $this->session->get('nik'));

        $pendidikan = $this->pendidikanM->find($id);
        $pegawai = $this->pegawaiM->getPegawaiNIK($this->session->get('nik'));

        if ($pendidikan['id_pegawai'] != $pegawai['id_pegawai'])
            return redirect()->to('/admin/pegawai/' . $pegawai['nik']);

        unlink('dokumen/pendidikan/' . $pegawai['id_pegawai'] . '/' . $pendidikan['ijazah']);

        $this->pendidikanM->delete($id);

        $this->session->setFlashdata('pesan', 'Pendidikan Berhasil Dihapus');

        return redirect()->to('/admin/pegawai/' . $pegawai['nik']);
    }
}
