<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use \Config\Services;
use DateTime;
use DateTimeZone;

class Pegawai extends BaseController
{
    public function index()
    {
        $data = [
            'pegawai' => $this->pegawaiM->find()
        ];

        return view('admin/daftar-pegawai', $data);
    }

    public function tambah()
    {
        $data = [
            'validation' => Services::validation()
        ];

        return view("admin/tambah-pegawai", $data);
    }

    public function insert()
    {
        if ($this->request->getMethod() != 'post')
            return redirect()->to('/admin/pegawai');

        $validator = [
            'nama'                  => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'nip'                   => [
                'rules'     => 'required|is_unique[pegawai.nip]|is_natural',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  'NIP sudah terdaftar'
                ]
            ],
            'nik'                   => [
                'rules'     => 'required|is_unique[pegawai.nik]|is_natural',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  'NIK sudah terdaftar'
                ]
            ],
            'jabatan'                 => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'detail_jabatan'                 => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'no_npwp'                   => [
                'rules'     => 'required|is_unique[pegawai.no_npwp]|is_natural',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  'No NPWP sudah terdaftar'
                ]
            ],
            'no_bpjs_tk'                   => [
                'rules'     => 'required|is_unique[pegawai.no_bpjs_tk]|is_natural',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  'No BPJS ketenagakerjaan sudah terdaftar'
                ]
            ],
            'no_bpjs_kes'                   => [
                'rules'     => 'required|is_unique[pegawai.no_bpjs_kes]|is_natural',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  'No BPJS kesehatan sudah terdaftar'
                ]
            ],
            'no_dplk'                   => [
                'rules'     => 'required|is_unique[pegawai.no_dplk]|is_natural',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  'No DPLK sudah terdaftar'
                ]
            ],
            'tempat_lahir'          => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'tanggal_lahir'          => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'email'              => [
                'rules'     => 'required|is_unique[pegawai.email]|valid_email',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  'Email sudah terdaftar',
                    'valid_email' => 'Email tidak valid'
                ]
            ],
            'jenis_kelamin'         => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'agama'                 => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'nomor_telepon'             => [
                'rules'     => 'required|is_unique[pegawai.no_telp]|is_natural',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  'No telepon sudah terdaftar'
                ]
            ],
            'alamat_rumah'                => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'status_pernikahan'                => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'pendidikan_terakhir' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'status_pegawai'                 => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'tahun_pengangkatan'                 => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'no_rekening'                 => [
                'rules'     => 'required|is_unique[pegawai.no_rekening]',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  'No rekening sudah terdaftar'
                ]
            ],
            'bank'                 => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran foto tidak boleh lebih dari 2 MB',
                    'is_image' => 'Mohon unggal file JPG, JPEG, PNG',
                    'mime_in' => 'Mohon unggal file JPG, JPEG, PNG',
                    'uploaded' => 'Mohon unggal file JPG, JPEG, PNG'
                ]
            ], 'file_nip' => [
                'rules' => 'max_size[file_nip,2048]|mime_in[file_nip,application/pdf,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran file tidak boleh lebih dari 2 MB',
                    'mime_in' => 'Mohon unggal file JPG, JPEG, PNG, PDF'
                ]
            ], 'file_jabatan' => [
                'rules' => 'max_size[file_jabatan,2048]|mime_in[file_jabatan,application/pdf,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran file tidak boleh lebih dari 2 MB',
                    'mime_in' => 'Mohon unggal file JPG, JPEG, PNG, PDF'
                ]
            ], 'file_nik' => [
                'rules' => 'max_size[file_nik,2048]|mime_in[file_nik,application/pdf,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran file tidak boleh lebih dari 2 MB',
                    'mime_in' => 'Mohon unggal file JPG, JPEG, PNG, PDF'
                ]
            ], 'file_no_npwp' => [
                'rules' => 'max_size[file_no_npwp,2048]|mime_in[file_no_npwp,application/pdf,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran file tidak boleh lebih dari 2 MB',
                    'mime_in' => 'Mohon unggal file JPG, JPEG, PNG, PDF'
                ]
            ], 'file_no_bpjs_tk' => [
                'rules' => 'max_size[file_no_bpjs_tk,2048]|mime_in[file_no_bpjs_tk,application/pdf,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran file tidak boleh lebih dari 2 MB',
                    'mime_in' => 'Mohon unggal file JPG, JPEG, PNG, PDF'
                ]
            ], 'file_no_bpjs_kes' => [
                'rules' => 'max_size[file_no_bpjs_kes,2048]|mime_in[file_no_bpjs_kes,application/pdf,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran file tidak boleh lebih dari 2 MB',
                    'mime_in' => 'Mohon unggal file JPG, JPEG, PNG, PDF'
                ]
            ], 'file_no_dplk' => [
                'rules' => 'max_size[file_no_dplk,2048]|mime_in[file_no_dplk,application/pdf,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran file tidak boleh lebih dari 2 MB',
                    'mime_in' => 'Mohon unggal file JPG, JPEG, PNG, PDF'
                ]
            ], 'file_status_pernikahan' => [
                'rules' => 'max_size[file_status_pernikahan,2048]|mime_in[file_status_pernikahan,application/pdf,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran file tidak boleh lebih dari 2 MB',
                    'mime_in' => 'Mohon unggal file JPG, JPEG, PNG, PDF'
                ]
            ], 'file_status_pegawai' => [
                'rules' => 'max_size[file_status_pegawai,2048]|mime_in[file_status_pegawai,application/pdf,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran file tidak boleh lebih dari 2 MB',
                    'mime_in' => 'Mohon unggal file JPG, JPEG, PNG, PDF'
                ]
            ]
        ];

        if ($this->request->getVar('status_pegawai') == 'Pegawai Kontrak' || $this->request->getVar('status_pegawai') == 'Pegawai Alih Daya') {
            $validator['file_gaji_berkala'] = [
                'rules' => 'mime_in[file_gaji_berkala,application/pdf,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran file tidak boleh lebih dari 2 MB',
                    'mime_in' => 'Mohon unggal file JPG, JPEG, PNG, PDF'
                ]
            ];
        } else {
            $validator['gol_ruang_masa_kerja']  = [
                'rules'     => 'required|regex_match[/^([ABCD])\/(IV?I{0,2})\/([1-3]?[0-9])$/]',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'regex_match'  =>  'Mohon isi sesuai format yang diberikan'
                ]
            ];
            $validator['iterasi']  = [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ];
        }

        if (!$this->validate($validator)) {
            $errors = Services::validation()->getErrors();

            $output = [
                'error' => $errors,
                csrf_token() => csrf_hash()
            ];

            return $this->response->setJSON($output);
        }

        $data = [
            'nama' => $this->request->getVar('nama'),
            'nip' => $this->request->getVar('nip'),
            'jabatan' => $this->request->getVar('jabatan'),
            'detail_jabatan' => $this->request->getVar('detail_jabatan'),
            'nik' => $this->request->getVar('nik'),
            'no_npwp' => $this->request->getVar('no_npwp'),
            'no_bpjs_tk' => $this->request->getVar('no_bpjs_tk'),
            'no_bpjs_kes' => $this->request->getVar('no_bpjs_kes'),
            'no_dplk' => $this->request->getVar('no_dplk'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'email' => $this->request->getVar('email'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'agama' => $this->request->getVar('agama'),
            'gol_darah' => $this->request->getVar('gol_darah'),
            'no_telp' => $this->request->getVar('nomor_telepon'),
            'alamat_rumah' => $this->request->getVar('alamat_rumah'),
            'alamat_domisili' => $this->request->getVar('alamat_domisili'),
            'status_pegawai' => $this->request->getVar('status_pegawai'),
            'status_pernikahan' => $this->request->getVar('status_pernikahan'),
            'jumlah_anak' => ($this->request->getVar('status_pernikahan') == 'Menikah' ? $this->request->getVar('jumlah_anak') : 0),
            'pendidikan_terakhir' => $this->request->getVar('pendidikan_terakhir'),
            'pendidikan_daftar' => $this->request->getVar('pendidikan_terakhir'),
            'tahun_pengangkatan' => $this->request->getVar('tahun_pengangkatan'),
            'no_rekening' => $this->request->getVar('no_rekening'),
            'bank' => $this->request->getVar('bank')
        ];

        if ($this->request->getVar('status_pegawai') == 'Pegawai Kontrak' || $this->request->getVar('status_pegawai') == 'Pegawai Alih Daya') {
            $data['gol_ruang_masa_kerja'] = '-';
            $data['gaji_berkala'] = $this->request->getVar('gaji_berkala');
            $data['iterasi'] = 0;
        } else {
            $data['gol_ruang_masa_kerja'] = $this->request->getVar('gol_ruang_masa_kerja');
            $data['iterasi'] = $this->request->getVar('iterasi');
        }

        $this->pegawaiM->save($data);

        $pegawai = $this->pegawaiM->getPegawaiNIK($this->request->getVar('nik'));

        $this->payroll(array($pegawai));

        $data['id_pegawai'] = $pegawai['id_pegawai'];

        foreach ($this->tabelDokumen as $key => $value) :
            mkdir("dokumen/identitas/$key/{$pegawai['id_pegawai']}");
        endforeach;
        mkdir('dokumen/cuti/' . $pegawai['id_pegawai']);
        mkdir('dokumen/pelanggaran/' . $pegawai['id_pegawai']);
        mkdir('dokumen/pelatihan/' . $pegawai['id_pegawai']);
        mkdir('dokumen/pendidikan/' . $pegawai['id_pegawai']);
        mkdir('dokumen/penilaian/' . $pegawai['id_pegawai']);

        foreach ($this->request->getFiles() as $key => $file) :
            if ($file->isValid() && !$file->hasMoved()) {
                $filename = $file->getRandomName();
                $file->move("dokumen/identitas/$key/{$pegawai['id_pegawai']}/", $filename);

                $data[$key] = $filename;

                $this->dokumenM->save([
                    'id_pegawai' => $pegawai['id_pegawai'],
                    'kategori' => $this->tabelDokumen[$key],
                    'nama' => $filename,
                    'status' => 'Berlaku'
                ]);
            }
        endforeach;

        $this->pegawaiM->save($data);
        $this->userM->save([
            'username' => $this->request->getVar('email'),
            'password' => password_hash(md5($this->request->getVar('nik')), PASSWORD_DEFAULT)
        ]);

        $output = [
            'error' => [],
            'redirect' => '/admin/pegawai',
            csrf_token() => csrf_hash()
        ];

        $this->session->setFlashdata('pesan', 'Pegawai Berhasil Ditambahkan');

        return $this->response->setJSON($output);
    }

    public function profil($nik)
    {
        $pegawai = $this->pegawaiM->getPegawaiNIK($nik);
        $cuti = $this->cutiM->getCuti($pegawai['id_pegawai']);
        $sisaCuti = $this->maxCuti;

        foreach ($cuti as $key => $value) :
            if ($value['jenis_cuti'] == 'Non-tahunan')
                $cuti[$key]['sisa'] = $sisaCuti;
            else {
                $sisaCuti = $sisaCuti - $value['lama'];
                $cuti[$key]['sisa'] = $sisaCuti;
            }
        endforeach;

        $this->session->set('nik', $nik);

        $data = [
            'pegawai' => $pegawai,
            'pasangan' => $this->pasanganM->getPasangan($pegawai['id_pegawai']),
            'anak' => $this->anakM->getanak($pegawai['id_pegawai']),
            'pendidikan' => $this->pendidikanM->getpendidikan($pegawai['id_pegawai']),
            'pelatihan' => $this->pelatihanM->getpelatihan($pegawai['id_pegawai']),
            'pelanggaran' => $this->pelanggaranM->getPelanggaran($pegawai['id_pegawai']),
            'cuti' => $cuti,
            'sisaCuti' => $sisaCuti,
            'penilaian' => $this->penilaianM->getPenilaian($pegawai['id_pegawai']),
        ];

        return view("admin/profil-pegawai", $data);
    }

    public function editIdentitas($nik)
    {
        $pegawai = $this->pegawaiM->getPegawaiNIK($nik);

        $data = [
            'pegawai' => $pegawai,
            'validation' => Services::validation()
        ];

        $this->session->set('pegawai', $pegawai['id_pegawai']);

        return view('admin/edit-pegawai', $data);
    }

    public function updateIdentitas()
    {
        if ($this->request->getMethod() != 'post')
            return redirect()->to('/admin/pegawai');

        $pegawai = $this->pegawaiM->find($this->session->get('pegawai'));

        if ($this->request->getVar('nip') != $pegawai['nip'])
            $valNIP = '|is_unique[pegawai.nip]';
        else
            $valNIP = '';
        if ($this->request->getVar('nik') != $pegawai['nik'])
            $valNIK = '|is_unique[pegawai.nik]';
        else
            $valNIK = '';
        if ($this->request->getVar('no_npwp') != $pegawai['no_npwp'])
            $valNoNPWP = '|is_unique[pegawai.no_npwp]';
        else
            $valNoNPWP = '';
        if ($this->request->getVar('no_bpjs_tk') != $pegawai['no_bpjs_tk'])
            $valNoBPJSTk = '|is_unique[pegawai.no_bpjs_tk]';
        else
            $valNoBPJSTk = '';
        if ($this->request->getVar('no_bpjs_kes') != $pegawai['no_bpjs_kes'])
            $valNoBPJSKes = '|is_unique[pegawai.no_bpjs_kes]';
        else
            $valNoBPJSKes = '';
        if ($this->request->getVar('no_dplk') != $pegawai['no_dplk'])
            $valNoDPLK = '|is_unique[pegawai.no_dplk]';
        else
            $valNoDPLK = '';
        if ($this->request->getVar('nomor_telepon') != $pegawai['no_telp'])
            $valNoTelp = '|is_unique[pegawai.no_telp]';
        else
            $valNoTelp = '';
        if ($this->request->getVar('email') != $pegawai['email'])
            $valEmail = '|is_unique[pegawai.email]';
        else
            $valEmail = '';
        if ($this->request->getVar('no_rekening') != $pegawai['no_rekening'])
            $valRekening = '|is_unique[pegawai.no_rekening]';
        else
            $valRekening = '';

        $validator = [
            'nama'                  => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'nip'                   => [
                'rules'     => "required|is_natural$valNIP",
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  'NIP sudah terdaftar'
                ]
            ],
            'nik'                   => [
                'rules'     => "required$valNIK",
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  'NIK sudah terdaftar'
                ]
            ],
            'jabatan'                 => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'no_npwp'                   => [
                'rules'     => "required$valNoNPWP",
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  'No NPWP sudah terdaftar'
                ]
            ],
            'no_bpjs_tk'                   => [
                'rules'     => "required$valNoBPJSTk",
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  'No peserta BPJS TK sudah terdaftar'
                ]
            ],
            'no_bpjs_kes'                   => [
                'rules'     => "required$valNoBPJSKes",
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  'No peserta BPJS kesehatan sudah terdaftar'
                ]
            ],
            'no_dplk'                   => [
                'rules'     => "required$valNoDPLK",
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  'No DPLK sudah terdaftar'
                ]
            ],
            'tempat_lahir'          => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'tempat lahir harus diisi'
                ]
            ],
            'tanggal_lahir'          => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'tanggal lahir harus diisi'
                ]
            ],
            'email'              => [
                'rules'     => "required|valid_email$valEmail",
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  'Email sudah terdaftar'
                ]
            ],
            'jenis_kelamin'         => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'jenis kelamin harus diisi'
                ]
            ],
            'agama'                 => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'nomor_telepon'         => [
                'rules'     => "required$valNoTelp",
                'errors'    => [
                    'required'  =>  'nomor telepon harus diisi',
                    'is_unique' =>  'No Telepon sudah terdaftar'
                ]
            ],
            'alamat_rumah'                => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                ]
            ],
            'status_pernikahan'                => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'pendidikan_terakhir' => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'status_pegawai'                 => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'tahun_pengangkatan'                 => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'no_rekening'                 => [
                'rules'     => "required$valRekening",
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'is_unique' =>  'No rekening sudah terdaftar'
                ]
            ],
            'bank'                 => [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi'
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran foto tidak boleh lebih dari 2 MB',
                    'is_image' => 'file foto salah',
                    'mime_in' => 'file foto salah'
                ]
            ], 'file_nip' => [
                'rules' => 'max_size[file_nip,2048]|mime_in[file_nip,application/pdf,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran file tidak boleh lebih dari 2 MB',
                    'mime_in' => 'file file salah'
                ]
            ], 'file_jabatan' => [
                'rules' => 'max_size[file_jabatan,2048]|mime_in[file_jabatan,application/pdf,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran file tidak boleh lebih dari 2 MB',
                    'mime_in' => 'file file salah'
                ]
            ], 'file_nik' => [
                'rules' => 'max_size[file_nik,2048]|mime_in[file_nik,application/pdf,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran file tidak boleh lebih dari 2 MB',
                    'mime_in' => 'file file salah'
                ]
            ], 'file_no_npwp' => [
                'rules' => 'max_size[file_no_npwp,2048]|mime_in[file_no_npwp,application/pdf,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran file tidak boleh lebih dari 2 MB',
                    'mime_in' => 'file file salah'
                ]
            ], 'file_no_bpjs_tk' => [
                'rules' => 'max_size[file_no_bpjs_tk,2048]|mime_in[file_no_bpjs_tk,application/pdf,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran file tidak boleh lebih dari 2 MB',
                    'mime_in' => 'file file salah'
                ]
            ], 'file_no_bpjs_kes' => [
                'rules' => 'max_size[file_no_bpjs_kes,2048]|mime_in[file_no_bpjs_kes,application/pdf,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran file tidak boleh lebih dari 2 MB',
                    'mime_in' => 'file file salah'
                ]
            ], 'file_no_dplk' => [
                'rules' => 'max_size[file_no_dplk,2048]|mime_in[file_no_dplk,application/pdf,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran file tidak boleh lebih dari 2 MB',
                    'mime_in' => 'file file salah'
                ]
            ], 'file_status_pernikahan' => [
                'rules' => 'max_size[file_status_pernikahan,2048]|mime_in[file_status_pernikahan,application/pdf,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran file tidak boleh lebih dari 2 MB',
                    'mime_in' => 'file file salah'
                ]
            ], 'file_status_pegawai' => [
                'rules' => 'max_size[file_status_pegawai,2048]|mime_in[file_status_pegawai,application/pdf,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran file tidak boleh lebih dari 2 MB',
                    'mime_in' => 'file file salah'
                ]
            ]
        ];

        if ($this->request->getVar('status_pegawai') == 'Pegawai Kontrak' || $this->request->getVar('status_pegawai') == 'Pegawai Alih Daya') {
            $validator['file_gaji_berkala'] = [
                'rules' => 'mime_in[file_gaji_berkala,application/pdf,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran file tidak boleh lebih dari 2 MB',
                    'mime_in' => 'file salah'
                ]
            ];
        } else {
            $validator['gol_ruang_masa_kerja']  = [
                'rules'     => 'required|regex_match[/^([ABCD])\/(IV?I{0,2})\/([1-3]?[0-9])$/]',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                    'regex_match'  =>  'Mohon isi sesuai format yang diberikan',
                ]
            ];
            $validator['iterasi']  = [
                'rules'     => 'required',
                'errors'    => [
                    'required'  =>  'Bagian ini harus diisi',
                ]
            ];
        }

        if (!$this->validate($validator)) {
            $errors = Services::validation()->getErrors();

            $output = [
                'error' => $errors,
                csrf_token() => csrf_hash()
            ];

            return $this->response->setJSON($output);
        }

        $data = [
            'id_pegawai' => $pegawai['id_pegawai'],
            'nama' => $this->request->getVar('nama'),
            'nip' => $this->request->getVar('nip'),
            'jabatan' => $this->request->getVar('jabatan'),
            'detail_jabatan' => $this->request->getVar('detail_jabatan'),
            'nik' => $this->request->getVar('nik'),
            'no_npwp' => $this->request->getVar('no_npwp'),
            'no_bpjs_tk' => $this->request->getVar('no_bpjs_tk'),
            'no_bpjs_kes' => $this->request->getVar('no_bpjs_kes'),
            'no_dplk' => $this->request->getVar('no_dplk'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'email' => $this->request->getVar('email'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'agama' => $this->request->getVar('agama'),
            'gol_darah' => $this->request->getVar('gol_darah'),
            'no_telp' => $this->request->getVar('nomor_telepon'),
            'alamat_rumah' => $this->request->getVar('alamat_rumah'),
            'alamat_domisili' => $this->request->getVar('alamat_domisili'),
            'status_pegawai' => $this->request->getVar('status_pegawai'),
            'status_pernikahan' => $this->request->getVar('status_pernikahan'),
            'jumlah_anak' => ($this->request->getVar('status_pernikahan') == 'Menikah' ? $this->request->getVar('jumlah_anak') : 0),
            'pendidikan_terakhir' => $this->request->getVar('pendidikan_terakhir'),
            'tahun_pengangkatan' => $this->request->getVar('tahun_pengangkatan'),
            'no_rekening' => $this->request->getVar('no_rekening'),
            'bank' => $this->request->getVar('bank')
        ];

        if ($this->request->getVar('status_pegawai') == 'Pegawai Kontrak' || $this->request->getVar('status_pegawai') == 'Pegawai Alih Daya') {
            $data['gol_ruang_masa_kerja'] = '-';
            $data['gaji_berkala'] = $this->request->getVar('gaji_berkala');
            $data['iterasi'] = 0;
        } else {
            $data['gol_ruang_masa_kerja'] = $this->request->getVar('gol_ruang_masa_kerja');
            $data['iterasi'] = $this->request->getVar('iterasi');
        }

        foreach ($this->request->getFiles() as $key => $file) :
            if ($file->isValid() && !$file->hasMoved()) {
                $dokumen = $this->dokumenM->getLastDokumenKategori(10, $this->tabelDokumen[$key]);

                if ($dokumen) {
                    $dokumen['status'] = 'Tidak Berlaku';
                    $this->dokumenM->save($dokumen);
                }

                $filename = $file->getRandomName();
                $file->move("dokumen/identitas/$key/{$pegawai['id_pegawai']}/", $filename);

                $data[$key] = $filename;

                $this->dokumenM->save([
                    'id_pegawai' => $pegawai['id_pegawai'],
                    'kategori' => $this->tabelDokumen[$key],
                    'nama' => $filename,
                    'status' => 'Berlaku'
                ]);
            }
        endforeach;

        $this->pegawaiM->save($data);

        $this->payroll(array($this->pegawaiM->find($this->session->get('pegawai'))));

        if ($valEmail != '') {
            $user = $this->userM->getUser($pegawai['email']);
            $this->userM->save([
                'id_user' => $user['id_user'],
                'username' => $data['email']
            ]);
        }

        $this->session->remove('pegawai');
        $this->session->setFlashdata('pesan', 'Identitas Pegawai Berhasil Diperbaharui');

        $output = [
            'redirect' => '/admin/pegawai/' . $pegawai['nik'],
            'error' => [],
            csrf_token() => csrf_hash()
        ];

        return $this->response->setJSON($output);
    }

    public function delete($nik)
    {
        if ($this->request->getMethod(true) != 'DELETE')
            return redirect()->to('/admin/pegawai');

        $pegawai = $this->pegawaiM->getPegawaiNIK($nik);

        if ($pegawai) {
            $this->pegawaiM->delete($pegawai['id_pegawai']);
            $this->session->setFlashdata('pesan', 'Pegawai Berhasil Dihapus');

            return redirect()->to('/admin/pegawai');
        }

        return redirect()->to('/admin/pegawai');
    }
}
