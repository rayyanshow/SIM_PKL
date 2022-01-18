<?php

class Siswa extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != "siswa") {
			redirect(base_url("login"));
		}
	}

	public function index($offset = 0)
	{
		//$dimana = array('id_siswa' => $id);
		//$data['siswa'] = $this->m_siswa->select_satu('tb_siswa', $dimana);
		$kepo = $this->db->get('tb_berkas');
		$config['total_rows'] = $kepo->num_rows();
		$config['base_url'] = base_url() . 'siswa/index';
		$config['per_page'] = 2;

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
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link" style="background-color: #17a2b8; border-color: transparent;">';
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

		$data['berkas']  = $this->m_siswa->pagination('tb_berkas', $config['per_page'], $offset);
		$this->load->view('siswa/header');
		$this->load->view('siswa/home', $data);
		$this->load->view('siswa/footer');
	}

	public function profile($id)
	{
		$dimana = array('id_siswa' => $id);
		$data['siswa'] = $this->m_siswa->get_satu('tb_siswa', $dimana);

		$this->load->view('siswa/header');
		$this->load->view('siswa/navbar');
		$this->load->view('siswa/profile/index', $data);
		$this->load->view('siswa/footer');
	}

	public function edit($id)
	{
		$dimana = array('id_siswa' => $id);
		$data['profile'] = $this->m_siswa->get_profile($dimana, 'tb_siswa');
		$this->load->view('siswa/header');
		$this->load->view('siswa/profile/edit', $data);
		$this->load->view('siswa/footer');
	}

	public function update()
	{

		$config['upload_path']   = './assets/uploads/profile-siswa';
		$config['allowed_types'] = 'jpg|png|jpeg|gif';
		$config['max_size']      = 0;
		$config['max-width']     = 0;
		$config['max-height']    = 0;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('foto')) {
			$id     = $this->input->post('id');
			$nama   = $this->input->post('nama');
			$gambar = $this->input->post('gambar');
			$dimana = array('id_siswa' => $id);
			$data = array(
				'nama_siswa' => $nama,
				'foto' => $gambar
			);

			$this->m_siswa->update($dimana, $data, 'tb_siswa');
			$this->session->set_tempdata('update_profile', 'Profile Berhasil di Update!', 0);
			$data_session = array(
				'nama_siswa' => $nama,
				'status' => 'login'
			);
			$this->session->set_userdata($data_session);

			redirect('siswa');
		} else {
			$id   	= $this->input->post('id');
			$nama 	= $this->input->post('nama');
			$upload = $this->upload->data();

			$dimana = array('id_siswa' => $id);
			$data	= array(
				'nama_siswa' => $nama,
				'foto' => $upload['file_name']
			);

			$this->m_siswa->update($dimana, $data, 'tb_siswa');
			$this->session->set_tempdata('update_profile', 'Profile Berhasil di Update!', 0);
			$data_session = array(
				'nama_siswa' => $nama,
				'status' => 'login'
			);
			$this->session->set_userdata($data_session);

			redirect('siswa');
		}
	}

	// START FUNCTION REKOMENDASI

	public function rekomendasi($offset = 0)
	{

		$kepo = $this->db->get('tb_tempat_rekomendasi');
		$config['total_rows'] = $kepo->num_rows();
		$config['base_url'] = base_url() . 'siswa/rekomendasi';
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
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link" style="background-color: #17a2b8; border-color: transparent;">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item" ><span class="page-link">';
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


		$data['rekomendasi'] = $this->m_siswa->pagination('tb_tempat_rekomendasi', $config['per_page'], $offset);

		$this->load->view('siswa/header');
		$this->load->view('siswa/navbar');
		$this->load->view('siswa/tempat-rekomendasi/index', $data);
		$this->load->view('siswa/footer');
	}

	public function tambahRekomen($id)
	{
		$dimana 		 	= array('id_rekomendasi' => $id);
		$status 		 	= array('status_periode' => 1);
		$data['rekomen'] 	= $this->m_siswa->get_satu('tb_tempat_rekomendasi', $dimana);
		$data['periode'] 	= $this->m_siswa->get_periode('tb_periode', $status);
		$data['guru'] 		= $this->m_siswa->get_guru('tb_guru');
		$this->load->view('siswa/header');
		$this->load->view('siswa/tempat-rekomendasi/tambah', $data);
		$this->load->view('siswa/footer');
	}

	public function tambahRekomendasi()
	{
		$id 			= $this->input->post('id');
		$id_rekomendasi = $this->input->post('id_rekomendasi');
		$jurusan		= $this->input->post('jurusan');
		$alamat			= $this->input->post('alamat');
		$cp 			= $this->input->post('cp');
		$pimpinan   	= $this->input->post('pimpinan');
		$id_guru 		= $this->input->post('id_guru');
		$id_periode   	= $this->input->post('id_periode');

		$data = array(
			'id_siswa'		  		=> $id,
			'id_rekomendasi' 		=> $id_rekomendasi,
			'jurusan_perusahaan' 	=> $jurusan,
			'alamat'		  		=> $alamat,
			'cp'			  		=> $cp,
			'nama_pimpinan'	  		=> $pimpinan,
			'id_guru'				=> $id_guru,
			'id_periode'			=> $id_periode
		);

		$this->m_siswa->tambah('tb_sementara', $data);
		$this->session->set_tempdata('unggah_bukti', 'Pendaftaran PKL Berhasil, Tunggu Konfirmasi Selanjutnya ya!', 0);

		redirect('siswa');
	}

	public function notif($id)
	{
		$dimana 		= array('id_siswa' => $id);
		$data['notif'] 	= $this->m_siswa->satNot($dimana)->result();

		$this->load->view('siswa/header');
		$this->load->view('siswa/navbar');
		$this->load->view('siswa/notif/index', $data);
		$this->load->view('siswa/footer');
	}
	public function oke($id)
	{
		$dimana = array('id_siswa' => $id);
		$eko	= $this->db->query("SELECT nama_siswa FROM tb_siswa WHERE id_siswa = '$id' ");
		$ho 	= $eko->row();
		$this->db->delete('tb_notif', $dimana);
		$this->session->set_tempdata('oke', ' silahkan di coba lagi ya, ' . $ho->nama_siswa, 0);
		redirect('siswa/notif/' . $id);
	}

	// FUNCTION DAFTAR PRAKERIN

	public function daftarPkl($id)
	{
		$dimana 		= array('id_siswa' => $id);
		$data['daftar'] = $this->m_siswa->get_satu('tb_siswa', $dimana);
		$this->load->view('siswa/header');
		$this->load->view('siswa/daftar-pkl/index', $data);
		$this->load->view('siswa/footer');
	}

	public function regPkl()
	{
		$config['upload_path'] 		= './assets/uploads/tempat-siswa/';
		$config['allowed_types']	= 'png|doc|docx|jpg|pdf';
		$config['max_size']			= 0;
		$config['max_width']		= 0;
		$config['max_height']		= 0;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('bukti')) {
			$perusahaan	= $this->input->post('perusahaan');
			$alamat		= $this->input->post('alamat');
			$cp 		= $this->input->post('cp');
			$bukti		= $this->upload->data();
			$id			= $this->input->post('id');
			$pimpinan	= $this->input->post('pimpinan');
			$pembimbing = $this->input->post('pembimbing');

			$data = array(
				'nama_perusahaan' 	=> $perusahaan,
				'bukti'				=> $bukti['file_name'],
				'alamat'			=> $alamat,
				'cp'				=> $cp,
				'id_siswa'			=> $id,
				'nama_pimpinan'		=> $pimpinan,
				'nama_pembimbing'	=> $pembimbing
			);

			$this->m_siswa->tambah('tb_sementara', $data);
			$this->session->set_tempdata('tambah_daf', 'Tunggu konfirmasi dulu ya', 0);
			redirect('siswa');
		}
	}

	public function absensi($id)
	{
		$dimana 			= $id;
		$data['absensi'] 	= $this->m_siswa->getPKLSiswa('tb_tempat_siswa', $dimana);
		$this->load->view('siswa/header');
		$this->load->view('siswa/navbar');
		$this->load->view('siswa/absensi/index', $data);
		$this->load->view('siswa/footer');
	}

	public function absen()
	{
		$perusahaan		= $this->input->post('perusahaan', true);
		$alamat			= $this->input->post('alamat', true);
		$siswa 			= $this->input->post('siswa', true);
		$jurusan		= $this->input->post('jurusan', true);
		$image 			= $this->input->post('image');
		$image = str_replace('[removed]', '', $image);

		// $image = str_replace('data:image/jpeg;base64,','', $image);
		$image_decoded = base64_decode($image);
		// $image_decoded = imageCreateFromString($image_decoded);
		$filename = 'image_' . time() . '.png';
		file_put_contents(FCPATH . '/assets/uploads/absensi/' . $filename, $image_decoded);
		$data 			= array(
			'perusahaan'		=> $perusahaan,
			'alamat'			=> $alamat,
			'siswa'				=> $siswa,
			'jurusan'			=> $jurusan,
			'foto'				=> $filename

		);

		$res			= $this->m_siswa->insert($data);
		$this->session->set_tempdata('absen', 'Anda telah absen hari ini', 0);
		echo json_encode($res);
	}

	public function downloadBerkas($berkas)
	{
		force_download('assets/uploads/berkas-prakerin/' . $berkas, NULL);
	}
	// FUNCTION TAMBAH DESKIPSI SISWA
	public function desk()
	{
		$id 		= $this->input->post('id');
		$dimana 	= array('id_siswa' => $id);
		$diskripsi	= $this->input->post('diskripsi');

		$data		= array(
			'diskripsi' => $diskripsi
		);

		$this->m_siswa->update($dimana, $data, 'tb_siswa');
		$this->session->set_tempdata('tamdesk', 'Diskripsi Telah Di Tambah!', 0);
		redirect(base_url('siswa/profile/') . $id);
	}

	// FUNCTION PESAN

	public function pesan()
	{
		$this->load->view('siswa/header');
		$this->load->view('siswa/navbar');
		$this->load->view('siswa/pesan/index');
		$this->load->view('siswa/footer');
	}
	public function pesanAdmin($id)
	{
		$dimana					= array('id_siswa' => $id);
		$this->db->delete('tb_notif', $dimana);
		$data['pesan_admin']	= $this->db->query("SELECT * FROM tb_chat WHERE id_siswa = '$id' ORDER BY id_chat ASC ")->result();

		$this->load->view('siswa/header');
		$this->load->view('siswa/pesan/admin', $data);
	}

	public function cekPesan($id)
	{
		//$dimana = array('id_siswa' => $id);
		//$this->db->delete('tb_tampung', $dimana);
		$data['cek']			= $this->db->query("SELECT * FROM tb_chat WHERE id_siswa = '$id' ")->result();
		$data['pesan_admin']	= $this->db->query("SELECT * FROM tb_chat WHERE id_siswa = '$id' ORDER BY id_chat ASC ")->result();
		$data['id']				= $id;
		$this->load->view('siswa/header');
		$this->load->view('siswa/home');
		$this->load->view('siswa/pesan/cek', $data);
		$this->load->view('siswa/footer');
	}

	public function kepadaAdmin()
	{
		$siswa		= $this->input->post('siswa');
		$pesan		= $this->input->post('chat');
		$kepada		= $this->input->post('kepada');

		$data		= array(
			'id_siswa'		=> $siswa,
			'pesan'			=> $pesan,
			'kepada'		=> $kepada
		);

		$data2 		= array(
			'kepada'		=> $kepada,
			'id_siswa'		=> $siswa
		);

		$this->m_siswa->tambah('tb_tampung', $data2);

		$this->m_siswa->tambah('tb_chat', $data);
		redirect(base_url('siswa/cekPesan/' . $siswa));
	}

	// START FUNCTION LAPORAN

	public function laporan($id)
	{
		$this->load->view('siswa/header');
		$this->load->view('siswa/laporan/index');
		$this->load->view('siswa/footer');
	}

	public function berkas()
	{
		$data['berkas'] = $this->m_siswa->getBerkas()->result();

		$this->load->view('siswa/header');
		$this->load->view('siswa/navbar');
		$this->load->view('siswa/berkas/index', $data);
	}

	public function kegiatan()
	{
		$data['kegiatan'] = $this->m_siswa->getKegiatan()->result();

		$this->load->view('siswa/header');
		$this->load->view('siswa/navbar');
		$this->load->view('siswa/kegiatan/index', $data);
	}

	public function tambahKegiatan($id_user)
	{
		$data['kegiatan'] = $this->m_siswa->getKegiatanByUser($id_user)->result();

		$this->load->view('siswa/header');
		$this->load->view('siswa/navbar');
		$this->load->view('siswa/kegiatan/tambah', $data);
	}

	public function doTambahKegiatan()
	{
		$config['upload_path']   = './assets/uploads/kegiatan';
		$config['allowed_types'] = 'doc|docx|pdf';
		$config['max_size'] 		= 2048;

		$this->load->library('upload', $config);
		$buktiKegiatan = null;

		$upload = $this->upload->data();

		if ($this->upload->do_upload('bukti_kegiatan')) {
			$dataUpload     	= $this->upload->data();
			$buktiKegiatan    	= $dataUpload['file_name'];

			$data = array(
				'id_siswa' 				=> $this->input->post('id_siswa'),
				'id_rekomendasi' 		=> $this->input->post('id_rekomendasi'),
				'id_guru' 				=> $this->input->post('id_guru'),
				'nama_kegiatan' 		=> $this->input->post('nama_kegiatan'),
				'tgl_kegiatan' 			=> $this->input->post('tgl_kegiatan'),
				'deskripsi_kegiatan' 	=> $this->input->post('deskripsi_kegiatan'),
				'bukti_kegiatan' 		=> $buktiKegiatan
			);

			$this->m_siswa->tambahKegiatan($data);
			$this->session->set_tempdata('tambah_kegiatan', 'Kegiatan Berhasil di Tambah!', 0);
			redirect('siswa/kegiatan');
		} else {
			$this->session->set_tempdata('tambah_kegiatan', 'Data tidak dapat diupload!', 0);
			redirect('siswa/kegiatan');
		}
	}

	public function editKegiatan($id_kegiatan)
	{
		$data['kegiatan'] = $this->m_siswa->getKegiatanById($id_kegiatan)->result();

		$this->load->view('siswa/header');
		$this->load->view('siswa/navbar');
		$this->load->view('siswa/kegiatan/edit', $data);
	}

	public function doEditKegiatan()
	{
		$config['upload_path']   = './assets/uploads/kegiatan';
		$config['allowed_types'] = 'jpg|png|jpeg|gif';
		$config['max_size'] 		= 1024;

		$this->load->library('upload', $config);
		$buktiKegiatan = null;

		$upload = $this->upload->data();

		if ($this->upload->do_upload('bukti_kegiatan')) {
			$dataUpload     	= $this->upload->data();
			$buktiKegiatan    	= $dataUpload['file_name'];

			$data = array(
				'nama_kegiatan' 		=> $this->input->post('nama_kegiatan'),
				'tgl_kegiatan' 			=> $this->input->post('tgl_kegiatan'),
				'deskripsi_kegiatan' 	=> $this->input->post('deskripsi_kegiatan'),
				'bukti_kegiatan' 		=> $buktiKegiatan
			);
		} else {
			$data = array(
				'nama_kegiatan' 		=> $this->input->post('nama_kegiatan'),
				'tgl_kegiatan' 			=> $this->input->post('tgl_kegiatan'),
				'deskripsi_kegiatan' 	=> $this->input->post('deskripsi_kegiatan'),
				'bukti_kegiatan' 		=> $this->input->post('bukti')
			);
		}

		$where = array('id_kegiatan' => $this->input->post('id_kegiatan'));

		$this->m_siswa->editKegiatan($data, $where);
		$this->session->set_tempdata('update_kegiatan', 'Kegiatan Berhasil di Update!', 0);
		redirect('siswa/kegiatan');
	}

	public function deleteKegiatan($id_kegiatan)
	{
		$this->m_siswa->deleteKegiatan($id_kegiatan);
		$this->session->set_tempdata('delete_kegiatan', 'Kegiatan Berhasil di Hapus!', 0);
		redirect('siswa/kegiatan');
	}

	public function nilai()
	{
		$data['nilai'] = $this->m_siswa->getNilai();

		$this->load->view('siswa/header');
		$this->load->view('siswa/navbar');
		$this->load->view('siswa/nilai/index', $data);
	}

	public function tempatPKL($id)
	{
		$dimana = array('id_siswa' => $id);
		$data['siswa'] = $this->m_siswa->get_satu('tb_siswa', $dimana);

		$this->load->view('siswa/header');
		$this->load->view('siswa/navbar');
		$this->load->view('siswa/tempat-pkl/index', $data);
		$this->load->view('siswa/footer');
	}
}
