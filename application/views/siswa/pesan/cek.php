<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg mt--1" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-1">
                            <a class="navbar-brand" href="<?= base_url('siswa/') ?>" style="color: #f56e61;"><i class="ni ni-bold-left mt-2"></i></a>
                        </div>
                        <div class="col-1">
                            <img src="<?= base_url('assets/img/man.png') ?>" class="img-rounded" width="50" height="50">
                        </div>
                        <div class="col-6">
                            <h4 style="margin-top: 15px;">Admin</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="isi-chat mt-7 pb-6">
                        <?php foreach ($pesan_admin as $pa) : ?>
                            <?php
                            $sis    = $this->session->userdata('user');
                            $cekTab = $this->db->query("SELECT * FROM tb_siswa WHERE user = '$sis' ");
                            $pecah  = $cekTab->row();
                            $id     = $pecah->id_siswa;
                            $admin  = $this->db->query("SELECT * FROM tb_chat WHERE kepada = 'admin' AND id_siswa = '$id' ");
                            $siswa  = $this->db->query("SELECT * FROM tb_chat WHERE kepada = 'siswa' AND id_siswa = '$id' ")->result();

                            ?>

                            <?php if ($pa->kepada === 'admin') { ?>
                                <div class="row">
                                    <div class="col">
                                        <p class="pesan-siswa"><?= $pa->pesan; ?></p>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="row">
                                    <div class="col">
                                        <p class="pesan-admin"><?= $pa->pesan; ?></p>
                                    </div>
                                </div>
                            <?php } ?>



                        <?php endforeach; ?>

                    </div>
                </div>
                <div class="card-footer">
                    <form action="<?= base_url('siswa/kepadaAdmin') ?>" method="POST">
                        <!-- Hidden data -->
                        <?php
                        $siswa      = $this->session->userdata('user');
                        $idSiswa    = $this->db->query("SELECT * FROM tb_siswa WHERE user = '$siswa' ");
                        $pecah      = $idSiswa->row();
                        ?>
                        <input type="hidden" value="<?= $pecah->id_siswa; ?>" name="siswa">
                        <input type="hidden" value="admin" name="kepada">
                        <div class="row">
                            <div class="col-11 pt-2">
                                <input type="text" name="chat" placeholder="Ketikan pesan ..." class="pl-4 ml-2" id="input-chat" autocomplete="off" required>
                            </div>
                            <div class="col-1 pt-1 mb--2" >
                                <button type="submit" id="btn-kirim" class="ml--3"><i class="ni ni-send pt-1"></i></button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <!-- <div style="overflow-x: hidden;">
                <nav class="navbar fixed-top navbar-light bg-light" style="box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);">

                </nav>

                <div class="fixed-bottom pt-3">

                </div>
            </div> -->
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#exampleModal').modal('show');
    });
</script>