<?php

if ($this->session->tempdata('login_guru') == TRUE) { ?>
    <script>
        Swal.fire({
            type: "success",
            title: "Selamat Datang!",
            text: "<?= $this->session->tempdata('login_guru') ?>"
        });
    </script>
    <?php $url = $_SERVER['REQUEST_URI'];
    header("Refresh: 1; URL=$url");
}
if ($this->session->tempdata('pesan') == TRUE) { ?>
    <script>
        Swal.fire({
            type: "success",
            title: "Selamat!",
            text: "<?= $this->session->tempdata('pesan') ?>"
        });
    </script>
    <?php $url = $_SERVER['REQUEST_URI'];
    header("Refresh: 1; URL=$url");
}
?>
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
                                $cek    = $this->db->get('tb_sementara');
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
                <form action="<?= base_url('guru') ?>" method="POST">
                    <div class="form-group">
                        <h3 style="text-transform: uppercase; border-bottom: 2px solid #fff; width: 50%; color: white; margin-bottom: 5%;">Monitoring siswa</h3>
                        <div class="row">
                            <div class="col-4" id="ju">
                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                        </div>
                                        <input class="form-control form-control-alternative" placeholder="Cari nama siswa" type="text" name="caro">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-info" id="cari" name="cari"><i class="ni ni-zoom-split-in"></i></button>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
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
                            <?php foreach ($guru as $b) : ?>

                            <?php endforeach; ?>
                            <h3 class="mb-0">Daftar Siswa Prakerin</h3>
                        </div>
                        <div class="col text-right">
                            <!-- <a href="#!" class="btn btn-sm btn-primary">See all</a> -->
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
                                        Jurusan
                                    </th>
                                    <th>Nama Perusahaan</th>

                                </tr>
                            </thead>

                            <tbody class="list">
                                <?php $no = 1;
                                foreach ($guru as $a) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <th scope="row" class="name">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="mb-0 text-sm"><?= $a->nama_siswa ?></span>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="budget">
                                            <?= $a->jurusan ?>
                                        </td>
                                        <td class="status">
                                            <?= $a->nama_perusahaan ?>
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