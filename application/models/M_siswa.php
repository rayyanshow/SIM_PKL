<?php

class M_siswa extends CI_Model
{

	// FUNCTION SELECT SEMUA DATA
	public function select($table)
	{
		return $this->db->get($table)->result();
	}

	public function pagination($table, $perPage, $offset)
	{
		return $this->db->get($table, $perPage, $offset)->result();
	}

	// FUNCTION UPDATE
	public function update($dimana, $data, $table)
	{
		$this->db->where($dimana);
		$this->db->update($table, $data);
	}

	// FUNCTION SELECT SATU DATA
	public function get_satu($table, $dimana)
	{
		return $this->db->get_where($table, $dimana)->result();
	}

	public function getPKLSiswa($table, $dimana)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join('tb_tempat_rekomendasi', 'tb_tempat_rekomendasi.id_rekomendasi = tb_tempat_siswa.id_rekomendasi');
		$this->db->join('tb_siswa', 'tb_siswa.id_siswa = tb_tempat_siswa.id_siswa');
		$this->db->where('tb_tempat_siswa.id_siswa', $dimana);
		return $this->db->get()->result();
	}
	
	public function get_profile($dimana)
	{
		return $this->db->get_where('tb_siswa', $dimana)->result();
	}

	// FUNCTION INSERT BIASA

	public function tambah($table, $data)
	{
		return $this->db->insert($table, $data);
	}

	public function satNot($dimana)
	{
		return $this->db->get_where('tb_notif', $dimana);
	}

	public function insert($data)
	{
		$this->db->insert('tb_absensi', $data);
		return $this->db->insert_id();
	}

	public function get_guru($tabel)
	{
		return $this->db->get($tabel)->result();
	}

	public function get_periode($tabel, $dimana)
	{
		$this->db->select('*');
		$this->db->from($tabel);
		$this->db->where($dimana);
		$this->db->order_by('id_periode', 'desc');
		$this->db->limit(1);
		return $this->db->get()->result();
	}

	public function getBerkas(){
		return $this->db->get('tb_berkas');
	}

	public function getKegiatan(){
		$this->db->select('tb_kegiatan.*, tb_siswa.user as user_siswa');
		$this->db->from('tb_kegiatan');
		$this->db->join('tb_siswa', 'tb_siswa.id_siswa = tb_kegiatan.id_siswa');
		$this->db->where('tb_siswa.user', $this->session->userdata('user'));
		return $this->db->get();
	}

	public function getKegiatanByUser($id_siswa){
		return $this->db->get_where('tb_tempat_siswa', array('id_siswa' => $id_siswa));
	}

	public function tambahKegiatan($data){
		$this->db->insert('tb_kegiatan', $data);
	}

	public function getKegiatanById($id_kegiatan){
		return $this->db->get_where('tb_kegiatan', array('id_kegiatan' => $id_kegiatan));
	}

	public function editKegiatan($data, $where){
		$this->db->set($data);
		$this->db->where($where);
		$this->db->update('tb_kegiatan');
	}

	public function deleteKegiatan($id_kegiatan){
		$this->db->where('id_kegiatan', $id_kegiatan);
		$this->db->delete('tb_kegiatan');
	}

	public function getNilai(){
		return $this->db->select('*')->from('tb_nilai')->join('tb_siswa', 'tb_siswa.id_siswa = tb_nilai.id_siswa')->where('tb_siswa.user', $this->session->userdata('user'))->get()->result();
	}
}
