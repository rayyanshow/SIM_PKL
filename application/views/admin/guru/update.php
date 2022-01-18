<!-- Modal -->
<?php echo form_open_multipart('admin/doUpdateGuru') ?>
<?php foreach ($update as $u) : ?>
    <input type="hidden" value="<?= $u->id_guru ?>" name="id">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Masukan Data</h5>
                </div>
                <div class="modal-body">
                    <?php
                    $guru   = $this->session->userdata('guru');
                    $ambil  = $this->db->query("SELECT * FROM tb_guru WHERE user = '$guru' ");
                    $pecah  = $ambil->row();
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-alternative" value="<?= $u->nama ?>" name="nama">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-alternative" value="<?= $u->user ?>" name="user">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-alternative" value="<?= $u->pass ?>" name="pass">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <a href="<?= base_url('admin/daftarGuru') ?>" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</form>


<script>
    $(document).ready(function() {
        $('#exampleModal').modal('show');
    });
</script>