<?php

namespace App\Controllers;

class Dokumen extends BaseController
{
    public function getDokumen()
    {
        $id = $this->request->getVar('id');
        $nik = $this->session->get('nik');

        $pegawai = $this->pegawaiM->getPegawaiNIK($nik);
        $isi = '';
        $no = 0;

        if ($id == 'dokumen_kosong') {
            $isi = [];

            foreach ($this->tabelDokumen as $key => $value) :
                if ($pegawai[$key] == "") {
                    array_push($isi, "Dokumen $value belum diupload");
                }
            endforeach;
        } elseif ($id == 'dokumen_identitas_pegawai') {
            $dokumen = $this->dokumenM->getDokumen($pegawai['id_pegawai']);

            $temp = [];
            foreach ($dokumen as $key => $value)
                $temp[$value['kategori']][$key] = $value;

            $dokumen = [];
            foreach ($this->tabelDokumen as $key => $value)
                foreach ($temp as $kategori => $items)
                    if ($this->tabelDokumen[$key] == $kategori) {
                        $dokumen[$value] = [];
                        foreach ($items as $item)
                            array_push($dokumen[$kategori], $item);
                    }

            $isi = '';
            foreach ($dokumen as $kategori => $items) :
                $path = array_search($kategori, $this->tabelDokumen);
                foreach ($items as $key => $value) :
                    $count = count($items);
                    if ($count > 1)
                        if ($key == 0)
                            $isi .= "<tr> <td rowspan='$count'>" . ++$no . "</td> <td  class='nama' rowspan='$count'>$kategori</td> <td class='text-center'> <i class='fas fa-file fa-2x'></i>";
                        else
                            $isi .= "<tr> <td class='text-center'> <i class='fas fa-file fa-2x'></i>";
                    else
                        $isi .= "<tr> <td>" . ++$no . "</td> <td  class='nama'>$kategori</td> <td class='text-center'> <i class='fas fa-file fa-2x'></i>";
                    if (explode('.', $value['nama'])[1] == 'pdf')
                        $isi .= "<a data-fancybox data-type='iframe' data-src='/dokumen/identitas/$path/" . $pegawai['id_pegawai'] . "/{$value['nama']}' href='javascript:;'><button type='button' class='btn btn-sm btn-primary mr-2'>Lihat</button></a>";
                    else
                        $isi .= "<a href='/dokumen/identitas/$path/" . $pegawai['id_pegawai'] . "/{$value['nama']}' data-fancybox data-caption='$key'> <button type='button' class='btn btn-sm btn-primary mr-2'>Lihat</button></a>";

                    $isi .= "<button type='button' class='btn btn-sm btn-success mr-0 download-dokumen' onclick='downloadDokumen(event)'><i class='fas fa-fw fa-file-download mr-1'></i> Download</button> </td> <td>{$value['status']}</td> </tr>";
                endforeach;
            endforeach;
        } elseif ($id == 'dokumen_pendidikan_pelatihan') {
            $pendidikan = $this->pendidikanM->getPendidikan($pegawai['id_pegawai']);
            $pelatihan = $this->pelatihanM->getPelatihan($pegawai['id_pegawai']);

            foreach ($pendidikan as $value) :
                $isi .= "<tr> <td>" . ++$no . "</td> <td class='nama'>Ijazah " . $value['nama'] . "</td> <td class='text-center'> <i class='fas fa-file fa-2x'></i> ";
                if (explode('.', $value['ijazah'])[1] == 'pdf') {
                    $isi .= "<a data-fancybox data-type='iframe' data-src='/dokumen/pendidikan/" . $pegawai['id_pegawai'] . "/" . $value['ijazah'] . "' href='javascript:;'><button type='button' class='btn btn-sm btn-primary mr-2'>Lihat</button></a>";
                } else {
                    $isi .= "<a href='/dokumen/pendidikan/" . $pegawai['id_pegawai'] . "/" . $value['ijazah'] . "' data-fancybox data-caption='Ijazah " . $value['nama'] . "'> <button type='button' class='btn btn-sm btn-primary mr-2'>Lihat</button></a>";
                }
                $isi .= "<button type='button' class='btn btn-sm btn-success mr-0 download-dokumen' onclick='downloadDokumen(event)'><i class='fas fa-fw fa-file-download mr-1'></i> Download</button> </td> </tr>";
            endforeach;

            foreach ($pelatihan as $value) :
                $files = explode('|', $value['dokumen']);
                foreach ($files as $key => $file) :
                    $isi .= "<tr> <td>" . ++$no . "</td> <td  class='nama'>Dokumen Pelatihan " . $value['judul'] . " " . ++$key . "</td> <td class='text-center'> <i class='fas fa-file fa-2x'></i> ";
                    if (explode('.', $file) == 'pdf') {
                        $isi .= "<a data-fancybox data-type='iframe' data-src='/dokumen/pelatihan/" . $pegawai['id_pegawai'] . "/$file' href='javascript:;'><button type='button' class='btn btn-sm btn-primary mr-2'>Lihat</button></a>";
                    } else {
                        $isi .= "<a href='/dokumen/pelatihan/" . $pegawai['id_pegawai'] . "/$file' data-fancybox data-caption='Dokumen Pelatihan " . $value['judul'] . "'> <button type='button' class='btn btn-sm btn-primary mr-2'>Lihat</button></a>";
                    }
                    $isi .= "<button type='button' class='btn btn-sm btn-success mr-0 download-dokumen' onclick='downloadDokumen(event)'><i class='fas fa-fw fa-file-download mr-1'></i> Download</button> </td> </tr>";
                endforeach;
            endforeach;
        }

        $output = [
            'isi' => $isi,
            csrf_token() => csrf_hash()
        ];

        return $this->response->setJSON($output);
    }
}
