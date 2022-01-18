<?php

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != "admin") {
			redirect(base_url("login"));
		}
	}

	public function index()
	{
		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/content');
	}

	// START FUNCTION daftarSiswaPKL

	public function daftarSiswa($offset = 0)
	{

		$query = $this->input->post('cari');

		$kepo = $this->db->get('tb_siswa');
		$config['total_rows'] = $kepo->num_rows();
		$config['base_url'] = base_url() . 'admin/daftarSiswa';
		$config['per_page'] = 5;

		$config['first_link']       = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link']        = '<i class="fa fa-angle-double-right"></i>';
		$config['next_link']        = '<i class="fa fa-angle-right"></i>
        <span class="sr-only">Next</span>';
		$config['prev_link']        = '<i class="fa fa-angle-left"></i>
        <span class="sr-only">Previous</span>';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$data['offset'] = $offset;


		$data['siswa'] = $this->m_admin->ambil_cari($query, $config['per_page'], $offset);

		// $data['siswa'] = $this->m_admin->allSiswa();

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/daftar-siswa/index', $data);
	}

	public function chat()
	{
		$data['chat_siswa'] 	= $this->db->query("SELECT DISTINCT id_siswa FROM tb_tampung ORDER BY id DESC ")->result();
		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/pesan/index', $data);
	}

	public function cekPesan($id)
	{
		$dimana = array('id_siswa' => $id);
		$this->db->delete('tb_tampung', $dimana);
		$data['cek']			= $this->db->query("SELECT * FROM tb_chat WHERE id_siswa = '$id' ")->result();
		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/pesan/cek', $data);
	}

	public function balesChat()
	{
		$pesan 			= $this->input->post('pesan');
		$id				= $this->input->post('id');
		$kepada			= $this->input->post('kepada');

		$data			= array(
			'kepada'	=> $kepada,
			'pesan'		=> $pesan,
			'id_siswa'	=> $id
		);
		$data2			= array(
			'pesan'		=> 'kamu memiliki pesan baru',
			'id_siswa'	=> $id
		);
		$this->m_admin->tambahPesan('tb_notif', $data2);
		$this->m_admin->tambahPesan('tb_chat', $data);
		redirect(base_url('admin/cekPesan/') . $id . '?id=' . $id);
	}

	public function tambahSiswa()
	{

		$data['jurusan'] = $this->m_admin->jurusan('tb_jurusan');
		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/daftar-siswa/tambah', $data);
	}

	public function doTambahSiswa()
	{
		$config['upload_path'] 			= './assets/uploads/profile-siswa';
		$config['allowed_types']        = 'jpg|jpeg|png|gif';
		$config['max_size']             = 0;
		$config['max_width']            = 0;
		$config['max_height']           = 0;

		$this->load->library('upload', $config);
		if ($this->upload->do_upload('foto')) {
			$nis 		= $this->input->post('nis');
			$nama 		= $this->input->post('nama');
			$kelas 		= $this->input->post('kelas');
			$jurusan 	= $this->input->post('jurusan');
			$user 		= $this->input->post('user');
			$pass 		= $this->input->post('pass');
			$upload 	= $this->upload->data();
			$jk 		= $this->input->post('jk');
			$foto 		= $this->input->post('foto');

			$check_nis = array('nis' => $nis);

			$data_siswa = $this->m_admin->siswaTer('tb_siswa', $check_nis)->result();
			$jml_siswa = count($data_siswa);

			if ($jml_siswa > 0) {
				$session_siswa = array(
					'error'=> "NIS Sudah Ada",
					'nis_siswa' => $nis,
					'nama_siswa' => $nama
				);
				$this->session->set_flashdata($session_siswa);

				redirect('admin/tambahSiswa');
			}else{
			$data = array(
				'nis' 			=> $nis,
				'nama_siswa' 	=> $nama,
				'kelas' 		=> $kelas,
				'jurusan' 		=> $jurusan,
				'user' 			=> $user,
				'pass' 			=> md5($pass),
				'foto' 			=> $upload['file_name'],
				'jk' 			=> $jk
			);


			$this->m_admin->tambahSiswa('tb_siswa', $data);
			$this->session->set_tempdata('tambah_siswa', 'Siswa Berhasil Di tambah', 0);
			redirect('admin/daftarSiswa');
		}
		} else {
			$nis 		= $this->input->post('nis');
			$nama 		= $this->input->post('nama');
			$kelas 		= $this->input->post('kelas');
			$jurusan 	= $this->input->post('jurusan');
			$user 		= $this->input->post('user');
			$pass 		= $this->input->post('pass');
			$upload 	= $this->upload->data();
			$jk 		= $this->input->post('jk');
			$foto 		= $this->input->post('foto');

			$check_nis = array('nis' => $nis);

			$data_siswa = $this->m_admin->siswaTer('tb_siswa', $check_nis)->result();
			$jml_siswa = count($data_siswa);

			if ($jml_siswa > 0) {
				$session_siswa = array(
					'error'=> "NIS Sudah Ada",
					'nis_siswa' => $nis,
					'nama_siswa' => $nama
				);
				$this->session->set_flashdata($session_siswa);

				redirect('admin/tambahSiswa');
			}else{
				$data = array(
					'nis' 			=> $nis,
					'nama_siswa' 	=> $nama,
					'kelas' 		=> $kelas,
					'jurusan' 		=> $jurusan,
					'user' 			=> $user,
					'pass' 			=> md5($pass),
					'foto' 			=> "man.png",
					'jk' 			=> $jk
				);
	
				$this->m_admin->tambahSiswa('tb_siswa', $data);
				$this->session->set_tempdata('tambah_siswa', 'Siswa Berhasil Di tambah', 0);
				redirect('admin/daftarSiswa');
			}
		}
	}

	public function editSiswa($id)
	{
		$dimana = array('id_siswa' => $id);
		$data['data_siswa'] = $this->m_admin->siswaTer('tb_siswa', $dimana)->result();
		$data['jurusan'] = $this->m_admin->jurusan('tb_jurusan');

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/daftar-siswa/update', $data);
	}

	public function updateSiswa()
	{
		$config['upload_path'] = './assets/uploads/profile-siswa';
		$config['allowed_types']        = 'jpg|jpeg|png|gif';
		$config['max_size']             = 100;
		$config['max_width']            = 0;
		$config['max_height']           = 0;

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('foto')) {
			$id = $this->input->post('id');
			$dimana = array('id_siswa' => $id);
			$nama = $this->input->post('nama');
			$jurusan = $this->input->post('jurusan');
			$user = $this->input->post('user');
			$pass = $this->input->post('pass');
			$kelas = $this->input->post('kelas');
			$nis = $this->input->post('nis');
			$jk = $this->input->post('jk');
			$foto = $this->input->post('gambar');

			$data = array(
				'nis' => $nis,
				'nama_siswa' => $nama,
				'kelas' => $kelas,
				'jurusan' => $jurusan,
				'jk' => $jk,
				'user' => $user,
				'pass' => $pass,
				'foto' => $foto
			);

			$this->m_admin->updateSiswa($data, $dimana);
			$this->session->set_tempdata('update_siswa', 'Data Berhasil Di Update!', 0);
			redirect('admin/daftarSiswa');
		} else {
			$id = $this->input->post('id');
			$dimana = array('id_siswa' => $id);
			$nama = $this->input->post('nama');
			$jurusan = $this->input->post('jurusan');
			$user = $this->input->post('user');
			$pass = $this->input->post('pass');
			$kelas = $this->input->post('kelas');
			$nis = $this->input->post('nis');
			$jk = $this->input->post('jk');
			$foto = $this->input->post('gambar');
			$upload = $this->upload->data();

			$data = array(
				'nis' => $nis,
				'nama_siswa' => $nama,
				'kelas' => $kelas,
				'jurusan' => $jurusan,
				'jk' => $jk,
				'user' => $user,
				'pass' => $pass,
				'foto' => $upload['file_name']
			);

			$this->m_admin->updateSiswa($data, $dimana);
			$this->session->set_tempdata('update_siswa', 'Data Berhasil Di Update!', 0);
			redirect('admin/daftarSiswa');
		}
	}

	public function deleteSiswa($id)
	{
		$dimana = array("id_siswa" => $id);
		$this->m_admin->deleteSiswa($dimana);
		$this->session->set_tempdata('delete_siswa', 'Data Berhasil Di Hapus!', 0);
		redirect('admin/daftarSiswa');
	}

	// START FUNCTION TEMPAT PKL SISWA

	public function tempatSiswa($offset = 0)
	{
		$query = $this->input->post('cari');

		$kepo = $this->db->get('tb_tempat_siswa');
		$config['total_rows'] = $kepo->num_rows();
		$config['base_url'] = base_url() . 'admin/tempatSiswa';
		$config['per_page'] = 5;

		$config['first_link']       = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link']        = '<i class="fa fa-angle-double-right"></i>';
		$config['next_link']        = '<i class="fa fa-angle-right"></i>
        <span class="sr-only">Next</span>';
		$config['prev_link']        = '<i class="fa fa-angle-left"></i>
        <span class="sr-only">Previous</span>';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$data['offset'] = $offset;

		$data['tempat_siswa'] = $this->m_admin->allTempat($query, $config['per_page'], $offset)->result();

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/tempat-siswa/index', $data);
	}

	public function editTempat($id)
	{

		$data['tempat_siswa'] = $this->m_admin->ambil_tempat($id)->result();

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/tempat-siswa/update', $data);
	}

	public function updateTempat()
	{
		$id = $this->input->post('id');
		$dimana = array('id' => $id);
		$perusahaan = $this->input->post('perusahaan');
		$cp = $this->input->post('cp');
		$alamat = $this->input->post('alamat');

		$data = array(
			'nama_perusahaan' => $perusahaan,
			'alamat' => $alamat,
			'cp' => $cp
		);

		$this->m_admin->updateTempat($dimana, $data);
		$this->session->set_tempdata('update_tempat', 'Data Berhasil Di Update!', 0);
		redirect('admin/tempatSiswa');
	}

	public function deleteTempat($id)
	{
		$dimana = array('id_siswa' => $id);
		$this->m_admin->deleteTempat($dimana);
		redirect('admin/tempatSiswa');
	}

	// START FUNCTION BERKAS PKL 

	public function daftarBerkas($offset = 0)
	{
		$query = $this->input->post('cari');

		$kepo = $this->db->get('tb_berkas');
		$config['total_rows'] = $kepo->num_rows();
		$config['base_url'] = base_url() . 'admin/daftarBerkas';
		$config['per_page'] = 5;

		$config['first_link']       = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link']        = '<i class="fa fa-angle-double-right"></i>';
		$config['next_link']        = '<i class="fa fa-angle-right"></i>
        <span class="sr-only">Next</span>';
		$config['prev_link']        = '<i class="fa fa-angle-left"></i>
        <span class="sr-only">Previous</span>';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$data['offset'] = $offset;

		$data['berkas'] = $this->m_admin->allBerkas($query, $config['per_page'], $offset)->result();

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/berkas/index', $data);
	}

	public function tambahBerkas()
	{
		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/berkas/tambah');
	}

	public function doTambahBerkas()
	{
		$config['upload_path']    = './assets/uploads/berkas-prakerin';
		$config['allowed_types']  = 'doc|docx|pdf|txt';
		$config['max_size']       = 0;

		$this->load->library('upload', $config);
		if ($this->upload->do_upload('berkas')) {
			$nama = $this->input->post('nama');
			$berkas = $this->upload->data();
			$data = array(
				'nama_berkas' => $nama,
				'file_berkas' => $berkas['file_name']
			);
			$this->m_admin->tambahBerkas($data);
			$this->session->set_tempdata('tambah_berkas', 'Berkas Berhasil di tambah!', 0);
			$this->load->view('admin/sidebar');
			redirect('admin/daftarBerkas');
		} else {
			$this->session->set_tempdata('gagal_berkas', 'Tipe Berkas File tidak di dukung!', 0);
			redirect('admin/daftarBerkas');
		}
	}

	public function editBerkas($id)
	{
		$dimana = array('id_berkas' => $id);
		$data['ambil_berkas'] = $this->m_admin->ambil_berkas($dimana);

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/berkas/update', $data);
	}

	public function updateBerkas()
	{
		$config['upload_path']    = './assets/uploads/berkas-prakerin';
		$config['allowed_types']  = 'doc|docx|pdf|txt';
		$config['max_size']       = 0;

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('berkas')) {
			$id = $this->input->post('id');

			$dimana = array('id_berkas' => $id);
			$nama = $this->input->post('nama');
			$berkas = $this->input->post('hmm');

			$data = array(
				'nama_berkas' => $nama,
				'file_berkas' => $berkas
			);

			$this->m_admin->updateBerkas($dimana, $data);
			$this->session->set_tempdata('update_berkas', 'Berkas Berhasil di Update!', 0);
			redirect('admin/daftarBerkas');
		} else {
			$id = $this->input->post('id');

			$dimana = array('id_berkas' => $id);
			$nama = $this->input->post('nama');
			$berkas = $this->upload->data();

			$data = array(
				'nama_berkas' => $nama,
				'file_berkas' => $berkas['file_name']
			);

			$this->m_admin->updateBerkas($dimana, $data);
			$this->session->set_tempdata('update_berkas', 'Berkas Berhasil di Update!', 0);
			redirect('admin/daftarBerkas');
		}
	}

	public function deleteBerkas($id)
	{

		$dimana = array('id_berkas' => $id);
		$this->m_admin->deleteBerkas('tb_berkas', $dimana);
		$this->session->set_tempdata('delete_berkas', 'Berkas Berhasil di Hapus!', 0);
		redirect('admin/daftarBerkas');
	}
	// START FUNCTION TEMPAT REKOMENDASI

	public function tempatRekomendasi($offset = 0)
	{
		$kepo = $this->db->get('tb_tempat_rekomendasi');
		$config['total_rows'] = $kepo->num_rows();
		$config['base_url'] = base_url() . 'admin/tempatRekomendasi';
		$config['per_page'] = 5;

		$config['first_link']       = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link']        = '<i class="fa fa-angle-double-right"></i>';
		$config['next_link']        = '<i class="fa fa-angle-right"></i>
        <span class="sr-only">Next</span>';
		$config['prev_link']        = '<i class="fa fa-angle-left"></i>
        <span class="sr-only">Previous</span>';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$data['offset'] = $offset;

		$query = $this->input->post('cari');
		$data['rekomendasi'] = $this->m_admin->allRekomendasi($query, $config['per_page'], $offset);

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/tempat-rekomendasi/index', $data);
	}

	public function tambahRekomendasi()
	{

		$data['jurusan'] = $this->m_admin->jurusan('tb_jurusan');

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/tempat-rekomendasi/tambah', $data);
	}

	public function doTambahRekomendasi()
	{

		$config['upload_path']   = './assets/uploads/tempat-rekomendasi';
		$config['allowed_types'] = 'jpg|png|jpeg|gif';
		$config['max_size']      = 0;
		$config['max_height']    = 0;
		$config['max_width']     = 0;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('foto')) {
			$perusahaan = $this->input->post('perusahaan');
			$jurusan    = $this->input->post('jurusan');
			$alamat     = $this->input->post('alamat');
			$cp         = $this->input->post('cp');
			$foto       = $this->upload->data();
			$visi		= $this->input->post('visi');
			$misi		= $this->input->post('misi');
			$user		= $this->input->post('user');
			$pass		= $this->input->post('pass');
			$jumlah     = implode(", ", $jurusan);
			$nama_pimpinan	= $this->input->post('pimpinan');


			$data = array(
				'nama_perusahaan' => $perusahaan,
				'jurusan_perusahaan' => $jumlah,
				'alamat'  => $alamat,
				'foto'    => $foto['file_name'],
				'cp'      => $cp,
				'misi'	  => $misi,
				'visi'	  => $visi,
				'user'	  => $user,
				'pass'	  => $pass,
				'nama_pimpinan' => $nama_pimpinan
			);



			$this->m_admin->tambahRekomendasi('tb_tempat_rekomendasi', $data);

			$this->session->set_tempdata('tambah_rekomendasi', 'Data berhasil di tambah!', 0);

			redirect('admin/tempatRekomendasi');
		}
	}

	public function updateRekomendasi($id)
	{
		$dimana = array('id_rekomendasi' => $id);
		$data['jurusan'] = $this->m_admin->jurusan('tb_jurusan');
		$data['ambil_rekomendasi'] = $this->m_admin->ambil_rekomendasi($dimana);

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/tempat-rekomendasi/update', $data);
	}

	public function doUpdateRekomendasi()
	{
		$config['upload_path']   = './assets/uploads/tempat-rekomendasi';
		$config['allowed_types'] = 'jpg|png|jpeg|gif';
		$config['max_size']      = 0;
		$config['max_height']    = 0;
		$config['max_width']     = 0;

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('foto')) {
			$id 		= $this->input->post('id');
			$perusahaan = $this->input->post('perusahaan');
			$jurusan 	= $this->input->post('jurusan');
			$alamat 	= $this->input->post('alamat');
			$cp 		= $this->input->post('cp');
			$foto 		= $this->input->post('gambar');
			$visi		= $this->input->post('visi');
			$misi		= $this->input->post('misi');
			$user		= $this->input->post('user');
			$pass		= $this->input->post('pass');
			$nama_pimpinan	= $this->input->post('pimpinan');
			$jumlah 	= implode(", ", $jurusan);

			if ($jumlah == "") {
				$data = array(
					'nama_perusahaan' => $perusahaan,
					'alamat' => $alamat,
					'cp' => $cp,
					'jurusan_perusahaan' => $jurusan,
					'foto' => $foto,
					'misi'	  => $misi,
					'visi'	  => $visi,
					'user'	  => $user,
					'pass'	  => $pass,
					'nama_pimpinan' => $nama_pimpinan
				);
			} else {
				$data = array(
					'nama_perusahaan' => $perusahaan,
					'alamat' => $alamat,
					'cp' => $cp,
					'jurusan_perusahaan' => $jumlah,
					'foto' => $foto,
					'misi'	  => $misi,
					'visi'	  => $visi,
					'user'	  => $user,
					'pass'	  => $pass,
					'nama_pimpinan' => $nama_pimpinan
				);
			}
			$dimana = array('id_rekomendasi' => $id);

			$this->m_admin->updateRekomendasi($dimana, $data);
			$this->session->set_tempdata('update_rekomendasi', 'Data Berhasil di Update!', 0);
			redirect('admin/tempatRekomendasi');
		} else {
			$id = $this->input->post('id');
			$perusahaan = $this->input->post('perusahaan');
			$jurusan = $this->input->post('jurusan');
			$alamat = $this->input->post('alamat');
			$cp = $this->input->post('cp');
			$foto = $this->upload->data();
			$jumlah 	= implode(", ", $jurusan);
			$visi		= $this->input->post('visi');
			$misi		= $this->input->post('misi');
			$user		= $this->input->post('user');
			$pass		= $this->input->post('pass');
			$nama_pimpinan	= $this->input->post('pimpinan');

			if ($jumlah == "") {
				$data = array(
					'nama_perusahaan' => $perusahaan,
					'alamat' => $alamat,
					'cp' => $cp,
					'jurusan_perusahaan' => $jurusan,
					'foto' => $foto,
					'misi'	  => $misi,
					'visi'	  => $visi,
					'user'	  => $user,
					'pass'	  => $pass,
					'nama_pimpinan' => $nama_pimpinan

				);
			} else {
				$data = array(
					'nama_perusahaan' => $perusahaan,
					'alamat' => $alamat,
					'cp' => $cp,
					'jurusan_perusahaan' => $jumlah,
					'foto' => $foto,
					'misi'	  => $misi,
					'visi'	  => $visi,
					'user'	  => $user,
					'pass'	  => $pass,
					'nama_pimpinan' => $nama_pimpinan
				);
			}
			$dimana = array('id_rekomendasi' => $id);

			$this->m_admin->updateRekomendasi($dimana, $data);
			$this->session->set_tempdata('update_rekomendasi', 'Data Berhasil di Update!', 0);
			redirect('admin/tempatRekomendasi');
		}
	}

	public function deleteRekomendasi($id)
	{
		$dimana = array('id_rekomendasi' => $id);
		$this->m_admin->deleteRekomendasi('tb_tempat_rekomendasi', $dimana);
		$this->session->set_tempdata('delete_rekomendasi', 'Data Berhasil di Hapus!', 0);
		redirect('admin/tempatRekomendasi');
	}
	// START FUNCTION JURUSAN

	public function jurusan($offset = 0)
	{
		$kepo = $this->db->get('tb_jurusan');
		$config['total_rows'] = $kepo->num_rows();
		$config['base_url'] = base_url() . 'admin/jurusan';
		$config['per_page'] = 5;

		$config['first_link']       = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link']        = '<i class="fa fa-angle-double-right"></i>';
		$config['next_link']        = '<i class="fa fa-angle-right"></i>
        <span class="sr-only">Next</span>';
		$config['prev_link']        = '<i class="fa fa-angle-left"></i>
        <span class="sr-only">Previous</span>';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$data['offset'] = $offset;
		$data['jurusan'] = $this->m_admin->allJurusan('tb_jurusan', $config['per_page'], $offset);

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/jurusan/index', $data);
	}

	public function tambahJurusan()
	{


		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/jurusan/tambah');
	}

	public function doTambahJurusan()
	{
		$singkat = $this->input->post('singkat');
		$panjang = $this->input->post('panjang');
		$data = array(
			'nama_singkat' => $singkat,
			'nama_panjang' => $panjang
		);
		$this->m_admin->tambahJurusan($data);
		$this->session->set_tempdata('tambah_jurusan', 'Data Berhasil di Tambah!', 0);
		redirect('admin/jurusan');
	}

	public function editJurusan($id)
	{
		$dimana = array('id_jurusan' => $id);

		$data['ambil_jurusan'] = $this->m_admin->ambil_jurusan($dimana)->result();

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/jurusan/update', $data);
	}

	public function updateJurusan()
	{
		$id = $this->input->post('id');
		$singkat = $this->input->post('singkat');
		$panjang = $this->input->post('panjang');
		$dimana = array('id_jurusan' => $id);
		$data = array(
			'nama_singkat' => $singkat,
			'nama_panjang' => $panjang
		);
		$this->m_admin->updateJurusan($dimana, $data);
		$this->session->set_tempdata('update_jurusan', 'Data Berhasil di Update!', 0);
		redirect('admin/jurusan');
	}

	public function deleteJurusan($id)
	{
		$dimana = array('id_jurusan' => $id);
		$this->m_admin->deleteJurusan($dimana);
		$this->session->set_tempdata('delete_jurusan', 'Data Berhasil di Hapus!', 0);
		redirect('admin/jurusan');
	}

	// START FUNCTION NOTIF

	public function notif($offset = 0)
	{
		$kepo = $this->db->get('tb_sementara');
		$config['total_rows'] = $kepo->num_rows();
		$config['base_url'] = base_url() . 'admin/notif';
		$config['per_page'] = 5;

		$config['first_link']       = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link']        = '<i class="fa fa-angle-double-right"></i>';
		$config['next_link']        = '<i class="fa fa-angle-right"></i>
        <span class="sr-only">Next</span>';
		$config['prev_link']        = '<i class="fa fa-angle-left"></i>
        <span class="sr-only">Previous</span>';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$data['offset'] = $offset;

		$data['notif']	= $this->m_admin->allNotif($config['per_page'], $offset)->result();
		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/notif/index', $data);
	}
	// FUNCTION UNDUH 
	public function unduh($bukti)
	{
		force_download('assets/uploads/daftar-rekomendasi/' . $bukti, NULL);
	}

	public function tolakRekomen($id)
	{
		$dimana = array('id' => $id);
		$data['pesan'] = $this->m_admin->ambilPesan($dimana)->result();

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/notif/pesan', $data);
	}
	public function masukPesan()
	{
		$perusahaan = $this->input->post('perusahaan');
		$siswa		= $this->input->post('siswa');
		$pesan		= $this->input->post('pesan');
		$id			= $this->input->post('id');
		$dimana		= array('id' => $id);
		$data 		= array(
			'nama_perusahaan' 	=> $perusahaan,
			'id_siswa'			=> $siswa,
			'pesan'				=> $pesan
		);

		$this->m_admin->kirimPesan($data);
		$this->db->delete('tb_sementara', $dimana);
		$this->session->set_tempdata('kirim_pesan', 'Pesan anda telah di kirim ke siswa!', 0);
		redirect('admin/notif');
	}

	public function taOke($id)
	{
		$dimana 		= array('id_siswa' => $id);
		$data['oke']	= $this->m_siswa->get_satu('tb_sementara', $dimana);

		$this->load->view('admin/index');
		$this->load->view('admin/oke/index', $data);
		$this->load->view('admin/sidebar');
	}

	public function pklOke($id)
	{
		$dimana 		= array('id_siswa' => $id);
		$data 			= array('status_pkl' => 1);

		$this->m_admin->updateStatusPKL($data, $dimana);

		$this->session->set_tempdata('oke', 'PKL telah berhasil divalidasi!', 0);
		redirect('admin/notif');
	}

	public function oke($id)
	{
		$oke 		= $this->db->query("SELECT * FROM tb_sementara WHERE id = '$id' ");
		$pecah 		= $oke->row();
		$perusahaan = $pecah->nama_perusahaan;
		$pimpinan	= $pecah->pimpinan;
		$pembimbing	= $pecah->pembimbing;
		$alamat		= $pecah->alamat;
		$cp			= $pecah->cp;
		$id_siswa	= $pecah->id_siswa;

		$data 		= array(
			'nama_perusahaan' 	=> $perusahaan,
			'nama_pimpinan'		=> $pimpinan,
			'nama_pembimbing'	=> $pembimbing,
			'alamat'			=> $alamat,
			'cp'				=> $cp,
			'id_siswa'			=> $id
		);

		$this->db->insert('tb_notif');
		$this->db->insert('tb_tempat_siswa', $data);
		redirect('admin/notif');
	}

	public function cus()
	{
		$perusahaan		= $this->input->post('perusahaan');
		$pimpinan		= $this->input->post('pimpinan');
		$pembimbing		= $this->input->post('pembimbing');
		$alamat			= $this->input->post('alamat');
		$cp				= $this->input->post('cp');
		$id				= $this->input->post('id');

		$data = array(
			'nama_perusahaan' 	=> $perusahaan,
			'nama_pimpinan'		=> $pimpinan,
			'nama_pembimbing'		=> $pembimbing,
			'alamat'			=> $alamat,
			'cp'				=> $cp,
			'id_siswa'			=> $id
		);
		$kepo = array(
			'nama_perusahaan'	=> $perusahaan,
			'pesan'				=> 'Selamat tempat pkl anda telah terkonfirmasi!',
			'id_siswa'			=> $id
		);

		$dimana = array('id_siswa' => $id);

		$this->m_siswa->tambah('tb_notif', $kepo);
		$this->m_siswa->tambah('tb_tempat_siswa', $data);
		$this->db->delete('tb_sementara', $dimana);
		$this->session->set_tempdata('oke', 'Siswa telah di konfirmasi', 0);
		redirect('admin/notif');
	}

	// START FUNCTION ABSENSI

	public function absensi($offset = 0)
	{
		$kepo 				= $this->db->get('tb_tempat_siswa');
		$config['total_rows'] = $kepo->num_rows();
		$config['base_url'] = base_url() . 'admin/absensi';
		$config['per_page'] = 3;

		$config['first_link']       = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link']        = '<i class="fa fa-angle-double-right"></i>';
		$config['next_link']        = '<i class="fa fa-angle-right"></i>
		<span class="sr-only">Next</span>';
		$config['prev_link']        = '<i class="fa fa-angle-left"></i>
		<span class="sr-only">Previous</span>';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$data['offset']  = $offset;
		$perPage		 = $config['per_page'];
		$data['manual']  = $this->db->query("SELECT * FROM tb_tempat_siswa INNER JOIN tb_siswa ON tb_tempat_siswa.id_siswa = tb_siswa.id_siswa INNER JOIN tb_tempat_rekomendasi ON tb_tempat_siswa.id_rekomendasi = tb_tempat_rekomendasi.id_rekomendasi ORDER BY jurusan ASC LIMIT $offset, $perPage ")->result();
		$data['jurusan'] = $this->m_admin->jur('tb_jurusan')->result();
		$data['siswa']   = $this->db->select('*')->from('tb_absensi')->group_by('siswa')->get()->result();
		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/absensi/index', $data);
	}



	public function cariAbsen()
	{
		$jurusan			= $this->input->post('jurusan');
		$siswa 			    = $this->input->post('siswa');
		$dimana				= array('jurusan' => $jurusan);


		$siswa			 = $this->input->post('siswa');

		$data['jurusan'] = $this->m_admin->jur('tb_jurusan')->result();
		$data['absen'] 	 = $this->m_admin->cariBed('tb_absensi', $dimana);
		$data['siswa']	 = $this->m_admin->disiswa($jurusan)->result();
		$data['akhir']	 = $this->m_admin->akhirAbsenAdmin($siswa, $jurusan);


		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/absensi/index', $data);
	}

	public function cetakAbsenKelas($jurusan)
	{
		$data = array('jurusan' => $jurusan);
		$this->load->library('mypdf');
		$data['cetak'] = $this->m_admin->showCetakNilai($data);

		$this->mypdf->generate('laporan_pdf', $data);
	}

	public function absenManual($nis)
	{
		$data['manu']	= $this->db->query("SELECT * FROM tb_tempat_siswa INNER JOIN tb_siswa ON tb_tempat_siswa.id_siswa = tb_siswa.id_siswa INNER JOIN tb_tempat_rekomendasi ON tb_tempat_siswa.id_rekomendasi = tb_tempat_rekomendasi.id_rekomendasi WHERE nis = '$nis' ")->result();
		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/absensi/manual', $data);
	}

	public function inputAbsensi()
	{
		$id					= $this->input->post('id');
		$tahun				= $this->input->post('tahun');
		$bulan				= $this->input->post('bulan');
		$masuk				= $this->input->post('masuk');
		$ijin				= $this->input->post('ijin');
		$sakit				= $this->input->post('sakit');
		// CEK
		$query				= $this->db->query("SELECT * FROM tb_absensi_manual WHERE id_siswa = '$id' AND bulan = '$bulan' ");

		if ($query->num_rows() > 0) {
			$this->session->set_tempdata('bulan_sama', 'Maaf untuk bulan ini anda sudah menginputkan data!', 0);
			redirect('admin/absensi');
		} else {
			$data				= array(
				'id_siswa'		=> $id,
				'tahun'			=> $tahun,
				'bulan'			=> $bulan,
				'masuk'			=> $masuk,
				'ijin'			=> $ijin,
				'sakit'			=> $sakit
			);

			$this->db->insert('tb_absensi_manual', $data);
			$this->session->set_tempdata('input_absen', 'Data berhasil di tambah!', 0);
			redirect('admin/absensi');
		}
	}

	public function cekManual($nis)
	{
		$siswa				= $this->db->query("SELECT * FROM tb_siswa WHERE nis = '$nis' ")->row();
		$id					= $this->db->query("SELECT * FROM tb_tempat_siswa WHERE id_siswa = '$siswa->id_siswa' ")->row();
		$data['cek']		= $this->db->query("SELECT * FROM tb_tempat_siswa INNER JOIN tb_siswa ON tb_tempat_siswa.id_siswa = tb_siswa.id_siswa INNER JOIN tb_tempat_rekomendasi ON tb_tempat_siswa.id_rekomendasi = tb_tempat_rekomendasi.id_rekomendasi WHERE nis = '$nis' AND id = '$id->id'  ")->result();

		$data['absen']		= $this->db->query("SELECT * FROM tb_absensi_manual WHERE id_siswa = '$siswa->id_siswa' ")->result();

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/absensi/cek', $data);
	}

	public function editManual($id)
	{
		$siswa 				= $this->db->query("SELECT * FROM tb_siswa WHERE id_siswa = '$id' ")->row();
		$data['diri']		= $this->db->query("SELECT * FROM tb_tempat_siswa INNER JOIN tb_siswa ON tb_tempat_siswa.id_siswa = tb_siswa.id_siswa INNER JOIN tb_tempat_rekomendasi ON tb_tempat_siswa.id_rekomendasi = tb_tempat_rekomendasi.id_rekomendasi WHERE nis = '$siswa->nis' ")->result();


		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/absensi/ubah', $data);
	}

	public function ubahManual()
	{
		$id					= $this->input->post('id');
		$kepo				= $this->input->post('bulane');
		$bulan				= $this->input->post('bulan');
		$masuk				= $this->input->post('masuk');
		$ijin				= $this->input->post('ijin');
		$sakit				= $this->input->post('sakit');
		$dimana				= array('id_siswa'	=> $id, 'bulan' => $bulan);

		$data				= array(
			'bulan' 		=> $bulan,
			'masuk'			=> $masuk,
			'ijin'			=> $ijin,
			'sakit'			=> $sakit,

		);
		$cek				= $this->db->query("SELECT bulan FROM tb_absensi_manual WHERE id_siswa = '$id' AND bulan = '$bulan' ")->num_rows();
		if ($cek > 0) {
			$this->session->set_tempdata('gagal_ubah', 'Maaf bulan yang ingin anda ubah sudah ada datanya!', 0);
			redirect('admin/absensi');
		} else {

			$this->db->query("UPDATE tb_absensi_manual SET bulan = '$bulan', masuk = '$masuk', ijin = '$ijin', sakit = '$sakit' WHERE id_siswa = '$id' AND bulan = '$kepo' ");
			$this->session->set_tempdata('ubah_manu', 'Data berhasil di ubah!', 0);
			redirect('admin/absensi');
		}
	}

	// START FUNCTION GURU 

	public function daftarGuru($offset = 0)
	{
		$kepo 				= $this->db->get('tb_guru');
		$config['total_rows'] = $kepo->num_rows();
		$config['base_url'] = base_url() . 'admin/daftarGuru';
		$config['per_page'] = 5;

		$config['first_link']       = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link']        = '<i class="fa fa-angle-double-right"></i>';
		$config['next_link']        = '<i class="fa fa-angle-right"></i>
		<span class="sr-only">Next</span>';
		$config['prev_link']        = '<i class="fa fa-angle-left"></i>
		<span class="sr-only">Previous</span>';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$this->pagination->initialize($config);
		$key			 = $this->input->post('key');
		$data['halaman'] = $this->pagination->create_links();
		$data['offset']  = $offset;
		$data['guru']	 = $this->m_admin->getGuru($key, $config['per_page'], $offset);
		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/guru/index', $data);
	}

	public function tambahGuru()
	{
		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/guru/tambah');
	}

	public function addGuru()
	{
		$nama	= $this->input->post('nama');
		$user	= $this->input->post('user');
		$pass	= $this->input->post('pass');

		$data	= array(
			'nama'	=> $nama,
			'user'	=> $user,
			'pass'	=> $pass
		);

		$this->m_admin->addGuru($data);
		$this->session->set_tempdata('tambah_guru', 'Guru Berhasil di tambah!', 0);
		redirect('admin/daftarGuru');
	}

	public function updateGuru($id)
	{
		$dimana				= array('id_guru' => $id);

		$data['update'] 	= $this->m_admin->satu_guru($dimana);

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/guru/update', $data);
	}

	public function doUpdateGuru()
	{
		$id		= $this->input->post('id');
		$nama	= $this->input->post('nama');
		$user	= $this->input->post('user');
		$pass	= $this->input->post('pass');

		$dimana = array('id_guru' => $id);
		$data	= array(
			'nama'	=> $nama,
			'user'	=> $user,
			'pass'	=> $pass,
		);
		$this->m_admin->updateGuru($dimana, $data);
		$this->session->set_tempdata('update_guru', 'Data guru berhasil di update!', 0);
		redirect('admin/daftarGuru');
	}

	public function deleteGuru($id)
	{
		$dimana = array('id_guru' => $id);
		$this->db->delete('tb_guru', $dimana);
		$this->session->set_tempdata('delete_guru', 'Data Guru telah terhapus!', 0);
		redirect('admin/daftarGuru');
	}

	// START FUNCTION MONITORING

	public function monitoring($offset = 0)
	{
		$kepo 						= $this->db->get('tb_monitoring');
		$config['total_rows'] 		= $kepo->num_rows();
		$config['base_url'] 		= base_url() . 'admin/monitoring';
		$config['per_page'] 		= 5;

		$config['first_link']       = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link']        = '<i class="fa fa-angle-double-right"></i>';
		$config['next_link']        = '<i class="fa fa-angle-right"></i>
		<span class="sr-only">Next</span>';
		$config['prev_link']        = '<i class="fa fa-angle-left"></i>
		<span class="sr-only">Previous</span>';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$this->pagination->initialize($config);
		$key			 			= $this->input->post('key');
		$data['halaman'] 			= $this->pagination->create_links();
		$data['offset']  			= $offset;

		$data['monitoring'] 		= $this->m_admin->monitoring($key, $config['per_page'], $offset);

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/monitoring/index', $data);
	}

	public function pindah($id)
	{
		$data['pindah']		= $this->m_admin->pindah($id);
		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/monitoring/pindah', $data);
	}
	// START FUNCTION NILAI
	public function nilaiSiswa($offset = 0)
	{
		$kepo 						= $this->db->get('tb_nilai');
		$config['total_rows'] 		= $kepo->num_rows();
		$config['base_url'] 		= base_url() . 'admin/nilaiSiswa';
		$config['per_page'] 		= 5;

		$config['first_link']       = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link']        = '<i class="fa fa-angle-double-right"></i>';
		$config['next_link']        = '<i class="fa fa-angle-right"></i>
		<span class="sr-only">Next</span>';
		$config['prev_link']        = '<i class="fa fa-angle-left"></i>
		<span class="sr-only">Previous</span>';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$key			 			= $this->input->post('key');
		$data['nilai'] 				= $this->m_admin->nilai($key);
		$perPage					= $config['per_page'];
		$data['terpilih']			= $this->db->query("SELECT * FROM tb_nilai INNER JOIN tb_siswa ON tb_nilai.id_siswa = tb_siswa.id_siswa INNER JOIN tb_tempat_siswa ON tb_nilai.id_siswa = tb_tempat_siswa.id_siswa JOIN tb_tempat_rekomendasi ON tb_tempat_rekomendasi.id_rekomendasi = tb_tempat_siswa.id_rekomendasi LIMIT $offset, $perPage ")->result();
		$data['jmlTerpilih'] = $this->db->query("SELECT * FROM tb_nilai INNER JOIN tb_siswa ON tb_nilai.id_siswa = tb_siswa.id_siswa INNER JOIN tb_tempat_siswa ON tb_nilai.id_siswa = tb_tempat_siswa.id_siswa")->row();
		$this->pagination->initialize($config);
		$data['halaman'] 			= $this->pagination->create_links();
		$data['offset']  			= $offset;

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/nilai/index', $data);
	}

	public function inputNilai($nis)
	{
		$data['data']				= $this->db->query("SELECT * FROM tb_tempat_siswa INNER JOIN tb_siswa ON tb_tempat_siswa.id_siswa = tb_siswa.id_siswa WHERE nis = '$nis' ")->result();

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/nilai/input', $data);
	}

	public function tambahNilai()
	{
		$id 			= $this->input->post('id');
		$kerajinan		= $this->input->post('kera');
		$prestasi		= $this->input->post('prestasi');
		$disiplin		= $this->input->post('disiplin');
		$kerjasama		= $this->input->post('kerjasama');
		$inisiatif		= $this->input->post('inisiatif');
		$tanggung		= $this->input->post('tanggung');
		$ujian			= $this->input->post('ujian');

		$data			= array(
			'kerajinan' 		=> $kerajinan,
			'prestasi'			=> $prestasi,
			'disiplin'			=> $disiplin,
			'kerjasama'			=> $kerjasama,
			'inisiatif'			=> $inisiatif,
			'tanggung_jawab'	=> $tanggung,
			'ujian_prakerin'	=> $ujian,
			'id_siswa'			=> $id
		);

		$this->m_admin->tambahRekomendasi('tb_nilai', $data);
		$this->session->set_tempdata('input_nilai', 'Nilai Berhasil di Tambah!', 0);
		redirect('admin/nilaiSiswa');
	}

	public function editNilai($id)
	{
		$data['siswa'] = $this->m_admin->getSiswaById($id);
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$data['join'] = $this->m_admin->showJoinDataSiswa($id)->result();


		$this->form_validation->set_rules('kera', 'Kera', 'required');
		$this->form_validation->set_rules('prestasi', 'Prestasi', 'required');
		$this->form_validation->set_rules('disiplin', 'Disiplin', 'required');
		$this->form_validation->set_rules('kerjasama', 'Kerjasama', 'required');
		$this->form_validation->set_rules('inisiatif', 'Inisiatif', 'required');
		$this->form_validation->set_rules('tanggung', 'Tanggung Jawab', 'required');
		$this->form_validation->set_rules('ujian', 'Ujian', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin/index');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/nilai/edit', $data);
		} else {
			$this->m_admin->ubahDataNilaiSiswa();
			$this->session->set_tempdata('flash', 'Ditambahkan', 0);
			redirect('admin/nilaiSiswa');
		}
	}

	public function ubahNilai()
	{
		$id 			= $this->input->post('id');
		$kerajinan		= $this->input->post('kera');
		$prestasi		= $this->input->post('prestasi');
		$disiplin		= $this->input->post('disiplin');
		$kerjasama		= $this->input->post('kerjasama');
		$inisiatif		= $this->input->post('inisiatif');
		$tanggung		= $this->input->post('tanggung');
		$ujian			= $this->input->post('ujian');

		$dimana			= array('id_siswa' => $id);
		$data			= array(
			'kerajinan' 		=> $kerajinan,
			'prestasi'			=> $prestasi,
			'disiplin'			=> $disiplin,
			'kerjasama'			=> $kerjasama,
			'inisiatif'			=> $inisiatif,
			'tanggung_jawab'	=> $tanggung,
			'ujian_prakerin'	=> $ujian,
			'id_siswa'			=> $id
		);

		$this->m_admin->updateNilai($dimana, $data);
		$this->session->set_tempdata('ubah_nilai', 'Nilai Berhasil di Ubah!', 0);
		redirect('admin/nilaiSiswa');
	}

	public function laporan_pdf()
	{

		$data = array(
			"dataku" => array(
				"nama" => "Petani Kode",
				"url" => "http://petanikode.com"
			)
		);

		$this->load->library('pdf');

		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "laporan-petanikode.pdf";
		$this->pdf->load_view('laporan_pdf', $data);
	}

	public function aturWaktuPKL($offset = 0)
	{
		$query = $this->input->post('cari');

		$kepo = $this->db->get('tb_periode');
		$config['total_rows'] = $kepo->num_rows();
		$config['base_url'] = base_url() . 'admin/aturWaktuPKL';
		$config['per_page'] = 5;

		$config['first_link']       = '<i class="fa fa-angle-double-left"></i>';
		$config['last_link']        = '<i class="fa fa-angle-double-right"></i>';
		$config['next_link']        = '<i class="fa fa-angle-right"></i>
        <span class="sr-only">Next</span>';
		$config['prev_link']        = '<i class="fa fa-angle-left"></i>
        <span class="sr-only">Previous</span>';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$this->pagination->initialize($config);
		$data['halaman'] = $this->pagination->create_links();
		$data['offset'] = $offset;


		$data['aturWaktu'] = $this->m_admin->ambil_waktu($query, $config['per_page'], $offset);

		// $data['siswa'] = $this->m_admin->allSiswa();

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/atur-waktu/index', $data);
	}

	public function tambahWaktuPKL()
	{
		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/atur-waktu/tambah');
	}

	public function doTambahWaktuPKL()
	{
		$data = $_POST;

		$tgl_start = $this->input->post('tgl_start');
		$tgl_end = $this->input->post('tgl_end');

		if ($tgl_end < $tgl_start) {
			$this->session->set_tempdata('error_waktu', 'Waktu PKL Gagal Di tambah', 0);
			redirect('admin/aturWaktuPKL');
		} else {
			$this->m_admin->tambahWaktuPKL('tb_periode', $data);
			$this->session->set_tempdata('tambah_waktu', 'Waktu PKL Berhasil Di tambah', 0);
			redirect('admin/aturWaktuPKL');
		}
	}

	public function editWaktuPKL($id)
	{
		$dimana = array('id_periode' => $id);
		$data['data_periode'] = $this->m_admin->waktuTer('tb_periode', $dimana)->result();

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/atur-waktu/update', $data);
	}

	public function updateWaktuPKL()
	{
		$data = $_POST;

		$tgl_start = $this->input->post('tgl_start');
		$tgl_end = $this->input->post('tgl_end');

		$where = array(
			'id_periode' => $this->input->post('id_periode')
		);

		if ($tgl_end < $tgl_start) {
			$this->session->set_tempdata('error_waktu', 'Waktu PKL Gagal Di update', 0);
			redirect('admin/aturWaktuPKL');
		} else {
			$this->m_admin->updateWaktuPKL($data, $where);
			$this->session->set_tempdata('update_waktu', 'Waktu PKL Berhasil Di update', 0);
			redirect('admin/aturWaktuPKL');
		}
	}

	public function deleteWaktuPKL($id)
	{
		$dimana = array("id_periode" => $id);
		$this->m_admin->deleteWaktuPKL($dimana);
		$this->session->set_tempdata('delete_waktu', 'Data Berhasil Di Hapus!', 0);
		redirect('admin/aturWaktuPKL');
	}

	public function editProfilAdmin()
	{
		$dimana = array('id_admin' => 1);
		$data['data_sekolah'] = $this->m_admin->sekolahTer('tb_sekolah', $dimana)->result();

		$this->load->view('admin/index');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/profil', $data);
	}

	public function updateProfilSekolah()
	{
		$config['upload_path'] 			= './assets/img';
		$config['allowed_types']        = 'png';
		$config['max_size']             = 100;
		$config['max_width']            = 0;
		$config['max_height']           = 0;

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('foto')) {
			$id_sekolah = $this->input->post('id_sekolah');
			$dimana = array('id_sekolah' => $id_sekolah);
			$nama_sekolah = $this->input->post('nama_sekolah');
			$alamat_sekolah = $this->input->post('alamat_sekolah');
			$cp_sekolah = $this->input->post('cp_sekolah');
			$foto = $this->input->post('gambar');

			$data = array(
				'nama_sekolah' => $nama_sekolah,
				'alamat_sekolah' => $alamat_sekolah,
				'cp_sekolah' => $cp_sekolah,
				'logo_sekolah' => $foto
			);

			$this->m_admin->updateProfilSekolah($data, $dimana);
			$this->session->set_tempdata('update_profil', 'Profil Sekolah Berhasil di Ubah!', 0);
			redirect('admin');
		} else {
			$id_sekolah = $this->input->post('id_sekolah');
			$dimana = array('id_sekolah' => $id_sekolah);
			$nama_sekolah = $this->input->post('nama_sekolah');
			$alamat_sekolah = $this->input->post('alamat_sekolah');
			$cp_sekolah = $this->input->post('cp_sekolah');
			$foto = $this->input->post('gambar');
			$upload = $this->upload->data();

			$data = array(
				'nama_sekolah' => $nama_sekolah,
				'alamat_sekolah' => $alamat_sekolah,
				'cp_sekolah' => $cp_sekolah,
				'logo_sekolah' => $upload['file_name']
			);

			$this->m_admin->updateProfilSekolah($data, $dimana);
			$this->session->set_tempdata('update_profil', 'Profil Sekolah Berhasil di Ubah!', 0);
			redirect('admin');
		}
	}
}
