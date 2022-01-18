<?php

class Industri extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != "industri") {
			redirect(base_url("login"));
		}

		$this->load->model('m_industri');
		$this->load->model('m_siswa');
	}

    public function index()
	{
		$this->load->view('industri/index');
		$this->load->view('industri/sidebar');
		$this->load->view('industri/content');
	}

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

		$data['notif']	= $this->m_industri->allNotif($config['per_page'], $offset)->result();
		$this->load->view('industri/index');
		$this->load->view('industri/sidebar');
		$this->load->view('industri/notif/index', $data);
	}

	public function taOke($id)
	{
		$data['dataSiswa']	= $this->m_industri->get_satu($id);

		$this->load->view('industri/index');
		$this->load->view('industri/oke/index', $data);
		$this->load->view('industri/sidebar');
	}

	public function taTolak($id)
	{
		$data['dataSiswa']	= $this->m_industri->get_nol($id);

		$this->load->view('industri/index');
		$this->load->view('industri/oke/index', $data);
		$this->load->view('industri/sidebar');
	}

	public function validasiPKL()
	{
		$id_rekomendasi	= $this->input->post('id_rekomendasi');
		$id_siswa		= $this->input->post('id_siswa');
		$id_guru		= $this->input->post('id_guru');
		$id_periode		= $this->input->post('id_periode');

		$data = array(
			'id_rekomendasi' 	=> $id_rekomendasi,
			'id_siswa'			=> $id_siswa,
			'id_guru'			=> $id_guru,
			'id_periode'		=> $id_periode
		);
		
		$kepo = array(
			'nama_perusahaan'	=> $id_rekomendasi,
			'pesan'				=> 'Selamat tempat pkl anda telah terkonfirmasi!',
			'id_siswa'			=> $id_siswa
		);

		$dimana = array('id_siswa' => $id_siswa);

		$this->m_siswa->tambah('tb_notif', $kepo);
		$this->m_siswa->tambah('tb_tempat_siswa', $data);
		$this->db->delete('tb_sementara', $dimana);
		$this->session->set_tempdata('oke', 'Siswa PKL telah di konfirmasi', 0);
		redirect('industri/notif');
	}

	public function daftarSiswa($offset = 0)
	{

		$query = $this->input->post('cari');

		$kepo = $this->db->select('*')->from('tb_tempat_siswa')->join('tb_siswa', 'tb_siswa.id_siswa = tb_tempat_siswa.id_siswa')->join('tb_tempat_rekomendasi', 'tb_tempat_rekomendasi.id_rekomendasi = tb_tempat_siswa.id_rekomendasi')->where('tb_tempat_rekomendasi.user', $this->session->userdata('industri'))->get();
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


		$data['siswa'] = $this->m_industri->ambil_cari($query, $config['per_page'], $offset);

		// $data['siswa'] = $this->m_admin->allSiswa();

		$this->load->view('industri/index');
		$this->load->view('industri/sidebar');
		$this->load->view('industri/siswa/index', $data);
	}

	public function daftarGuru($offset = 0){
		$query = $this->input->post('key');
		
		$kepo = $this->db->select('*')->from('tb_tempat_siswa')->join('tb_guru', 'tb_guru.id_guru = tb_tempat_siswa.id_guru')->join('tb_tempat_rekomendasi', 'tb_tempat_rekomendasi.id_rekomendasi = tb_tempat_siswa.id_rekomendasi')->where('tb_tempat_rekomendasi.user', $this->session->userdata('industri'))->get();
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


		$data['guru'] = $this->m_industri->ambil_guru($query, $config['per_page'], $offset);

		// $data['siswa'] = $this->m_admin->allSiswa();

		$this->load->view('industri/index');
		$this->load->view('industri/sidebar');
		$this->load->view('industri/guru/index', $data);
	}

	public function laporan($offset = 0){
		$query = $this->input->post('key');
		
		$kepo = $this->db->select('*')->from('tb_kegiatan_view')->where('user_perusahaan', $this->session->userdata('industri'))->group_by('id_siswa')->get();
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


		$data['kegiatan'] = $this->m_industri->ambil_kegiatan($query, $config['per_page'], $offset);

		// $data['siswa'] = $this->m_admin->allSiswa();

		$this->load->view('industri/index');
		$this->load->view('industri/sidebar');
		$this->load->view('industri/laporan/index', $data);
	}

	public function detailKegiatan($id_siswa){
		$data['kegiatan'] = $this->m_industri->ambil_detail_kegiatan($id_siswa);

		$this->load->view('industri/index');
		$this->load->view('industri/sidebar');
		$this->load->view('industri/laporan/detail', $data);
	}

	public function nilaiSiswa($offset = 0){
		$query = $this->input->post('key');
		
		$kepo = $this->db->select('*')->from('tb_kegiatan_view')->where('user_perusahaan', $this->session->userdata('industri'))->group_by('id_siswa')->get();
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


		$data['nilai'] = $this->m_industri->ambil_kegiatan($query, $config['per_page'], $offset);

		// $data['siswa'] = $this->m_admin->allSiswa();

		$this->load->view('industri/index');
		$this->load->view('industri/sidebar');
		$this->load->view('industri/nilai/index', $data);
	}

	public function inputNilai($id_siswa)
	{
		$data['nilai']	= $this->db->query("SELECT * FROM tb_tempat_siswa INNER JOIN tb_siswa ON tb_tempat_siswa.id_siswa = tb_siswa.id_siswa INNER JOIN tb_tempat_rekomendasi ON tb_tempat_siswa.id_rekomendasi = tb_tempat_rekomendasi.id_rekomendasi WHERE tb_tempat_siswa.id_siswa = '$id_siswa' ")->result();
		$data['dataNilai']	= $this->db->query("SELECT * FROM tb_nilai WHERE id_siswa = '$id_siswa' ")->result();
		$this->load->view('industri/index');
		$this->load->view('industri/sidebar');
		$this->load->view('industri/nilai/input', $data);
	}

	public function doInputNilai(){
		$data = array(
			'id_siswa' 				=> $this->input->post('id_siswa'),
			'kerajinan' 			=> $this->input->post('kerajinan'),
			'prestasi' 				=> $this->input->post('prestasi'),
			'disiplin' 				=> $this->input->post('disiplin'),
			'kerjasama' 			=> $this->input->post('kerjasama'),
			'inisiatif' 			=> $this->input->post('inisiatif'),
			'tanggung_jawab' 		=> $this->input->post('tanggung_jawab'),
			'status_nilai_industri' => 1
		);

		$this->m_industri->inputNilai($data);
		$this->session->set_tempdata('input_nilai', 'Nilai Berhasil di Input!', 0);
		redirect('industri/nilaiSiswa');
	}

	public function doEditNilai(){
		$data = array(
			'kerajinan' 			=> $this->input->post('kerajinan'),
			'prestasi' 				=> $this->input->post('prestasi'),
			'disiplin' 				=> $this->input->post('disiplin'),
			'kerjasama' 			=> $this->input->post('kerjasama'),
			'inisiatif' 			=> $this->input->post('inisiatif'),
			'tanggung_jawab' 		=> $this->input->post('tanggung_jawab'),
			'status_nilai_industri' => 1
		);

		$where = array('id_nilai' => $this->input->post('id_nilai'));

		$this->m_industri->updateNilai($data, $where);
		$this->session->set_tempdata('update_nilai', 'Nilai Berhasil di Update!', 0);
		redirect('industri/nilaiSiswa');
	}
}