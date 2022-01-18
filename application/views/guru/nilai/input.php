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
                                    <span class="mb-0 text-sm  font-weight-bold">Selamat Datang, <b><?php echo $this->session->userdata('guru') ?></b></span>
                                <?php } else { ?>
                                    <span class="mb-0 text-sm  font-weight-bold">*Selamat Datang, <b><?php echo $this->session->userdata('guru') ?></b></span>
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
                        <a href="<?php echo site_url('guru/nilai')?>" > <span class="ni ni-bold-left"> </span> Kembali</a>
                    </div>
                    <div class="card-body">
                    <form action="<?= base_url('guru/doEditNilai') ?>" method="post">
                        <?php foreach($dataNilai as $n){?>
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Input Nilai Siswa</h5>

                            </div>
                            <div class="modal-body">
                                <?php foreach ($nilai as $d) : ?>
                                    <!-- Hidden data -->
                                    <input type="hidden" value="<?= $n->id_nilai ?>" name="id_nilai">
                                    <div class="row">
                                        <div class="col-md-3">Nama</div>
                                        <div class="col">: <?= $d->nama_siswa;  ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">Nama Instansi</div>
                                        <div class="col text-uppercase">: <?= $d->nama_perusahaan;  ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">Alamat Instansi</div>
                                        <div class="col">: <?= $d->alamat;  ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">Kelas</div>
                                        <div class="col">: <?= $d->kelas;  ?></div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                Kerajinan
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" value="<?php echo $n->kerajinan?>" class="form-control" min=0  readonly name="kerajinan">
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                Prestasi
                                            </div>
                                        </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="number" class="form-control" value="<?php echo $n->prestasi?>" min=0 readonly name="prestasi">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            Disiplin
                                        </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control" min=0 value="<?php echo $n->disiplin?>" readonly name="disiplin">
                                        </div>
                                        <div class="col-md-2">
                                            Kerjasama
                                        </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control" min=0 value="<?php echo $n->kerjasama?>" readonly name="kerjasama">
                                        </div>
                                        <div class="col-md-2">
                                            Inisiatif
                                        </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-3">
                                            <input type="number" min=0 class="form-control" value="<?php echo $n->inisiatif?>" readonly name="inisiatif">
                                        </div>
                                        <div class="col-md-2">
                                            Tanggung Jawab
                                        </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control" min=0 value="<?php echo $n->tanggung_jawab?>" readonly name="tanggung_jawab">
                                        </div>

                                        <div class="col-md-2">
                                            Nilai Ujian
                                        </div>
                                        <div class="col-md-1">:</div>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control" min=0 name="ujian" required>
                                        </div>
                                    </div>
                                    <p>* Keterangan Nilai Teknis *</p>
                        <p>96 - 100 = A</p>
                        <p>91 - 95 = A-</p>
                        <p>86 - 90 = B+</p>
                        <p>81 - 85 = B</p>
                        <p>75 - 80 = B-</p>
                </div>
                                </div>
                                
                            <?php endforeach; ?>


                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                        <?php }?>
                    </div>
                </div>

            </div>
        </div>

</div>
