<?php

if ($this->session->flashdata('login_gagal') == TRUE) { ?>
<script>
	Swal.fire({
		type: 'error',
		title: 'Login Gagal!',
		text: '<?php echo $this->session->flashdata('login_gagal'); ?>'
	});
</script>
<?php }

?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/argon-dashboard.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/js/plugins/nucleo/css/nucleo.css') ?>" />
	<link href="<?php echo base_url('assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/login.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/animate.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/fontawesome.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert2.css') ?>">

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="<?php echo base_url('assets/js/jquery.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/sweetalert.js') ?>"></script>

	<title>Halaman Login</title>
</head>

<body>
	<?php

	if ($this->session->tempdata('login_gagal') == TRUE) { ?>
	<script>
		Swal.fire({
			type: 'error',
			title: 'Login Gagal!',
			text: '<?php echo $this->session->tempdata('login_gagal'); ?>'
		});
	</script>
	<?php }

	?>

	<div class="garis-satu"></div>

	<div class="kotak">
		<?php 
          $getNamaSekolah = $this->db->get_where('tb_sekolah', array('id_sekolah' => 1))->result();
          foreach($getNamaSekolah as $data){
            $logo = $data->logo_sekolah;
          }
        ?>
		<div class="col-satu">
			<img src="<?= base_url('assets/img/'.$logo) ?>" alt="Foto Sekolah" id="foto-sekolah">
		</div>
		<form action="<?php echo base_url('login/CekLogin') ?>" method="POST">
			<div class="col-dua">
				<div class="cover">
					<p class="judul-login">Login!</p>
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10" id="input">
							<div class="form-group">
								<div class="input-group input-group-alternative mb-4">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="ni ni-circle-08"></i></span>
									</div>
									<input class="form-control form-control-alternative" placeholder="Username" type="text" name="user">
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10" id="input">
							<div class="form-group">
								<div class="input-group input-group-alternative mb-4">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="ni ni-key-25"></i></span>
									</div>
									<input class="form-control form-control-alternative" placeholder="Password" type="password" name="pass">
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-1"></div>
						<div class="col-10">
							<button type="submit" class="btn-login">Login</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

</body>

</html>