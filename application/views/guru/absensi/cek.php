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
                                    <span class="mb-0 text-sm  font-weight-bold">Selamat Datang, <b><?php echo $this->session->userdata('nama') ?></b></span>
                                <?php } else { ?>
                                    <span class="mb-0 text-sm  font-weight-bold">*Selamat Datang, <b><?php echo $this->session->userdata('nama') ?></b></span>
                                <?php } ?>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        
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
        <div class="row">
            <div class="col-md-12 ml-4">
                

            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-1"></div>
            <div class="col-10 mt-3">
                <div class="card shadow">
                    <div class="card-header">
                        <a href="<?php echo site_url('guru/absensi')?>" > <span class="ni ni-bold-left"> </span> Kembali</a>
                    </div>
                    <div class="card-body">
                    
                    <?php 
                    if(count($cek->result()) > 0){
                    foreach ($cek->result() as $d) : ?>
                    <!-- Hidden data -->
                    <input type="hidden" value="<?= $d->id_siswa ?>" name="id">
                    dsadas
                    <div class="row">
                        <div class="col-3">Nama</div>
                        <div class="col-2">:</div>
                        <div class="col-7 text-uppercase"><b><?= $d->nama_siswa;  ?></b></div>
                    </div>
                    <div class="row">
                        <div class="col-3">Nama Instansi</div>
                        <div class="col-2">:</div>
                        <div class="col-7 text-uppercase"><b><?= $d->nama_perusahaan;  ?></b></div>
                    </div>
                    <div class="row">
                        <div class="col-3">Alamat Instansi</div>
                        <div class="col-2">:</div>
                        <div class="col-7"><?= $d->alamat;  ?></div>
                    </div>
                    <div class="row">
                        <div class="col-3">Kelas</div>
                        <div class="col-2">:</div>
                        <div class="col-7"><?= $d->kelas;  ?></div>
                    </div><br>
                    <?php endforeach; ?>
                    <hr>
                    <?php foreach ($absen as $ab) : ?>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                Tahun
                            </div>
                        </div>
                        <div class="col-md-1">
                            :
                        </div>
                        <div class="col-md-3">
                            <?= $ab->tahun; ?>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                Bulan
                            </div>
                        </div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-3 text-uppercase">
                            <b><?= $ab->bulan; ?></b>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            Masuk Pkl
                        </div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-3">
                            <?= $ab->masuk; ?>
                        </div>
                        <div class="col-md-2">
                            Ijin
                        </div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-3">
                            <?= $ab->ijin; ?>
                        </div>
                    </div>

                    <div class="row mt-4 mb-4">
                        <div class="col-md-2">
                            Sakit
                        </div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-3">
                            <?= $ab->sakit; ?>
                        </div>
                        
                    </div>
                    <hr>

                    <?php endforeach; }else{ ?>
                        Absensi belum di input oleh admin
                        <?php }?>
                    </div>
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