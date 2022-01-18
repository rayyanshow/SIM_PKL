<?php if ($this->session->tempdata('input_nilai') == TRUE) : ?>
  <script>
    Swal.fire({
      type: 'success',
      title: 'Berhasil Ditambah!',
      text: '<?php echo $this->session->tempdata('input_nilai') ?>'
    });
  </script>
  <?php
  $url = $_SERVER['REQUEST_URI'];
  header("Refresh: 2; URL=$url");
endif; ?>

<?php if ($this->session->tempdata('update_nilai') == TRUE) : ?>
  <script>
    Swal.fire({
      type: 'success',
      title: 'Berhasil Diupdate!',
      text: '<?php echo $this->session->tempdata('update_nilai') ?>'
    });
  </script>
  <?php
  $url = $_SERVER['REQUEST_URI'];
  header("Refresh: 2; URL=$url");
endif; ?>
<div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="">Dashboard</a>

            <!-- User -->
            <ul class="navbar-nav align-items-center d-none d-md-flex">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">

                            <div class="media-body ml-2 d-none d-lg-block">
                                <?php
                                $cek    = $this->db->get_where('tb_sementara', array('status_pkl' => 0));
                                $baris  = $cek->num_rows();

                                if ($baris == 0) {
                                    ?>
                                    <span class="mb-0 text-sm  font-weight-bold">Selamat Datang, <b><?php echo $this->session->userdata('industri') ?></b></span>
                                <?php } else { ?>
                                    <span class="mb-0 text-sm  font-weight-bold">*Selamat Datang, <b><?php echo $this->session->userdata('industri') ?></b></span>
                                <?php } ?>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        <a href="<?php echo base_url('admin/notif') ?>" class="dropdown-item">
                            <i class="ni ni-notification-70"></i>
                            <span>Notifikasi (<?php echo $baris; ?>)</span>
                        </a>
                        <a href="<?php echo base_url('login/logout') ?>" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header bg-gradient-info pt-5 pt-md-8">
        <form action="<?= base_url('industri/nilaiSiswa') ?>" method="POST">
            <div class="row">
                <div class="col-md-6 ml-4">

                    <div class="form-group">
                        <div class="input-group input-group-alternative mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                            </div>
                            <input class="form-control form-control-alternative" placeholder="Cari nama siswa" type="text" name="key">
                        </div>
                    </div>

                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
                <div class="col-md-2">
                    <a href="<?= base_url('industri/nilaiSiswa') ?>" class="btn btn-warning">Reset Cari</a>
                </div>
            </div>
        </form>
    </div>


    <div class="row">
        <div class="col-1"></div>
        <div class="col-10 mt-3">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <?php
                            error_reporting(0);
                            ?>
                            <?php foreach ($akhir as $b) : ?>

                            <?php endforeach; ?>
                            <h3 class="mb-0">Daftar Nilai <b><?= @$b->jurusan ?></b></h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <div>
                        <table class="table align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">
                                        No
                                    </th>
                                    <th scope="col">
                                        Nama Siswa
                                    </th>
                                    <th scope="col">
                                        Status Penilaian
                                    </th>
                                    <th scope="col">
                                        Aksi
                                    </th>

                                </tr>
                            </thead>

                            <tbody class="list">
                                <?php $no = $offset;
                                foreach ($nilai as $a) : ?>
                                    <tr>
                                        <td><?= ++$no; ?></td>
                                        <th scope="row" class="name">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="mb-0 text-sm"><?= $a->nama_siswa ?></span>
                                                </div>
                                            </div>
                                        </th>
                                        <?php 
                                            $query = $this->db->get_where('tb_nilai', array('id_siswa' => $a->id_siswa))->result();

                                            if(count($query) == 0){
                                                $status_penilaian = '<span class="badge badge-warning">Belum Dinilai</span>';
                                            }else{
                                                $status_penilaian = '<span class="badge badge-success">Sudah Dinilai</span>';
                                            }
                                        ?>
                                        <th scope="row" class="name">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="mb-0 text-sm"><?= $status_penilaian ?></span>
                                                </div>
                                            </div>
                                        </th>
                                        <td scope="row" class="name">
                                            <a href="<?php echo site_url('industri/inputNilai/'.$a->id_siswa)?>" class="btn btn-default">Isi Nilai</a>
                                        </td>
                                        
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <?= $halaman; ?>
            </div>

        </div>
    </div>
</div>


<script>
    // $(document).ready(function() {
    //     $('#cari').click(function() {
    //         $('#ju').css('display', 'none');
    //     });
    // });
</script>