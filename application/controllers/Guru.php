<?php

class Guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != "guru") {
            redirect(base_url("login"));
        }
    }

    public function index($offset = 0)
    {
        $key                        = $this->input->post('caro');
        $kepo                       = $this->db->select('*')->from('tb_tempat_siswa')->join('tb_guru', 'tb_guru.id_guru = tb_tempat_siswa.id_guru')->where('tb_tempat_siswa.id_guru', $this->session->userdata('guru'))->get();
        $config['total_rows']       = $kepo->num_rows();
        $config['base_url']         = base_url() . 'guru/index';
        $config['per_page']         = 3;

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
        $data['halaman']            = $this->pagination->create_links();
        $data['offset']             = $offset;
        $data['guru']               = $this->m_guru->fullget($key, $config['per_page'], $offset);

        $this->load->view('guru/header');
        $this->load->view('guru/sidebar');
        $this->load->view('guru/content', $data);
        $this->load->view('guru/footer');
    }

    public function komentar($id)
    {
        $dimana             = array('id_siswa' => $id);
        $data['komentar']   = $this->m_guru->getKomen($dimana);

        $this->load->view('guru/header');
        $this->load->view('guru/sidebar');
        $this->load->view('guru/komentar', $data);
        $this->load->view('guru/footer');
    }

    public function addKomen()
    {
        $siswa          = $this->input->post('id');
        $guru           = $this->input->post('guru');
        $perusahaan     = $this->input->post('perusahaan');
        $pimpinan       = $this->input->post('pimpinan');
        $alamat         = $this->input->post('alamat');
        $kejadian       = $this->input->post('kejadian');
        $keterangan     = $this->input->post('keterangan');
        $rekomendasi    = $this->input->post('rekomendasi');

        $data           = array(
            'id_siswa'          => $siswa,
            'id_guru'           => $guru,
            'kejadian'          => $kejadian,
            'nama_perusahaan'   => $perusahaan,
            'keterangan'        => $keterangan,
            'rekomendasi'       => $rekomendasi,
        );

        $this->m_guru->insert('tb_monitoring', $data);
        $this->session->set_tempdata('pesan', 'Pesan anda telah tersampaikan ke admin', 0);
        redirect('guru');
    }
    public function kejadian()
    {
        $key                = $this->input->post('caro');
        $data['kejadian']   = $this->m_guru->cari($key);

        $this->load->view('guru/header');
        $this->load->view('guru/sidebar');
        $this->load->view('guru/kejadian/index', $data);
        $this->load->view('guru/footer');
    }

    public function absensi($offset = 0)
	{
		$kepo 				= $this->db->select('*')->from('tb_tempat_siswa')->join('tb_guru', 'tb_guru.id_guru = tb_tempat_siswa.id_guru')->where('tb_tempat_siswa.id_guru', $this->session->userdata('guru'))->get();
		$config['total_rows'] = $kepo->num_rows();
		$config['base_url'] = base_url() . 'guru/absensi';
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
		$data['manual']  = $this->db->query("SELECT * FROM tb_tempat_siswa INNER JOIN tb_siswa ON tb_tempat_siswa.id_siswa = tb_siswa.id_siswa INNER JOIN tb_tempat_rekomendasi ON tb_tempat_siswa.id_rekomendasi = tb_tempat_rekomendasi.id_rekomendasi JOIN tb_guru ON tb_guru.id_guru = tb_tempat_siswa.id_guru WHERE tb_guru.user = '".$this->session->userdata('guru')."' ORDER BY jurusan ASC LIMIT $offset, $perPage ")->result();
		$data['jurusan'] = $this->m_admin->jur('tb_jurusan')->result();
		$data['siswa']   = $this->db->query("SELECT * FROM tb_tempat_siswa INNER JOIN tb_siswa ON tb_tempat_siswa.id_siswa = tb_siswa.id_siswa INNER JOIN tb_tempat_rekomendasi ON tb_tempat_siswa.id_rekomendasi = tb_tempat_rekomendasi.id_rekomendasi JOIN tb_guru ON tb_guru.id_guru = tb_tempat_siswa.id_guru WHERE tb_guru.user = '".$this->session->userdata('guru')."'")->result();
		$this->load->view('guru/header');
        $this->load->view('guru/sidebar');
        $this->load->view('guru/absensi/index', $data);
	}

    public function cekManual($nis)
	{
		$siswa				= $this->db->query("SELECT * FROM tb_siswa WHERE nis = '$nis' ")->row();
		$id					= $this->db->query("SELECT * FROM tb_tempat_siswa WHERE id_siswa = '$siswa->id_siswa' ")->row();
		$data['cek']		= $this->db->query("SELECT * FROM tb_tempat_siswa INNER JOIN tb_siswa ON tb_tempat_siswa.id_siswa = tb_siswa.id_siswa INNER JOIN tb_tempat_rekomendasi ON tb_tempat_siswa.id_rekomendasi = tb_tempat_rekomendasi.id_rekomendasi JOIN tb_guru ON tb_guru.id_guru = tb_tempat_siswa.id_guru  WHERE tb_guru.user = '".$this->session->userdata('guru')."' AND nis = '$nis' AND id = '$id->id'  ")->result();

		$data['absen']		= $this->db->query("SELECT * FROM tb_absensi_manual WHERE id_siswa = '$siswa->id_siswa' ")->result();

		$this->load->view('guru/header');
        $this->load->view('guru/sidebar');
        $this->load->view('guru/absensi/cek', $data);
	}

    public function cetakAbsenKelas()
	{
		$this->load->library('mypdf');
		$data['cetak'] = $this->m_admin->showCetakNilai();

		$this->mypdf->generate('laporan_pdf', $data);




		// $data['coba']	 = $_GET['jurusan'];

		// $this->pdf->setPaper('A4', 'potrait');
		// $this->pdf->filename = "laporan-petanikode.pdf";
		// $this->pdf->load_view('laporan_pdf', $data);
	}

    public function cariAbsen()
	{
		$jurusan			= $this->input->post('jurusan');
		$siswa 			    = $this->input->post('siswa');
		$dimana				= array('jurusan' => $jurusan);


		$siswa			 = $this->input->post('siswa');

		$data['jurusan'] = $this->m_admin->jur('tb_jurusan')->result();
		$data['absen'] 	 = $this->m_admin->cariBed('tb_absensi', $dimana);
		$data['siswa']	 = $this->db->query("SELECT * FROM tb_tempat_siswa INNER JOIN tb_siswa ON tb_tempat_siswa.id_siswa = tb_siswa.id_siswa INNER JOIN tb_tempat_rekomendasi ON tb_tempat_siswa.id_rekomendasi = tb_tempat_rekomendasi.id_rekomendasi JOIN tb_guru ON tb_guru.id_guru = tb_tempat_siswa.id_guru WHERE tb_guru.user = '".$this->session->userdata('guru')."' && jurusan='".$jurusan."' ")->result();
		$data['akhir']	 = $this->m_admin->akhir($siswa, $jurusan);


		$this->load->view('guru/header');
        $this->load->view('guru/sidebar');
        $this->load->view('guru/absensi/index', $data);
	}

    public function laporan($offset = 0){
		$query = $this->input->post('key');
		
		$kepo = $this->db->select('*')->from('tb_kegiatan_view')->where('user_guru', $this->session->userdata('guru'))->group_by('id_siswa')->get();
		$config['total_rows'] = $kepo->num_rows();
		$config['base_url'] = base_url() . 'guru/laporan';
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


		$data['kegiatan'] = $this->m_guru->ambil_kegiatan($query, $config['per_page'], $offset);

		// $data['siswa'] = $this->m_admin->allSiswa();

		$this->load->view('guru/header');
		$this->load->view('guru/sidebar');
		$this->load->view('guru/laporan/index', $data);
	}

	public function detailKegiatan($id_siswa){
		$data['kegiatan'] = $this->m_guru->ambil_detail_kegiatan($id_siswa);

		$this->load->view('guru/header');
		$this->load->view('guru/sidebar');
		$this->load->view('guru/laporan/detail', $data);
	}

	public function nilai($offset = 0){
		$query = $this->input->post('key');
		
		$kepo = $this->db->select('*')->from('tb_kegiatan_view')->where('user_guru', $this->session->userdata('guru'))->group_by('id_siswa')->get();
		$config['total_rows'] = $kepo->num_rows();
		$config['base_url'] = base_url() . 'guru/nilai';
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


		$data['nilai'] = $this->m_guru->ambil_kegiatan($query, $config['per_page'], $offset);

		// $data['siswa'] = $this->m_admin->allSiswa();

		$this->load->view('guru/header');
		$this->load->view('guru/sidebar');
		$this->load->view('guru/nilai/index', $data);
	}

	public function inputNilai($id_siswa)
	{
		$data['nilai']		= $this->db->query("SELECT * FROM tb_tempat_siswa INNER JOIN tb_siswa ON tb_tempat_siswa.id_siswa = tb_siswa.id_siswa INNER JOIN tb_tempat_rekomendasi ON tb_tempat_siswa.id_rekomendasi = tb_tempat_rekomendasi.id_rekomendasi WHERE tb_tempat_siswa.id_siswa = '$id_siswa' ")->result();
		$data['dataNilai']	= $this->db->query("SELECT * FROM tb_nilai WHERE id_siswa = '$id_siswa' ")->result();
		$this->load->view('guru/header');
		$this->load->view('guru/sidebar');
		$this->load->view('guru/nilai/input', $data);
	}

	public function doEditNilai(){
		$data = array(
			'ujian_prakerin' 			=> $this->input->post('ujian'),
			'status_nilai_industri' 	=> 2
		);

		$where = array('id_nilai' => $this->input->post('id_nilai'));

		$this->m_guru->updateNilai($data, $where);
		$this->session->set_tempdata('update_nilai', 'Nilai Berhasil di Update!', 0);
		redirect('guru/nilai');
	}
}
