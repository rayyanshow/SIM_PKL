<?php

// $session = $this->session->userdata('nama_siswa');
// $select  = $this->db->query("SELECT * FROM tb_siswa INNER JOIN tb_jurusan ON tb_siswa.jurusan = tb_jurusan.nama_singkat WHERE user = '$session' ");
// $r   = $select->row();

if ($this->session->tempdata('update_profile') == TRUE) { ?>
<script>
	Swal.fire({
		type: 'success',
		title: 'Update Berhasil!',
		text: '<?php echo $this->session->tempdata('update_profile') ?>'
	});
</script>
<?php } ?>
<style>
	.modal-backdrop {
		position: static;
	}
</style>


    <div class="container" id="menu-oy">
        <div class="row col-md-12">
			<?php foreach ($rekomendasi as $r) : ?>
			<div class="col-md-4">
				<div class="back-rekomendasi" style="margin-top: 10%;">
					<h4 class="text-center pt-5 mb--5" style="color: #000000; font-family: 'exo';">TEMPAT REKOMENDASI</h4>
				</div>

				<div class="mb-3">
					<div class="col-11" style="margin-left: 4%;">
							
						<div class="card" id="kotak" style="margin-top: 10%; ">
							<div class="card-body">

								<img src="<?php echo base_url('assets/uploads/tempat-rekomendasi/') . $r->foto ?>" alt="Foto Profile siswa" class="img-thumbnail" style="width: 400px; height: 155px; margin-top: -25%;">
								<h4 class="text-center mt-3" style="color: #148ba0; text-transform: uppercase; "><?= substr($r->nama_perusahaan, 0, 20) ?></h4>

							</div>

							<div class="row">
								<div class="col-11 ml-3">

									<!-- Visi -->
									<div class="row">
										<div class="col-2"></div>
										<div class="col-8">
											<p class="text-center" id="alamat2"><i class="ni ni-building"></i> Visi</p>

										</div>

									</div>

									<div class="row">
										<div class="col">
											<p class="ml-4"><?php echo $r->visi ?></p>
										</div>
									</div>
									<!-- Misi -->
									<div class="row">
										<div class="col-2"></div>
										<div class="col-8">
											<p class="text-center" id="alamat3"><i class="fa fa-building"></i> Misi</p>

										</div>

									</div>

									<div class="row">
										<div class="col">
											<p class="ml-4"><?php echo $r->misi ?></p>
										</div>
									</div>
									<!-- Alamat -->
									<div class="row">
										<div class="col-2"></div>
										<div class="col-8">
											<p class="text-center" id="alamat"><i class="ni ni-pin-3"></i> Alamat</p>

										</div>

									</div>
									<div class="row">
										<div class="col">
											<p class="ml-4"><?php echo $r->alamat ?></p>
										</div>
									</div>


								</div>
							</div>


							<div class="row ml-4 mr-2">
								<?php
									$ro		 = $r->jurusan_perusahaan;
									$jurusan = explode(',', $ro);
									$jumlah	 = count($jurusan);
									for ($i = 0; $i < $jumlah; $i++) {

										?>
								<div class="col-4 mt-1 mb-1 ">
									<span class="badge badge-pill badge-info" data-toggle="popover" data-color="info" data-placement="top" data-content="This is a very beautiful popover, show some love."><i class="ni ni-hat-3"></i> <?php echo $jurusan[$i] ?></span>
								</div>
								<?php } ?>
							</div>

							<div class="row">
								<a href="<?php echo base_url('siswa/tambahRekomen/') . $r->id_rekomendasi ?>" class="tombol"><i class="ni ni-send"></i> Daftar</a>
							</div>
						</div>
						</form>
					</div>
				</div>
            </div>
			
			<?php endforeach; ?>
			
        </div>
		
		<?php echo $halaman; ?>
		<br>
    </div>

