<?php

namespace App\Controllers;

use \Config\Services;

class Login extends BaseController
{
	public function index()
	{
		if (session('email')) {
			return redirect()->to('/pegawai');
		}

		return view('login');
	}

	public function cek()
	{
		$email = $this->request->getVar('email');
		$password = $this->request->getVar('password');

		if ($email != "" && $password != "") {
			$user = $this->userM->getUser($email);
			if ($user) {
				if (password_verify(md5($password), $user['password'])) {
					$this->session->set([
						'email'  => $email,
						'role'      => $user['role']
					]);

					if ($user['role'] == 'Admin')
						return redirect()->to('/admin');
					else
						return redirect()->to('/pegawai');
				} else {
					session()->setFlashdata('pesan', 'Password anda salah');
					return redirect()->to('/login')->withInput();
				}
			} else {
				session()->setFlashdata('pesan', 'User tidak terdaftar');
				return redirect()->to('/login');
			}
		} else {
			session()->setFlashdata('pesan', 'Form login belum diisi');
			return redirect()->to('/login')->withInput();
		}
	}

	public function gantiPassword()
	{
		$email = $this->session->get('email');

		if ($this->request->getMethod(true) != 'POST' || !$email) {
			return redirect()->to('/login');
		}

		if (!$this->validate([
			'password_lama' => [
				'rules'     => 'required',
				'errors'    => [
					'required'  =>  'Bagian ini harus diisi'
				]
			],
			'password_baru'	=> [
				'rules'     => 'required|min_length[8]',
				'errors'    => [
					'required'  =>  'Bagian ini harus diisi',
					'min_length' =>  'Password minimal 8 karakter dengan huruf dan angka'
				]
			],
			'konfirmasi_password'                 => [
				'rules'     => 'required|matches[password_baru]',
				'errors'    => [
					'required'  =>  'Bagian ini harus diisi',
					'matches' => 'Password baru dan konfirmasi tidak sama'
				]
			]
		])) {
			$error = Services::validation()->getErrors();

			$output = [
				'error' => $error,
				csrf_token() => csrf_hash()
			];

			return $this->response->setJSON($output);
		}

		$passwordLama = $this->request->getVar('password_lama');
		$passwordBaru = $this->request->getVar('password_baru');
		$error = [];

		$user = $this->userM->getUser($email);
		if (password_verify(md5($passwordLama), $user['password'])) {
			if (preg_match('/(?=.{8,}$)([A-Za-z].*[0-9]|[0-9].*[A-Za-z])/', $passwordBaru)) {
				$this->userM->save([
					'id_user' => $user['id_user'],
					'password' => password_hash(md5($passwordBaru), PASSWORD_DEFAULT)
				]);
			} else
				$error = ['password_baru' => 'Password Minimal 8 Karakter dengan Huruf dan Angka'];
		} else
			$error = ['password_lama' => 'Password yang anda masukkan salah'];

		$output = [
			'error' => $error,
			csrf_token() => csrf_hash()
		];

		return $this->response->setJSON($output);
	}

	public function logout()
	{
		session_destroy();
		return redirect()->to('/login');
	}
}
