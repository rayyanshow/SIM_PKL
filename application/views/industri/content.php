<div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="">Dashboard</a>
        <!-- Form -->
        <!-- <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Search" type="text">
            </div>
          </div>
        </form> -->
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                
                <div class="media-body ml-2 d-none d-lg-block">
                  <?php 
                    $this->db->select('*');
                    $this->db->from('tb_sementara');
                    $this->db->join('tb_tempat_rekomendasi', 'tb_tempat_rekomendasi.id_rekomendasi = tb_sementara.id_rekomendasi');
                    $this->db->where('tb_tempat_rekomendasi.user', $this->session->userdata('industri'));
                    $this->db->where('status_pkl', 1);
                    $cek    = $this->db->get();
                    $baris  = $cek->num_rows();

                    if($baris == 0){
                  ?>
                  <span class="mb-0 text-sm  font-weight-bold">Selamat Datang, <b><?php echo $this->session->userdata('industri') ?></b></span>
                  <?php } else { ?>
                    <span class="mb-0 text-sm  font-weight-bold">*Selamat Datang, <b><?php echo $this->session->userdata('industri') ?></b></span>
                  <?php } ?>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <a href="<?php echo base_url('industri/notif') ?>" class="dropdown-item">
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
    <div class="header bg-gradient-info pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <a href="<?php echo base_url('industri/daftarSiswa') ?>">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Daftar Siswa</h5>
                      <?php 
                        $get = $this->db->select('*')->from('tb_tempat_siswa')->join('tb_tempat_rekomendasi', 'tb_tempat_rekomendasi.id_rekomendasi = tb_tempat_siswa.id_rekomendasi')->where('tb_tempat_rekomendasi.user', $this->session->userdata('industri'))->group_by('id_siswa')->get();
                        $rows = $get->num_rows(); 
                      ?>
                      <span class="h2 font-weight-bold mb-0"><?php echo $rows; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-address-book"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm"><i>Berisi daftar siswa prakerin</i><br>
                    <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span> -->
                  </p>
                </a>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <a href="<?php echo base_url('industri/daftarGuru') ?>">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Daftar Guru</h5>
                      <?php 
                        $get = $this->db->select('*')->from('tb_tempat_siswa')->join('tb_tempat_rekomendasi', 'tb_tempat_rekomendasi.id_rekomendasi = tb_tempat_siswa.id_rekomendasi')->where('tb_tempat_rekomendasi.user', $this->session->userdata('industri'))->group_by('id_guru')->get();
                        $rows = $get->num_rows(); 
                      ?>
                      <span class="h2 font-weight-bold mb-0"><?php echo $rows; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                        <i class="fas fa-address-book"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm"><i>Berisi daftar guru pendamping</i> <br>
                    <!-- <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>!--
                    <span class="text-nowrap">Since last week</span>  !-->
                  </p>
                  </a>                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid mt--7">
      <!-- Footer -->
      <!-- <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2018 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
            </div>
          </div>
          <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
              </li>
            </ul>
          </div>
        </div>
      </footer> -->
    </div>
  </div>