<?php

namespace App\Controllers;

use \Config\Services;

class ResetPassword extends BaseController
{
    public function index()
    {
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');

        $data['user'] = false;

        if ($email && $token) {
            $user = $this->userM->getUser($email);
            if ($user && time() - $this->request->getVar('date') < 60 * 60 && $token == $user['token']) {
                $this->session->set('email', $email);

                $data['user'] = true;
            } else $this->session->setFlashData('error', 'User Tidak Terdaftar/ Link tidak valid');
        }

        return view('reset-password', $data);
    }

    public function cek()
    {
        if ($this->request->getMethod(true) != 'POST')
            return redirect()->to('/reset-password');

        $email = $this->request->getVar('email');

        $user = $this->userM->getUser($email);

        if (!$user) {
            $this->session->setFlashData('error', 'User Tidak Terdaftar');

            return redirect()->to('/reset-password');
        }

        $config['mailType'] = 'html';
        $config['protocol'] = 'smtp';
        $config['SMTPHost'] = 'mail.jamalimages.com';
        $config['SMTPUser'] = 'inquiry@jamalimages.com';
        $config['SMTPPass'] = 'wv#rn&szh-l&';
        $config['SMTPPort'] = 465;
        $config['SMTPCrypto'] = 'ssl';

        $this->email = Services::email();
        $this->email->initialize($config);
        $this->email->setFrom('cs@bkkkotasemarang.co.id', 'BKK');
        $this->email->setTo($email);
        $this->email->setSubject('Reset Password');
        $token = bin2hex(random_bytes(64));

        $this->email->setMessage("Klik link disamping untuk Melakukan Reset Password : <a href='" . base_url() . "/reset-password?email=$email&token=$token&date=" . time() . "'>Aktivasi Akun</a>");

        if ($this->email->send()) {
            $user['token'] = $token;
            $this->userM->save($user);

            $this->session->setFlashData('success', 'Silahkan Cek Email Untuk Melakukan Reset Password');

            return redirect()->to('/reset-password');
        }

        $this->session->setFlashData('error', $this->email->print_debugger());

        return redirect()->to('/reset-password');
    }

    public function reset()
    {
        if (!$this->request->getMethod(true) == 'POST') {
            return redirect()->to('/reset-password');
        }

        $passwordBaru = $this->request->getVar('password_baru');
        $KonfirmasiPassword = $this->request->getVar('konfirmasi_password');

        if ($passwordBaru == '' || $KonfirmasiPassword == '') {
            $output = [
                'error' => 'Form Belum Diisi',
                csrf_token() => csrf_hash()
            ];

            return $this->response->setJSON($output);
        }

        if ($passwordBaru != $KonfirmasiPassword) {
            $output = [
                'error' => 'Konformasi Password Tidak Sama',
                csrf_token() => csrf_hash()
            ];

            return $this->response->setJSON($output);
        }

        if (!preg_match('/(?=.{8,}$)([A-Za-z].*[0-9]|[0-9].*[A-Za-z])/', $passwordBaru) || strlen(($passwordBaru) < 8)) {
            $output = [
                'error' => 'Password Minimal 8 Karakter dengan Huruf dan Angka',
                csrf_token() => csrf_hash()
            ];

            return $this->response->setJSON($output);
        }

        $email = $this->session->get('email');
        $user = $this->userM->getUser($email);

        $user['password'] = password_hash(md5($this->request->getVar('password_baru')), PASSWORD_DEFAULT);
        $user['token'] = '';

        $this->userM->save($user);

        $this->session->remove('email');
        $this->session->setFlashData('success', 'Password Berhasil Diperbarui');

        $output = [
            'error' => '',
            csrf_token() => csrf_hash()
        ];

        return $this->response->setJSON($output);
    }
}
