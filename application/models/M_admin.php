<?php

class m_admin extends CI_Model
{

	public function jurusan($table)
	{
		return $this->db->get($table)->result();
	}
	// Start Function Ambil siswa
	public function allSiswa()
	{
		return $this->db->get('tb_siswa')->result();
	}

	public function ambil_cari($query, $perPage, $offset)
	{
		// $this->db->select("*");
		// $this->db->from('tb_siswa');
		if ($query != "") {
			$oke = $this->db->query("SELECT * FROM tb_siswa WHERE nama_siswa LIKE '%" . $query . "%' ");
		} else {
			$oke = $this->db->get('tb_siswa', $perPage, $offset);
			// $this->db->order_by('jurusan', 'ASC');
		}

		return $oke->result();
	}

	public function ambil_waktu($query, $perPage, $offset)
	{
		// $this->db->select("*");
		// $this->db->from('tb_siswa');
		if ($query != "") {
			$oke = $this->db->query("SELECT * FROM tb_periode WHERE tgl_start LIKE '%" . $query . "%' ORDER BY id_periode ASC");
		} else {
			$oke = $this->db->get('tb_periode', $perPage, $offset);
			
		}

		return $oke->result();
	}

	// Start Function All Jurusan
	public function allJurusan($table, $perPage, $offset)
	{
		return $this->db->get($table, $perPage, $offset)->result();
	}

	public function siswaTer($table, $dimana)
	{
		return $this->db->get_where($table, $dimana);
	}

	public function tambahSiswa($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function updateSiswa($data, $dimana)
	{
		$this->db->where($dimana);
		$this->db->update('tb_siswa', $data);
	}

	public function deleteSiswa($dimana)
	{
		$this->db->where($dimana);
		$this->db->delete('tb_siswa');
	}

	// START FUNCTION TEMPAT PKL SISWA 

	public function allTempat($query, $perPage, $offset)
	{
		if ($query != "") {
			$oke = $this->db->query("SELECT tb_siswa.foto as foto_siswa, tb_siswa.*, tb_tempat_siswa.*, tb_tempat_rekomendasi.*, tb_guru.*, tb_periode.* FROM tb_tempat_siswa JOIN tb_siswa ON tb_tempat_siswa.id_siswa = tb_siswa.id_siswa JOIN tb_tempat_rekomendasi ON tb_tempat_rekomendasi.id_rekomendasi = tb_tempat_siswa.id_rekomendasi JOIN tb_guru ON tb_guru.id_guru = tb_tempat_siswa.id_guru JOIN tb_periode ON tb_periode.id_periode = tb_tempat_siswa.id_periode WHERE nama_siswa LIKE '%" . $query . "%' ");
		} else {
			$oke = $this->db->query("SELECT tb_siswa.foto as foto_siswa, tb_siswa.*, tb_tempat_siswa.*, tb_tempat_rekomendasi.*, tb_guru.*, tb_periode.* FROM tb_tempat_siswa JOIN tb_siswa ON tb_tempat_siswa.id_siswa = tb_siswa.id_siswa JOIN tb_tempat_rekomendasi ON tb_tempat_rekomendasi.id_rekomendasi = tb_tempat_siswa.id_rekomendasi JOIN tb_guru ON tb_guru.id_guru = tb_tempat_siswa.id_guru JOIN tb_periode ON tb_periode.id_periode = tb_tempat_siswa.id_periode LIMIT $offset, $perPage ");
			// $this->db->order_by('jurusan', 'ASC');
		}

		return $oke;
	}

	public function deleteTempat($dimana)
	{
		$this->db->where($dimana);
		$this->db->delete('tb_tempat_siswa');
	}

	public function ambil_tempat($id)
	{
		return $this->db->query("SELECT * FROM tb_tempat_siswa INNER JOIN tb_siswa ON tb_tempat_siswa.id_siswa = tb_siswa.id_siswa WHERE id = '$id' ");
	}

	public function updateTempat($dimana, $data)
	{
		$this->db->where($dimana);
		$this->db->update('tb_tempat_siswa', $data);
	}

	// START FUNCTION DAFTAR BERKAS 

	public function allBerkas($query, $perPage, $offset)
	{
		if ($query != "") {
			$oke = $this->db->query("SELECT * FROM tb_berkas WHERE nama_berkas LIKE '%" . $query . "%' ");
		} else {
			$oke = $this->db->get('tb_berkas', $perPage, $offset);
		}

		return $oke;
	}

	public function tambahBerkas($data)
	{
		$this->db->insert('tb_berkas', $data);
	}

	public function ambil_berkas($dimana)
	{
		return $this->db->get_where('tb_berkas', $dimana)->result();
	}

	public function updateBerkas($dimana, $data)
	{
		$this->db->where($dimana);
		$this->db->update('tb_berkas', $data);
	}

	public function deleteBerkas($table, $dimana)
	{
		$this->db->where($dimana);
		$this->db->delete($table);
	}
	// START FUNCTION TEMPAT REKOMENDASI

	public function allRekomendasi($query, $perPage, $offset)
	{
		if ($query != "") {
			$hmm = $this->db->query("SELECT * FROM tb_tempat_rekomendasi WHERE nama_perusahaan LIKE '%" . $query . "%' ");
		} else {
			$hmm = $this->db->get('tb_tempat_rekomendasi', $perPage, $offset);
		}
		// $this->db->order_by('jurusan', 'ASC');

		return $hmm->result();
	}

	public function tambahRekomendasi($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function ambil_rekomendasi($dimana)
	{
		return $this->db->get_where('tb_tempat_rekomendasi', $dimana)->result();
	}

	public function updateRekomendasi($dimana, $data)
	{
		$this->db->where($dimana);
		$this->db->update('tb_tempat_rekomendasi', $data);
	}

	public function deleteRekomendasi($table, $dimana)
	{
		$this->db->where($dimana);
		$this->db->delete($table);
	}

	// START FUNTION JURUSAN 

	public function tambahJurusan($data)
	{
		$this->db->insert('tb_jurusan', $data);
	}

	public function ambil_jurusan($dimana)
	{
		return $this->db->get_where('tb_jurusan', $dimana);
	}

	public function updateJurusan($dimana, $data)
	{
		$this->db->where($dimana);
		$this->db->update('tb_jurusan', $data);
	}

	public function deleteJurusan($dimana)
	{
		$this->db->where($dimana);
		$this->db->delete('tb_jurusan');
	}

	// START FUNCTION NOTIF 
	public function allNotif($perPage, $offset)
	{
		$this->db->select('*');
		$this->db->from('tb_siswa');
		$this->db->join('tb_sementara', 'tb_siswa.id_siswa = tb_sementara.id_siswa');
		$this->db->join('tb_tempat_rekomendasi', 'tb_tempat_rekomendasi.id_rekomendasi = tb_sementara.id_rekomendasi');
		$this->db->join('tb_guru', 'tb_guru.id_guru = tb_sementara.id_guru');
		$this->db->join('tb_periode', 'tb_periode.id_periode = tb_sementara.id_periode');
		$this->db->where('status_pkl', 0);
		return $this->db->get();
	}
	public function ambilPesan($dimana)
	{
		return $this->db->get_where('tb_sementara', $dimana);
	}

	public function kirimPesan($data)
	{
		$this->db->insert('tb_notif', $data);
	}

	// START FUNCTION ABSENSI

	public function jur($table)
	{
		return $this->db->get($table);
	}

	public function cariBed($table, $dimana)
	{
		return $this->db->get_where($table, $dimana)->result();
	}

	public function disiswa($key)
	{
		return $this->db->query("SELECT DISTINCT siswa FROM tb_absensi WHERE jurusan = '$key' ");
	}

	public function akhirAbsenAdmin($siswa, $key)
	{
		if ($siswa != "") {
			return $this->db->query("SELECT tb_absensi.* FROM tb_absensi JOIN tb_tempat_rekomendasi ON tb_tempat_rekomendasi.nama_perusahaan = tb_absensi.perusahaan JOIN tb_tempat_siswa ON tb_tempat_siswa.id_rekomendasi = tb_tempat_rekomendasi.id_rekomendasi WHERE siswa = '$siswa' GROUP BY id_absen")->result();
		} else {
			return $this->db->query("SELECT tb_absensi.* FROM tb_absensi JOIN tb_tempat_rekomendasi ON tb_tempat_rekomendasi.nama_perusahaan = tb_absensi.perusahaan JOIN tb_tempat_siswa ON tb_tempat_siswa.id_rekomendasi = tb_tempat_rekomendasi.id_rekomendasi WHERE jurusan = '$key' GROUP BY id_absen")->result();
		}
	}

	public function akhir($siswa, $key)
	{
		if ($siswa != "") {
			return $this->db->query("SELECT tb_absensi.* FROM tb_absensi JOIN tb_tempat_rekomendasi ON tb_tempat_rekomendasi.nama_perusahaan = tb_absensi.perusahaan JOIN tb_tempat_siswa ON tb_tempat_siswa.id_rekomendasi = tb_tempat_rekomendasi.id_rekomendasi JOIN tb_guru ON tb_guru.id_guru = tb_tempat_siswa.id_guru WHERE tb_guru.user = '".$this->session->userdata('guru')."' AND siswa = '$siswa' ")->result();
		} 
	}

	// START FUNCTION GURU 
	public function getGuru($key, $perPage, $offset)
	{
		if ($key != "") {
			return $this->db->query("SELECT * FROM tb_guru WHERE nama LIKE '%" . $key . "%' ")->result();
		} else {
			return $this->db->get('tb_guru', $perPage, $offset)->result();
		}
	}

	public function addGuru($data)
	{
		$this->db->insert('tb_guru', $data);
	}

	public function satu_guru($dimana)
	{
		return $this->db->get_where('tb_guru', $dimana)->result();
	}
	public function updateGuru($dimana, $data)
	{
		$this->db->where($dimana);
		$this->db->update('tb_guru', $data);
	}
	// START FUNCTION MONITORING
	public function monitoring($key, $perPage, $offset)
	{
		if ($key != "") {
			return $this->db->query("SELECT * FROM tb_monitoring INNER JOIN tb_guru ON tb_monitoring.id_guru = tb_guru.id_guru INNER JOIN tb_siswa ON tb_monitoring.id_siswa = tb_siswa.id_siswa WHERE nama LIKE '%" . $key . "%' ")->result();
		} else {
			return $this->db->query("SELECT * FROM tb_monitoring INNER JOIN tb_guru ON tb_monitoring.id_guru = tb_guru.id_guru INNER JOIN tb_siswa ON tb_monitoring.id_siswa = tb_siswa.id_siswa LIMIT $offset, $perPage")->result();
		}
	}
	public function pindah($id)
	{
		return $this->db->query("SELECT * FROM tb_tempat_siswa INNER JOIN tb_siswa ON tb_tempat_siswa.id_siswa = tb_siswa.id_siswa WHERE nis = '$id' ")->result();
	}
	// START FUNCTION NILAI SISWA
	public function nilai($key)
	{
		if ($key != "") {
			return $this->db->query("SELECT * FROM tb_tempat_siswa INNER JOIN tb_siswa ON tb_tempat_siswa.id_siswa = tb_siswa.id_siswa JOIN tb_tempat_rekomendasi ON tb_tempat_rekomendasi.id_rekomendasi = tb_tempat_siswa.id_rekomendasi WHERE nama_siswa LIKE '%" . $key . "%' ")->result();
		} else {
			return $this->db->query("SELECT * FROM tb_tempat_siswa INNER JOIN tb_siswa ON tb_tempat_siswa.id_siswa = tb_siswa.id_siswa JOIN tb_tempat_rekomendasi ON tb_tempat_rekomendasi.id_rekomendasi = tb_tempat_siswa.id_rekomendasi")->result();
		}
	}
	public function updateNilai($dimana, $data)
	{
		$this->db->where($dimana);
		$this->db->update('tb_nilai', $data);
	}

	public function tambahPesan($table, $data)
	{
		$this->db->insert($table, $data);
	}
	public function ubahDataNilaiSiswa()
	{
		$data = [
			"kerajinan" => $this->input->post('kera'),
			"prestasi" => $this->input->post('prestasi'),
			"disiplin" => $this->input->post('disiplin'),
			"kerjasama" => $this->input->post('kerjasama'),
			"inisiatif" => $this->input->post('inisiatif'),
			"tanggung_jawab" => $this->input->post('tanggung'),
			"ujian_prakerin" => $this->input->post('ujian')

		];
		$this->db->where('id_nilai', $this->input->post('id'));
		$this->db->update('tb_nilai', $data);
	}
	public function getSiswaById($id)
	{
		return $this->db->get_where('tb_nilai', ['id_nilai' => $id])->result();
	}

	public function showJoinDataSiswa($id)
	{

		$this->db->select('*');
		$this->db->from('tb_nilai');
		$this->db->join('tb_siswa', 'tb_nilai.id_siswa = tb_siswa.id_siswa');
		$this->db->join('tb_tempat_siswa', 'tb_nilai.id_siswa = tb_tempat_siswa.id_siswa');
		$this->db->join('tb_tempat_rekomendasi', 'tb_tempat_siswa.id_rekomendasi = tb_tempat_rekomendasi.id_rekomendasi');
		$this->db->where('id_nilai', $id);
		return $this->db->get();
	}

	public function getNilaiSiswaById($id)
	{
		return $this->db->get_where('tb_nilai', ['id_nilai' => $id])->result();
	}
	public function showCetakNilai($data)
	{
		return $this->db->get_where('tb_absensi', $data)->result();
	}

	public function tambahWaktuPKL($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function waktuTer($table, $dimana)
	{
		return $this->db->get_where($table, $dimana);
	}

	public function updateWaktuPKL($data, $dimana)
	{
		$this->db->where($dimana);
		$this->db->update('tb_periode', $data);
	}

	public function deleteWaktuPKL($dimana)
	{
		$this->db->where($dimana);
		$this->db->delete('tb_periode');
	}

	public function sekolahTer($table, $dimana)
	{
		return $this->db->get_where($table, $dimana);
	}

	public function updateProfilSekolah($data, $dimana){
		$this->db->where($dimana);
		$this->db->update('tb_sekolah', $data);
	}

	public function updateStatusPKL($data, $dimana){
		$this->db->where($dimana);
		$this->db->update('tb_sementara', $data);
	}
}
