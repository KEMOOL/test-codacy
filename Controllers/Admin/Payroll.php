<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use DateTime;
use DateTimeZone;

class Payroll extends BaseController
{
    public function index()
    {
        $date = new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
        $pegawai = $this->pegawaiM->findAll();

        $this->payroll($pegawai);

        $data = [
            'payroll' => $this->payrollM->getData($this->bulan[$date->format('n') - 1], $date->format('Y'), $date->format('Y')),
            'bulan' => $this->bulan,
            'tahun' => $this->payrollM->getTahun(),
            'tombolPangkat' => ($this->pangkatM->getData($this->bulan[($date->format('n')) - 1] . '/' . $date->format('Y')) == null && ($date->format('n') == 1 || $date->format('n') == 7)) ? true : false
        ];

        return view('admin/payroll', $data);
    }

    public function tampil()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/payroll');

        $bulan = $this->request->getVar('bulan');
        $tahun = $this->request->getVar('tahun');

        $output = [
            'payroll' => $this->payrollM->getData($bulan, $tahun),
            csrf_token() => csrf_hash()
        ];

        return $this->response->setJSON($output);
    }

    public function exportGaji()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/payroll');

        date_default_timezone_set('Asia/Jakarta');

        $bulan = $this->request->getVar('bulan');
        $tahun = $this->request->getVar('tahun');
        $payroll = $this->payrollM->getData($bulan, $tahun);
        $data = [];

        $doc = IOFactory::load('excel/template_gaji.xlsx');
        $worksheet = $doc->getActiveSheet();

        $worksheet->setTitle('Rekap Gaji');
        $worksheet->setCellValue('A1', strtoupper('Rekap Gaji ' . $bulan . ' ' . $tahun));
        $worksheet->setCellValue('C6', date('j ') . $this->bulan[date('n') - 1] . date(' Y. H:i'));

        foreach ($payroll as $key => $value) :
            $pegawai = $this->pegawaiM->find($value['id_pegawai']);
            $temp = [];
            $temp['no'] = ++$key;
            $temp['nik'] = $this->formatNIK($pegawai['nik']);
            $temp['nama'] = $value['nama'];
            $temp['pendidikan'] = $pegawai['pendidikan_terakhir'];
            $temp['pengangkatan'] = str_replace('-', '/', $pegawai['tahun_pengangkatan']);
            $temp['lokasi'] = $value['unit_kerja'];
            $temp['status_marital'] = $value['status_marital'];
            $temp['jumlah_anak'] = $value['jumlah_anak'];
            $temp['jabatan'] = $value['jabatan'];
            $temp['nama_pangkat'] = 'Staf';
            $temp['golongan'] = $value['pangkat'];
            $temp['gaji_pokok'] = $value['gaji_pokok'];
            $temp['t_pasangan'] = $value['t_pasangan'];
            $temp['t_anak'] = $value['t_anak'];
            $temp['t_auditor'] = $value['t_auditor'];
            $temp['t_pangan'] = $value['t_pangan'];
            $temp['t_jabatan'] = $value['t_jabatan'];
            $temp['t_operasional'] = $value['t_operasional'];
            $temp['t_teller'] = $value['t_teller'];
            $temp['t_kinerja'] = $value['t_kinerja'];
            $temp['t_kinerja'] = $value['t_kinerja'];
            $temp['total_gaji'] = $value['jumlah'] - $value['lembur'];
            $temp['jht'] = $value['j_hari_tua'];
            $temp['bpjs_kes'] = $value['bpjs_kes'];
            $temp['j_pensiun'] = $value['j_pensiun'];
            $temp['angsuran'] = $value['p_angsuran'];
            $temp['p_lain_lain'] = $value['p_lain_lain'];
            $temp['jumlah_potongan'] = $value['jumlah_potongan'];
            $temp['lembur'] = $value['lembur'];
            $temp['payroll'] = $value['jumlah'] - $value['jumlah_potongan'];

            array_push($data, $temp);
        endforeach;

        $worksheet->fromArray($data, null, 'A9');

        if (!$payroll) {
            $worksheet->setCellValue('A9', 'Data Tidak Tersedia Pada Bulan Ini');
            $worksheet->mergeCells('A9:AC9');
        }

        $last_row =  $worksheet->getHighestRow();

        $worksheet->getStyle("E9:E$last_row")->getNumberFormat()
            ->setFormatCode('dd-mmm-yy');
        $worksheet->getStyle("L9:AC$last_row")->getNumberFormat()
            ->setFormatCode('_(* #,##0_);_(* (#,##0);_(* "-"_);_(@_)');

        $styleArray = [
            'alignment' => [
                'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'      => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
        ];

        $worksheet->getStyle("A9:B$last_row")->applyFromArray($styleArray);
        $worksheet->getStyle("G9:I$last_row")->applyFromArray($styleArray);
        $worksheet->getStyle("K9:K$last_row")->applyFromArray($styleArray);

        $styleArray = [
            'borders'   => [
                'allBorders'    => [
                    'borderStyle'   => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color'         => ['argb' => '000000'],
                ],
            ],
            'font'  => array(
                'size'  => 10,
                'name'  => 'Arial'
            )
        ];

        $worksheet->getStyle("A9:AC$last_row")->applyFromArray($styleArray);

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($doc);
        $filename = 'DaftarGaji.xlsx';
        $writer->save($filename);

        $output = [
            csrf_token() => csrf_hash(),
            'bulan' => $bulan
        ];

        return $this->response->setJSON($output);
    }

    public function exportPajak()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/admin/payroll');

        $pegawai = $this->pegawaiM->getAll();
        $dateNow = new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));

        $doc = IOFactory::load('excel/Template.xlsx');
        $clonedWorksheetDesember = clone $doc->getSheetByName('DESEMBER');
        $doc->removeSheetByIndex(2);
        $worksheet = $doc->setActiveSheetIndex(1);

        $data = [];

        for ($i = 0; $i < 12; $i++) {
            $data[$this->bulan[$i]] = [];
        }

        foreach ($pegawai as $key => $pegawai) :
            for ($i = 0; $i < 12; $i++) {
                $payroll = $this->payrollM->getDetail($pegawai['id_pegawai'], $this->bulan[$i], $dateNow->format('Y'));
                $temp = [];

                if ($i != 11) {
                    $temp = array_pad($temp, 30, '0');

                    $temp[0] = $key + 1;
                    $temp[1] = $pegawai['nama'];
                    $temp[2] = $pegawai['no_npwp'];
                    $temp[3] = $pegawai['jabatan'];

                    if ($payroll) {
                        $temp[4] = (($payroll['status_marital'] == 1) ? 'K' : 'TK') . '/' . ($payroll['status_marital'] + $payroll['jumlah_anak']);
                    } else {
                        $temp[4] = (($pegawai['status_pernikahan'] == 'Menikah') ? 'K' : 'TK') . '/' . ((($pegawai['status_pernikahan'] == 'Menikah') ? 1 : 0) + $pegawai['jumlah_anak']);
                    }

                    $temp[5] = 'L';

                    $date1 = new DateTime($pegawai['tahun_pengangkatan'], new DateTimeZone('Asia/Jakarta'));
                    $date2 = new DateTime($pegawai['deleted_at'], new DateTimeZone('Asia/Jakarta'));
                    $dateNow = new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
                    $dateLower = new DateTime($dateNow->format('Y') . '-01-01', new DateTimeZone('Asia/Jakarta'));
                    $dateUper = new DateTime($dateNow->format('Y') . '-12-31', new DateTimeZone('Asia/Jakarta'));

                    if ($date1 < $dateLower)
                        $temp[6] = 1;
                    else
                        $temp[6] = $date1->format('n');

                    if (checkdate($date2->format('n'), $date2->format('d'), $date2->format('Y')) && $date2 < $dateUper)
                        $temp[7] = $date1->format('n');
                    else
                        $temp[7] = 12;

                    if ($payroll) {
                        $temp[8] = $payroll['gaji_pokok'] + $payroll['t_pasangan'] + $payroll['t_anak'] + $payroll['t_pangan'] + $payroll['t_jabatan'] + $payroll['t_operasional'] + $payroll['t_teller'] + $payroll['t_auditor'];
                        $temp[10] = ($payroll['lembur']) ? intval($payroll['lembur']) : '0';
                        $temp[12] = $payroll['bpjs_kes'] + $payroll['j_pensiun'] + $payroll['j_hari_tua'];
                        $temp[15] = $payroll['t_kinerja'] + $payroll['thr'] + $payroll['t_prestasi'] + $payroll['t_pendidikan'] + $payroll['tantiem'];
                    }
                } else {
                    $temp = array_pad($temp, 42, '0');

                    $temp[0] = $key + 1;
                    $temp[1] = $pegawai['nama'];
                    $temp[2] = $pegawai['no_npwp'];
                    $temp[3] = $pegawai['alamat_rumah'];
                    $temp[4] = ($pegawai['jenis_kelamin'] == 'Laki-laki') ? 'M' : 'F';
                    $temp[5] = $pegawai['jabatan'];
                    $temp[6] = 0;
                    $temp[7] = 'L';

                    if ($payroll) {
                        $temp[8] = (($payroll['status_marital'] == 1) ? 'K' : 'TK') . '/' . ($payroll['status_marital'] + $payroll['jumlah_anak']);
                    } else {
                        $temp[8] = (($pegawai['status_pernikahan'] == 'Menikah') ? 'K' : 'TK') . '/' . ((($pegawai['status_pernikahan'] == 'Menikah') ? 1 : 0) + $pegawai['jumlah_anak']);
                    }

                    $date1 = new DateTime($pegawai['tahun_pengangkatan'], new DateTimeZone('Asia/Jakarta'));
                    $date2 = new DateTime($pegawai['deleted_at'], new DateTimeZone('Asia/Jakarta'));
                    $dateNow = new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
                    $dateLower = new DateTime($dateNow->format('Y') . '-01-01', new DateTimeZone('Asia/Jakarta'));
                    $dateUper = new DateTime($dateNow->format('Y') . '-12-31', new DateTimeZone('Asia/Jakarta'));

                    if ($date1 < $dateLower)
                        $temp[9] = 1;
                    else
                        $temp[9] = $date1->format('n');

                    if (checkdate($date2->format('n'), $date2->format('d'), $date2->format('Y')) && $date2 < $dateUper)
                        $temp[10] = $date1->format('n');
                    else
                        $temp[10] = 12;

                    if ($payroll) {
                        $temp[11] = $payroll['gaji_pokok'] + $payroll['t_pasangan'] + $payroll['t_anak'] + $payroll['t_pangan'] + $payroll['t_jabatan'] + $payroll['t_operasional'] + $payroll['t_teller'] + $payroll['t_auditor'];
                        $temp[13] = ($payroll['lembur']) ? intval($payroll['lembur']) : '0';
                        $temp[15] = $payroll['bpjs_kes'] + $payroll['j_pensiun'] + $payroll['j_hari_tua'];
                        $temp[19] = $payroll['t_kinerja'] + $payroll['thr'] + $payroll['t_prestasi'] + $payroll['t_pendidikan'] + $payroll['tantiem'];
                    }
                }

                array_push($data[$this->bulan[$i]], $temp);
            }
        endforeach;

        for ($i = 1; $i < 12; $i++) {
            if ($i != 11) {
                $clonedWorksheet = clone $doc->getSheetByName('JANUARI');
                $clonedWorksheet->setTitle(strtoupper($this->bulan[$i]));
                $doc->addSheet($clonedWorksheet);
            } else {
                $clonedWorksheetDesember->setTitle(strtoupper($this->bulan[$i]));
                $doc->addSheet($clonedWorksheetDesember);
            }
        }

        for ($i = 0; $i < 12; $i++) {
            $tempData = $data[$this->bulan[$i]];

            $worksheet = $doc->setActiveSheetIndex($i + 1);

            $worksheet->fromArray($tempData, null, 'B12');

            $last_column =  $worksheet->getHighestColumn();
            $last_row =  $worksheet->getHighestRow();

            if ($i != 11) {
                for ($j = 12; $j <= $last_row; $j++) {
                    $worksheet->setCellValue("P$j", "=SUM(J$j:O$j)");
                    $worksheet->setCellValue("R$j", "=SUM(P$j:Q$j)");
                    $worksheet->setCellValue("S$j", '=IF(P' . $j . '*0.05>=BACA!$G$11,BACA!$G$11,P' . $j . '*0.05)');
                    $worksheet->setCellValue("T$j", '=IF((Q' . $j . '*0.05)+S' . $j . '>=BACA!$G$11,BACA!$G$11-S' . $j . ',Q' . $j . '*0.05)');
                    $worksheet->setCellValue("V$j", "=SUM(S$j:U$j)");
                    $worksheet->setCellValue("W$j", '=IF(I' . $j . '=1,R' . $j . '-V' . $j . ',IF(AND(H' . $j . '>1,G' . $j . '="E"),(R' . $j . '-Q' . $j . '-V' . $j . '+T' . $j . ')*(12-H' . $j . '+1)*12/(12-H' . $j . '+1)+Q' . $j . '-T' . $j . ',(R' . $j . '-Q' . $j . '-V' . $j . '+T' . $j . ')*(12-H' . $j . '+1)+Q' . $j . '-T' . $j . '))');
                    if ($i == 0)
                        $worksheet->setCellValue("X$j", '=IF(J' . $j . '>0,VLOOKUP(F' . $j . ',BACA!$F$57:$G$64,2),0)');
                    else
                        $worksheet->setCellValue("X$j", '=IF(J' . $j . '>0,VLOOKUP(JANUARI!F' . $j . ',BACA!$F$57:$G$64,2),0)');
                    $worksheet->setCellValue("Y$j", "=IF((W$j-X$j)>0,FLOOR((W$j-X$j),1000),0)");
                    $worksheet->setCellValue("Z$j", "=IF(AND(Q$j>0,Y$j-Q$j+T$j>0),FLOOR(Y$j-Q$j+T$j,1000),0)");
                    $worksheet->setCellValue("AA$j", '=(IF(Z' . $j . '<=BACA!$E$7,Z' . $j . '*BACA!$F$7,IF(AND(Z' . $j . '>BACA!$C$8,Z' . $j . '<=BACA!$E$8),(Z' . $j . '*BACA!$F$8)-BACA!$F$68,IF(AND(Z' . $j . '>BACA!$C$9,Z' . $j . '<=BACA!$E$9),(Z' . $j . '*BACA!$F$9)-BACA!$F$69,(Z' . $j . '*BACA!$F$10)-BACA!$F$70))))');
                    $worksheet->setCellValue("AB$j", '=(IF(Y' . $j . '<=BACA!$E$7,Y' . $j . '*BACA!$F$7,IF(AND(Y' . $j . '>BACA!$C$8,Y' . $j . '<=BACA!$E$8),(Y' . $j . '*BACA!$F$8)-BACA!$F$68,IF(AND(Y' . $j . '>BACA!$C$9,Y' . $j . '<=BACA!$E$9),(Y' . $j . '*BACA!$F$9)-BACA!$F$69,(Y' . $j . '*BACA!$F$10)-BACA!$F$70))))');
                    $worksheet->setCellValue("AC$j", "=IF(Q$j>0,AB$j-AA$j,0)");
                    $worksheet->setCellValue("AD$j", '=IF(AND(G' . $j . '="E",AC' . $j . '>0,H' . $j . '>1),(AA' . $j . '*(12-H' . $j . '+1)/12)/(12-H' . $j . '+1)+AC' . $j . ',IF(AC' . $j . '>0,(AA' . $j . '/(12-H' . $j . '+1))+AC' . $j . ',IF(AND(G' . $j . '="E",H' . $j . '>1),(AB' . $j . '*(12-H' . $j . '+1)/12)/(12-H' . $j . '+1),AB' . $j . '/(12-H' . $j . '+1))))');
                    $worksheet->setCellValue("AE$j", "=IF(LEFT(D$j,8)*1>0,AD$j,120%*AD$j)");
                }

                $worksheet->getStyle("D12:D$last_row")->getNumberFormat()->setFormatCode('00"."000"."000"."0"-"000"."000');
                $worksheet->getStyle("G12:$last_column$last_row")->getNumberFormat()->setFormatCode('_(* #,##0_);_(* (#,##0);_(* "-"_);_(@_)');

                $styleArray = [
                    'alignment' => [
                        'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical'      => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                    ],
                ];

                $worksheet->getStyle("B12:B$last_row")->applyFromArray($styleArray);
                $worksheet->getStyle("G12:AE$last_row")->applyFromArray($styleArray);

                $styleArray = [
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'FBE4D5',
                        ],
                    ],
                ];

                $worksheet->getStyle("B11:I$last_row")->applyFromArray($styleArray);
                $worksheet->getStyle("P11:P$last_row")->applyFromArray($styleArray);
                $worksheet->getStyle("R11:T$last_row")->applyFromArray($styleArray);
                $worksheet->getStyle("V11:AE$last_row")->applyFromArray($styleArray);
            } else {
                for ($j = 12; $j <= $last_row; $j++) {
                    $worksheet->setCellValue("S$j", "=SUM(M$j:R$j)");
                    $worksheet->setCellValue("T$j", "=JANUARI!P$j+FEBRUARI!P$j+MARET!P$j+APRIL!P$j+MEI!P$j+JUNI!P$j+JULI!P$j+AGUSTUS!P$j+SEPTEMBER!P$j+OKTOBER!P$j+NOVEMBER!P$j");
                    $worksheet->setCellValue("V$j", "=JANUARI!Q$j+FEBRUARI!Q$j+MARET!Q$j+APRIL!Q$j+MEI!Q$j+JUNI!Q$j+JULI!Q$j+AGUSTUS!Q$j+SEPTEMBER!Q$j+OKTOBER!Q$j+NOVEMBER!Q$j");
                    $worksheet->setCellValue("W$j", "=U$j+V$j");
                    $worksheet->setCellValue("X$j", "=S$j+T$j+W$j");
                    $worksheet->setCellValue("Y$j", '=IF((S' . $j . '+T' . $j . ')*0.05>=BACA!$G$11*(L' . $j . '-K' . $j . '+1),BACA!$G$11*(L' . $j . '-K' . $j . '+1),(S' . $j . '+T' . $j . ')*0.05)');
                    $worksheet->setCellValue("Z$j", '=IF((W' . $j . '*0.05)+Y' . $j . '>=BACA!$G$11*(L' . $j . '-K' . $j . '+1),BACA!$G$11*(L' . $j . '-K' . $j . '+1)-Y' . $j . ',W' . $j . '*0.05)');
                    $worksheet->setCellValue("AB$j", "=JANUARI!U$j+FEBRUARI!U$j+MARET!U$j+APRIL!U$j+MEI!U$j+JUNI!U$j+JULI!U$j+AGUSTUS!U$j+SEPTEMBER!U$j+OKTOBER!U$j+NOVEMBER!U$j");
                    $worksheet->setCellValue("AC$j", "=SUM(Y$j:AB$j)");
                    $worksheet->setCellValue("AC$j", "=SUM(Y$j:AB$j)");
                    $worksheet->setCellValue("AE$j", '=IF(AND(AD' . $j . '=0,OR(H' . $j . '=1,H' . $j . '=3,H' . $j . '=5,AND(I' . $j . '="E",OR(K' . $j . '>1,L' . $j . '<12)))),((X' . $j . '-W' . $j . '-AC' . $j . '+Z' . $j . ')*12/(L' . $j . '-K' . $j . '+1))+W' . $j . '-Z' . $j . ',X' . $j . '-AC' . $j . '+AD' . $j . ')');
                    $worksheet->setCellValue("AF$j", '=VLOOKUP(JANUARI!F' . $j . ',BACA!$F$57:$G$64,2)');
                    $worksheet->setCellValue("AG$j", "=IF((AE$j-AF$j)>0,FLOOR((AE$j-AF$j),1000),0)");
                    $worksheet->setCellValue("AH$j", "=IF(AND(W$j>0,AG$j-W$j+Z$j>0),FLOOR((AG$j-W$j+Z$j),1000),0)");
                    $worksheet->setCellValue("AI$j", '=(IF(AH' . $j . '<=BACA!$E$7,AH' . $j . '*BACA!$F$7,IF(AND(AH' . $j . '>BACA!$C$8,AH' . $j . '<=BACA!$E$8),(AH' . $j . '*BACA!$F$8)-BACA!$F$68,IF(AND(AH' . $j . '>BACA!$C$9,AH' . $j . '<=BACA!$E$9),(' . $j . '*BACA!$F$9)-BACA!$F$69,(AH' . $j . '*BACA!$F$10)-BACA!$F$70))))');
                    $worksheet->setCellValue("AJ$j", '=(IF(AG' . $j . '<=BACA!$E$7,AG' . $j . '*BACA!$F$7,IF(AND(AG' . $j . '>BACA!$C$8,AG' . $j . '<=BACA!$E$8),(AG' . $j . '*BACA!$F$8)-BACA!$F$68,IF(AND(AG' . $j . '>BACA!$C$9,AG' . $j . '<=BACA!$E$9),(AG' . $j . '*BACA!$F$9)-BACA!$F$69,(AG' . $j . '*BACA!$F$10)-BACA!$F$70))))');
                    $worksheet->setCellValue("AK$j", "=IF(W$j>0,AJ$j-AI$j,0)");
                    $worksheet->setCellValue("AL$j", "=IF(AK$j>0,AI$j*((L$j-K$j+1)/12)+AK$j,AJ$j*(L$j-K$j+1)/12)");
                    $worksheet->setCellValue("AM$j", '=IF(AND(AD' . $j . '=0,OR(H' . $j . '=1,H' . $j . '=3,H' . $j . '=5,AND(I' . $j . '="E",OR(K' . $j . '>1,L' . $j . '<12)))),AL' . $j . ',AJ' . $j . ')');
                    $worksheet->setCellValue("AN$j", "=IF(LEFT(D$j,8)*1>0,AM$j,120%*AM$j)");
                    $worksheet->setCellValue("AO$j", "=JANUARI!AE$j+FEBRUARI!AE$j+MARET!AE$j+APRIL!AE$j+MEI!AE$j+JUNI!AE$j+JULI!AE$j+AGUSTUS!AE$j+SEPTEMBER!AE$j+OKTOBER!AE$j+NOVEMBER!AE$j");
                    $worksheet->setCellValue("AQ$j", "=AN$j-AO$j-AP$j");
                }

                $worksheet->getStyle("D12:D$last_row")->getNumberFormat()->setFormatCode('00"."000"."000"."0"-"000"."000');
                $worksheet->getStyle("K12:$last_column$last_row")->getNumberFormat()->setFormatCode('_(* #,##0_);_(* (#,##0);_(* "-"_);_(@_)');

                $styleArray = [
                    'alignment' => [
                        'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical'      => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                    ],
                ];

                $worksheet->getStyle("B12:B$last_row")->applyFromArray($styleArray);
                $worksheet->getStyle("K12:$last_column$last_row")->applyFromArray($styleArray);

                $styleArray = [
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'FBE4D5',
                        ],
                    ],
                ];

                $worksheet->getStyle("B11:G$last_row")->applyFromArray($styleArray);
                $worksheet->getStyle("I11:L$last_row")->applyFromArray($styleArray);
                $worksheet->getStyle("S11:T$last_row")->applyFromArray($styleArray);
                $worksheet->getStyle("V11:Z$last_row")->applyFromArray($styleArray);
                $worksheet->getStyle("AB11:AC$last_row")->applyFromArray($styleArray);
                $worksheet->getStyle("AE11:AO$last_row")->applyFromArray($styleArray);
                $worksheet->getStyle("AQ11:AQ$last_row")->applyFromArray($styleArray);
            }
            $styleArray = [
                'font'  => array(
                    'size'  => 10,
                    'name'  => 'Arial'
                )
            ];

            $worksheet->getStyle("B6:$last_column$last_row")->applyFromArray($styleArray);

            $styleArray = [
                'borders'   => [
                    'allBorders'    => [
                        'borderStyle'   => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color'         => ['argb' => '000000'],
                    ],
                    'outline'    => [
                        'borderStyle'   => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
                        'color'         => ['argb' => '000000'],
                    ],
                ],
            ];

            $worksheet->getStyle("B12:$last_column$last_row")->applyFromArray($styleArray);
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($doc);
        $filename = 'DataPajak.xlsx';
        $writer->save($filename);
    }

    public function naikPangkat()
    {
        $date = new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));

        if ($date->format('n') == 1 || $date->format('n') == 7) {
            if (!$this->pangkatM->getData($this->bulan[($date->format('n')) - 1] . '/' . $date->format('Y'))) {
                foreach ($this->pegawaiM->findAll() as $value) :
                    if ($value['status_pegawai'] == 'Pegawai Kontrak' || $value['status_pegawai'] == 'Pegawai Alih Daya')
                        continue;

                    $this->naikPangkatPegwai($value);
                endforeach;

                $this->pangkatM->save([
                    'bulan_tanggal' => $this->bulan[($date->format('n')) - 1] . '/' . $date->format('Y')
                ]);

                $this->session->setFlashdata('pesan', 'Pangkat berhasil dinaikkan');
            }
        } else
            $this->session->setFlashdata('error', 'Pengangkatan pangkat hanya bulan Januari dan Juli');

        return redirect()->to('/admin/payroll');
    }
}
