<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use \Config\Services;

class Pasangan extends BaseController
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
            'nama_pasangan' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'nik_pasangan'                   => [
                'rules'     => 'required|is_unique[pasangan.nik]',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  'NIK sudah terdaftar'
                ]
            ],
            'ttl_pasangan'                 => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'no_telp'                   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'pekerjaan_pasangan'                   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'hubungan_pasangan'                   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'pendidikan_pasangan'                   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ], 'file_nik' => [
                'rules' => 'max_size[file_nik,2048]|mime_in[file_nik,application/pdf,image/jpeg,image/png]',
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
        $fileNIK = $this->request->getFile('file_nik');
        $filename = $fileNIK->getRandomName();

        $fileNIK->move('dokumen/identitas/' . $pegawai['id_pegawai'], $filename);

        $this->pasanganM->save([
            'id_pegawai' => $pegawai['id_pegawai'],
            'nama' => $this->request->getVar('nama_pasangan'),
            'hubungan' => $this->request->getVar('hubungan_pasangan'),
            'nik' => $this->request->getVar('nik_pasangan'),
            'pekerjaan' => $this->request->getVar('pekerjaan_pasangan'),
            'pendidikan' => $this->request->getVar('pendidikan_pasangan'),
            'ttl' => $this->request->getVar('ttl_pasangan'),
            'no_telp' => $this->request->getVar('no_telp'),
            'file_nik' => $filename
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
            'pasangan' => $this->pasanganM->find($this->request->getVar('id')),
            csrf_token() => csrf_hash()
        ];

        $this->session->set('id_pasangan', $this->request->getVar('id'));

        return $this->response->setJSON($output);
    }
    public function edit()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/pegawai');

        $pasangan = $this->pasanganM->find($this->session->get('id_pasangan'));

        if ($this->request->getVar('nik') != $pasangan['nik'])
            $valNIK = '|is_unique[pasangan.nik]';
        else
            $valNIK = '';
        if ($this->request->getVar('no_telp') != $pasangan['no_telp'])
            $valNoTelp = '|is_unique[pasangan.no_telp]';
        else
            $valNoTelp = '';

        if (!$this->validate([
            'nama_pasangan' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'nik_pasangan'                   => [
                'rules'     => "required|$valNIK",
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  'NIK sudah terdaftar'
                ]
            ],
            'ttl_pasangan'                 => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'no_telp'                   => [
                'rules'     => "required|$valNoTelp",
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  'No telephone sudah terdaftar'
                ]
            ],
            'pekerjaan_pasangan'                   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'hubungan_pasangan'                   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'pendidikan_pasangan'                   => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ], 'file_nik' => [
                'rules' => 'max_size[file_nik,2048]|mime_in[file_nik,application/pdf,image/jpeg,image/png]',
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

        $data = [
            'id_pasangan' => $pasangan['id_pasangan'],
            'id_pegawai' => $pegawai['id_pegawai'],
            'nama' => $this->request->getVar('nama_pasangan'),
            'hubungan' => $this->request->getVar('hubungan_pasangan'),
            'nik' => $this->request->getVar('nik_pasangan'),
            'pekerjaan' => $this->request->getVar('pekerjaan_pasangan'),
            'pendidikan' => $this->request->getVar('pendidikan_pasangan'),
            'ttl' => $this->request->getVar('ttl_pasangan'),
            'no_telp' => $this->request->getVar('no_telp'),
        ];

        $fileNIK = $this->request->getFile('file_nik');

        if ($fileNIK->getName()) {
            unlink('dokumen/identitas/' . $pegawai['id_pegawai'] . '/' . $pasangan['file_nik']);

            $filename = $fileNIK->getRandomName();
            $fileNIK->move('dokumen/identitas/' . $pegawai['id_pegawai'], $filename);

            $data['file_nik'] = $filename;
        }

        $this->pasanganM->save($data);

        $output = [
            'redirect' => '/admin/pegawai/' . $pegawai['nik'],
            'error' => [],
            csrf_token() => csrf_hash()
        ];

        $this->session->setFlashdata('pesan', 'Keluarga Berhasil Diperbarui');

        return $this->response->setJSON($output);
    }

    public function delete($nik)
    {
        if ($this->request->getMethod(true) != 'DELETE')
            return redirect()->to('/admin/pegawai/' . $this->session->get('nik'));

        $pasangan = $this->pasanganM->getPasanganNIK($nik);
        $pegawai = $this->pegawaiM->getPegawaiNIK($this->session->get('nik'));

        if ($pasangan['id_pegawai'] != $pegawai['id_pegawai'])
            return redirect()->to('/admin/pegawai/' . $pegawai['nik']);

        unlink('dokumen/identitas/' . $pegawai['id_pegawai'] . '/' . $pasangan['file_nik']);

        $this->pasanganM->delete($pasangan['id_pasangan']);

        $this->session->setFlashdata('pesan', 'Keluarga Berhasil Dihapus');

        return redirect()->to('/admin/pegawai/' . $pegawai['nik']);
    }
}
