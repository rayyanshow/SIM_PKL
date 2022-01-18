<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function index()
	{
		$this->load->view('login');
	}
	
	// Controller Aksi Login
	public function CekLogin()
	{

		$user = $this->input->post('user');
		$pass = $this->input->post('pass');
		$dimanaSiswa = array(
			'user' => ($user),
			'pass' => md5($pass)
		);

		$dimana = array(
			'user' => $user,
			'pass' => $pass
		);

		$cekSiswa = $this->m_login->cekSiswa('tb_siswa', $dimanaSiswa)->num_rows();
		$cekAdmin = $this->m_login->cekAdmin('tb_admin', $dimana)->num_rows();
		$cekGuru = $this->m_login->cekGuru('tb_guru', $dimana)->num_rows();
		$cekIndustri = $this->m_login->cekIndustri('tb_tempat_rekomendasi', $dimana)->num_rows();
		if ($cekSiswa > 0) {
			$data_session = array(
				'user' => $user,
				'status' => 'siswa',
			);

			$this->session->set_userdata($data_session);
			$this->session->set_tempdata('login_siswa', 'Anda berhasil login sebagai siswa!', 1);
			redirect('siswa');
		} else if ($cekAdmin > 0) {
			$data_session = array(
				'nama' => $user,
				'status' => 'admin',
			);

			$this->session->set_userdata($data_session);
			$this->session->set_tempdata('login_admin', 'Anda berhasil login sebagai admin!', 1);
			redirect('admin');
		} else if ($cekGuru > 0) {
			$data_session = array(
				'guru' => $user,
				'status' => 'guru',
			);

			$this->session->set_userdata($data_session);
			$this->session->set_tempdata('login_guru', 'Anda berhasil login sebagai guru!', 0);
			redirect('guru');
		} else if ($cekIndustri > 0) {
			$data_session = array(
				'industri' => $user,
				'status' => 'industri',
			);

			$this->session->set_userdata($data_session);
			$this->session->set_tempdata('login_industri', 'Anda berhasil login sebagai industri!', 0);
			redirect('industri');
		}else {
			$this->session->set_tempdata('login_gagal', 'Maaf username atau password tidak terdaftar!');
			redirect('login');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}
