<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use DateTime;
use DateTimeZone;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		$this->session = \Config\Services::session();

		$this->userM = new \App\Models\UserModel();
		$this->pegawaiM = new \App\Models\PegawaiModel();
		$this->dokumenM = new \App\Models\DokumenModel();
		$this->pasanganM = new \App\Models\PasanganModel();
		$this->anakM = new \App\Models\AnakModel();
		$this->pendidikanM = new \App\Models\pendidikanModel();
		$this->pelatihanM = new \App\Models\pelatihanModel();
		$this->tunjanganM = new \App\Models\TunjanganModel();
		$this->tJabatanM = new \App\Models\TunjanganJabatanModel();
		$this->tOperasionalM = new \App\Models\TunjanganOperasionalModel();
		$this->pelanggaranM = new \App\Models\PelanggaranModel();
		$this->cutiM = new \App\Models\CutiModel();
		$this->penilaianM = new \App\Models\PenilaianModel();
		$this->payrollM = new \App\Models\PayrollModel();
		$this->rumusM = new \App\Models\RumusModel();
		$this->TLemburM = new \App\Models\TLemburModel();
		$this->TKinerjaM = new \App\Models\TkinerjaModel();
		$this->TTellerM = new \App\Models\TTellerModel();
		$this->TAuditorM = new \App\Models\TAuditorModel();
		$this->THRM = new \App\Models\THRModel();
		$this->TPrestasiM = new \App\Models\TPrestasiModel();
		$this->TPendidikanM = new \App\Models\TPendidikanModel();
		$this->TTantiemM = new \App\Models\TantiemModel();
		$this->PAngsuranM = new \App\Models\PAngsuranModel();
		$this->PLainlainM = new \App\Models\PLainlainModel();
		$this->pangkatM = new \App\Models\PangkatModel();

		$this->golongan = [
			'A' => [
				1 => [624000, 624000, 668800,	668800, 713600,	713600,	758400,	758400,	803200,	803200,	848000,	848000,	892800,	892800,	937600,	937600,	982400,	982400,	1027200, 1027200, 1072000, 1072000, 1116800, 1116800, 1161600, 1161600, 1206400, 1206400],
				2 => [737600, 737600, 792000, 792000, 846400, 846400, 900800, 900800, 955200, 955200, 1009600, 1009600, 1064000, 1064000, 1118400, 1118400, 1172800, 1172800, 1227200, 1227200, 1281600, 1281600, 1336000, 1336000, 1390400],
				3 => [757600, 757600, 821600, 821600, 885600, 885600, 933600, 933600, 1013600, 1013600, 1077600, 1077600, 1141600, 1141600, 1205600, 1205600, 1269600, 1269600, 1333600, 1333600, 1397600, 1397600, 1461600, 1461600, 1525600],
				4 => [777600, 777600, 851200, 851200, 924800, 924800, 992000, 992000, 1072000, 1072000, 1145600, 1145600, 1219200, 1219200, 1292800, 1292800, 1366400, 1366400, 1440000, 1440000, 1513600, 1513600, 1571200, 1571200, 1660800]
			],
			'B' => [
				1 => [880800, 938400, 938400, 1018400, 1018400, 1098400, 1098400, 1178400, 1178400, 1258400, 1258400, 1338400, 1338400, 1418400, 1418400, 1498400, 1498400, 1578400, 1578400, 1658400, 1658400, 1738400, 1738400, 1818400, 1818400, 1898400, 1898400, 1978400, 1978400, 2058400, 2058400, 2138400, 2138400, 2218400],
				2 => [1032000, 1032000, 1120000, 1120000, 1208000, 1208000, 1296000, 1296000, 1384000, 1384000, 1472000, 1472000, 1560000, 1560000, 1648000, 1648000, 1736000, 1736000, 1824000, 1824000, 1912000, 1912000, 2000000, 2000000, 2088000, 2088000, 2176000, 2176000, 2264000, 2264000, 2352000],
				3 => [1053600, 1053600, 1151200, 1151200, 1248800, 1248800, 1346400, 1346400, 1444000, 1444000, 1541600, 1541600, 1639200, 1639200, 1736800, 1736800, 1834400, 1834400, 1932000, 1932000, 2029600, 2029600, 2127200, 2127200, 2232800, 2232800, 2322400, 2322400, 2420000, 2420000, 2517600],
				4 => [1082400, 1082400, 1189600, 1189600, 1296800, 1296800, 1404000, 1404000, 1511200, 1511200, 1618400, 1618400, 1725600, 1725600, 1832800, 1832800, 1940000, 1940000, 2047200, 2047200, 2154400, 2154400, 2261600, 2261600, 2368800, 2368800, 2476000, 2476000, 2583200, 2583200, 2930400]
			],
			'C' => [
				1 => [1201600, 1201600, 1313600, 1313600, 1425600, 1425600, 1537600, 1537600, 1641600, 1641600, 1761600, 1761600, 1873600, 1873600, 1985600, 1985600, 2097600, 2097600, 2209600, 2209600, 2321600, 2321600, 2433600, 2433600, 2545600, 2545600, 2657600, 2657600, 2769600, 2769600, 2881600, 2881600, 2993600],
				2 => [1232000, 1232000, 1350400, 1350400, 1468800, 1468800, 1555200, 1555200, 1705600, 1705600, 1824000, 1824000, 1942400, 1942400, 2060800, 2060800, 2179200, 2179200, 2297600, 2297600, 2416000, 2416000, 2529600, 2529600, 2652800, 2652800, 2771200, 2771200, 2889600, 2889600, 3008000, 3008000, 3126400],
				3 => [1262400, 1262400, 1387200, 1387200, 1512000, 1512000, 1636800, 1636800, 1761600, 1761600, 1886400, 1886400, 2011200, 2011200, 2136000, 2136000, 2260800, 2260800, 2385600, 2385600, 2510400, 2510400, 2635200, 2635200, 2760000, 2760000, 2884800, 2884800, 3009600, 3009600, 3129600, 3129600, 3256000],
				4 => [1292800, 1292800, 1424000, 1424000, 1555200, 1555200, 1686400, 1686400, 1817600, 1817600, 1948800, 1948800, 2080000, 2080000, 2211200, 2211200, 2342400, 2342400, 2473600, 2473600, 2604800, 2604800, 2736000, 2736000, 2867200, 2867200, 2996800, 2996800, 3129600, 3129600, 3260800, 3260800, 3392000]
			],
			'D' => [
				1 => [1348800, 1348800, 1489600, 1489600, 1630400, 1630400, 1771200, 1771200, 1912000, 1912000, 2052800, 2052800, 2193600, 2193600, 2334400, 2334400, 2475200, 2475200, 2616000, 2616000, 2756800, 2756800, 2897600, 2897600, 3035200, 3035200, 3179200, 3179200, 3320000, 3320000, 3460800, 3460800, 3601600],
				2 => [1411200, 1411200, 1560000, 1560000, 1708800, 1708800, 1857600, 1857600, 2006400, 2006400, 2155200, 2155200, 2304000, 2304000, 2452800, 2452800, 2606400, 2606400, 2750400, 2750400, 2899200, 2899200, 3048000, 3048000, 3196800, 3196800, 3345600, 3345600, 3494400, 3494400, 3643200, 3643200, 3792000],
				3 => [1474400, 1474400, 1652800, 1652800, 1784000, 1784000, 1939200, 1939200, 2094400, 2094400, 2249600, 2249600, 2452800, 2452800, 2560000, 2560000, 2715200, 2715200, 2870400, 2870400, 3025600, 3025600, 3180800, 3180800, 3336000, 3336000, 3491200, 3491200, 3646400, 3646400, 3806400, 3806400, 3956800],
				4 => [1584000, 1584000, 1696800, 1696800, 1859200, 1859200, 2020800, 2020800, 2182400, 2182400, 2344000, 2344000, 2505600, 2505600, 2667200, 2667200, 2828800, 2828800, 2990400, 2990400, 3152000, 3152000, 3313600, 3313600, 3475200, 3475200, 3636800, 3636800, 3798400, 3798400, 3960000, 3960000, 4120000]
			]
		];
		$this->tingkatPendidikan = ['SD atau Setingkat', 'SMP atau Setingkat', 'SMA atau Setingkat', 'Diploma I  atau Setingkat', 'Diploma II atau Setingkat', 'Sarjana Muda', 'Diploma III', 'Akademi', 'Diploma IV', 'Sarjana (S1)', 'Magister (S2)'];
		$this->maxCuti = 12;
		$this->bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
		$this->tabelDokumen = [
			'foto' => 'Foto Pegawai',
			'file_nip' => 'Kartu Pegawai',
			'file_jabatan' => 'Jabatan',
			'file_nik' => 'KTP',
			'file_no_npwp' => 'NPWP',
			'file_no_bpjs_tk' => 'BPJS Ketenagakerjaan',
			'file_no_bpjs_kes' => 'BPJS Kesehatan',
			'file_no_dplk' => 'DPLK',
			'file_status_pernikahan' => 'Surat Nikah',
			'file_status_pegawai' => 'Status Pegawai',
			'file_gaji_berkala' => 'Gaji'
		];
	}

	public function numberToRoman($number)
	{
		$map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
		$returnValue = '';

		while ($number > 0) {
			foreach ($map as $roman => $int) {
				if ($number >= $int) {
					$number -= $int;
					$returnValue .= $roman;
					break;
				}
			}
		}

		return $returnValue;
	}

	public function romanToNumber($roman)
	{
		$romans = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1,);

		$result = 0;

		foreach ($romans as $key => $value) {
			while (strpos($roman, $key) === 0) {
				$result += $value;
				$roman = substr($roman, strlen($key));
			}
		}

		return $result;
	}

	public function formatNIK($nik)
	{
		$nik = substr_replace($nik, '.', 6, 0);
		$nik = substr_replace($nik, '.', 13, 0);

		return $nik;
	}

	public function formatNPWP($npwp)
	{
		$npwp = substr_replace($npwp, '.', 2, 0);
		$npwp = substr_replace($npwp, '.', 6, 0);
		$npwp = substr_replace($npwp, '.', 10, 0);
		$npwp = substr_replace($npwp, '-', 12, 0);
		$npwp = substr_replace($npwp, '.', 16, 0);

		return $npwp;
	}

	public function payroll($pegawai)
	{
		$data = [];
		foreach ($pegawai as $value) :
			$tanggal = new DateTime();
			$bulanTahun = $tanggal->format('n') . '/' . $tanggal->format('Y');
			$payroll = [];

			$payroll['id_pegawai'] = $value['id_pegawai'];
			$payroll['nama'] = $value['nama'];
			$payroll['unit_kerja'] = 'Kantor Pusat';
			$payroll['pangkat'] = $value['gol_ruang_masa_kerja'];
			$payroll['jumlah_anak'] = intval($value['jumlah_anak']);
			$payroll['jabatan'] = $value['jabatan'];

			if ($value['status_pegawai'] == 'Pegawai Kontrak' || $value['status_pegawai'] == 'Pegawai Alih Daya') {
				$payroll['gaji_pokok'] = $value['gaji_berkala'];
				$payroll['status_marital'] = ($value['status_pernikahan'] == 'Menikah') ? 1 : 0;
				$payroll['jumlah'] = $value['gaji_berkala'];
				$payroll['gaji_bersih'] = $value['gaji_berkala'];
			} else {
				$pangkat = explode('/', $value['gol_ruang_masa_kerja']);
				$payroll['gaji_pokok'] = $this->golongan[$pangkat[0]][$this->romanToNumber($pangkat[1])][$pangkat[2]];
				$payroll['t_jabatan'] = intval($this->tunjanganM->getTunjanganSpesifik($value['jabatan'], 'Jabatan')['nominal']);
				$payroll['t_operasional'] = intval($this->tunjanganM->getTunjanganSpesifik($value['jabatan'], 'Operasional')['nominal']);
				$rumus = explode('|', $this->rumusM->getRumus('pangan')['rumus']);
				$payroll['t_pangan'] = round(($rumus[0] / 100 * $payroll['gaji_pokok']) + ($rumus[1] * (1 + (($value['status_pernikahan'] == 'Menikah') ? 1 : 0) + $payroll['jumlah_anak'])));

				$temp = $this->TLemburM->getTunjangan($bulanTahun, $value['id_pegawai']);
				$payroll['lembur'] = (isset($temp)) ? intval($temp['nominal']) : 0;

				$temp = $this->TKinerjaM->getTunjangan($bulanTahun, $value['id_pegawai']);
				$payroll['t_kinerja'] = (isset($temp)) ? intval($temp['nominal']) : 0;

				$temp = $this->TTellerM->getTunjangan($bulanTahun, $value['id_pegawai']);
				$payroll['t_teller'] = (isset($temp)) ? intval($temp['nominal']) : 0;

				$temp = $this->TAuditorM->getTunjangan($bulanTahun, $value['id_pegawai']);
				$payroll['t_auditor'] = (isset($temp)) ? intval($temp['nominal']) : 0;

				if ($value['status_pernikahan'] == 'Menikah') {
					$payroll['status_marital'] = 1;
					$payroll['t_pasangan'] = round($this->rumusM->getRumus('pasangan')['rumus'] / 100 * $payroll['gaji_pokok']);
					$payroll['t_anak'] = round($this->rumusM->getRumus('anak')['rumus'] / 100 * $payroll['gaji_pokok']) * $value['jumlah_anak'];
				} else {
					$payroll['status_marital'] = 0;
					$payroll['t_pasangan'] = 0;
					$payroll['t_anak'] = 0;
				}

				$payroll['jumlah'] = $payroll['gaji_pokok'] + $payroll['t_pasangan'] + $payroll['t_anak'] + $payroll['lembur'] + $payroll['t_pangan'] + $payroll['t_jabatan'] + $payroll['t_operasional'] + $payroll['t_kinerja'] + $payroll['t_teller'] + $payroll['t_auditor'];

				$temp = round(1 / 100 * ($payroll['jumlah'] - $payroll['lembur'] - $payroll['t_kinerja']));
				$payroll['bpjs_kes'] = ($temp > 12000000) ? 12000000 : $temp;
				$payroll['j_pensiun'] = ($temp > 8939700) ? 8939700 : $temp;
				$payroll['j_hari_tua'] = round(2 / 100 * ($payroll['jumlah'] - $payroll['lembur'] - $payroll['t_kinerja']));

				$temp = $this->PAngsuranM->getPotongan($bulanTahun, $value['id_pegawai']);
				$payroll['p_angsuran'] = (isset($temp)) ? intval($temp['nominal']) : 0;

				$temp = $this->PLainlainM->getPotongan($bulanTahun, $value['id_pegawai']);
				$payroll['p_lainlain'] = (isset($temp)) ? intval($temp['nominal']) : 0;
				$payroll['jumlah_potongan'] = $payroll['bpjs_kes'] + $payroll['j_pensiun'] + $payroll['j_hari_tua'] + $payroll['p_angsuran'] + $payroll['p_lainlain'];
				$payroll['gaji_bersih'] = $payroll['jumlah'] - $payroll['jumlah_potongan'];

				$temp = $this->THRM->getTunjangan($bulanTahun, $value['id_pegawai']);
				$payroll['thr'] = (isset($temp)) ? intval($temp['nominal']) : 0;

				$temp = $this->TPrestasiM->getTunjangan($bulanTahun, $value['id_pegawai']);
				$payroll['t_prestasi'] = (isset($temp)) ? intval($temp['nominal']) : 0;

				$temp = $this->TPendidikanM->getTunjangan($bulanTahun, $value['id_pegawai']);
				$payroll['t_pendidikan'] = (isset($temp)) ? intval($temp['nominal']) : 0;

				$temp = $this->TTantiemM->getTunjangan($bulanTahun, $value['id_pegawai']);
				$payroll['tantiem'] = (isset($temp)) ? intval($temp['nominal']) : 0;

				$value['gaji_berkala'] = $payroll['gaji_bersih'];

				$this->pegawaiM->save($value);
			}

			$payroll['no_rekening'] = $value['no_rekening'];
			$payroll['bank'] = $value['bank'];
			$payroll['bulan'] = $this->bulan[$tanggal->format('n') - 1];
			$payroll['tahun'] = $tanggal->format('Y');

			array_push($data, $payroll);
		endforeach;

		foreach ($data as $value) :
			$temp = $this->payrollM->getDetail($value['id_pegawai'], $value['bulan'], $value['tahun']);

			if ($temp) {
				$value['id_payroll'] = $temp['id_payroll'];

				$this->payrollM->save($value);
			} else
				$this->payrollM->save($value);
		endforeach;
	}

	public function naikPangkatPegwai($pegawai)
	{
		$pangkat = explode('/', $pegawai['gol_ruang_masa_kerja']);
		$pangkat[1] = $this->romanToNumber($pangkat[1]);
		$batas = $this->batasPangkat($pegawai['pendidikan_terakhir']);

		if ($pegawai['iterasi'] == 4 && $pangkat[0] . $pangkat[1] != $batas) {
			if ($pangkat[1] == 4)
				$pegawai['gol_ruang_masa_kerja'] = ++$pangkat[0] . '/I/' . (intval($pangkat[2]) - 2);
			elseif ($pangkat[0] == 'A' && $pangkat[1] == 1 || $pangkat[0] == 'B' && $pangkat[1] == 1)
				$pegawai['gol_ruang_masa_kerja'] = $pangkat[0] . '/' . $this->numberToRoman(++$pangkat[1]) . '/' . (intval($pangkat[2]) - 2);
			else
				$pegawai['gol_ruang_masa_kerja'] = $pangkat[0] . '/' . $this->numberToRoman(++$pangkat[1]) . '/' . (intval($pangkat[2]) + 1);

			$pegawai['iterasi'] = 1;
		} else {
			$pegawai['gol_ruang_masa_kerja'] = $pangkat[0] . '/' . $this->numberToRoman($pangkat[1]) . '/' . ($pangkat[2] + 1);
			$pegawai['iterasi'] = intval($pegawai['iterasi']) + 1;
		}

		$this->pegawaiM->save($pegawai);
	}

	public function batasPangkat($pendidikanTerakhir)
	{
		if ($pendidikanTerakhir == 'SD atau Setingkat')
			return 'B1';
		elseif ($pendidikanTerakhir == 'SMP atau Setingkat')
			return 'B2';
		elseif ($pendidikanTerakhir == 'SMA atau Setingkat' || $pendidikanTerakhir == 'Diploma I  atau Setingkat' || $pendidikanTerakhir == 'Diploma II atau Setingkat')
			return 'C1';
		elseif ($pendidikanTerakhir == 'Sarjana Muda' || $pendidikanTerakhir == 'Akademi' || $pendidikanTerakhir == 'Diploma III')
			return 'C2';
		elseif ($pendidikanTerakhir == 'Diploma IV' || $pendidikanTerakhir == 'Sarjana (S1)')
			return 'D1';
		else
			return 'D2';
	}
}
