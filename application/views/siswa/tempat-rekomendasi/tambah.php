<!-- Modal -->
<div class="modal fade bd-example-modal-sm" id="modal-kepo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Unggah Bukti</h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-default" role="alert">
                    <strong>Informasi!</strong> Pastikan data terisi dengan benar, data yang sudah terisi tidak dapat diubah!
                </div>
                <?php echo form_open_multipart('siswa/tambahRekomendasi')  ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama Pemimpin Perusahaan</label>
                            <div class="input-group input-group-alternative mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                </div>
                                <input class="form-control form-control-alternative" placeholder=" Nama Pimpinan" type="text" name="pimpinan" data-toggle="popover" data-placement="top" data-content="Isi sesuai dengan nama pimpinan tempat prakerin kamu saat ini" value="<?= $rekomen[0]->nama_pimpinan;?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Guru Pendamping</label>
                            <div class="input-group input-group-alternative mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                </div>
                                <select class="form-control form-control-alternative" name="id_guru">
                                    <?php foreach($guru as $dGuru){ ?>
                                    <option value="<?php echo $dGuru->id_guru?>"><?php echo $dGuru->nama?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Periode PKL</label>
                            <div class="input-group input-group-alternative mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-watch-time"></i></span>
                                </div>
                                <select class="form-control form-control-alternative" name="id_periode">
                                    <?php foreach($periode as $dPeriode){ ?>
                                    <option value="<?php echo $dPeriode->id_periode?>"><?php echo $dPeriode->periode?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <?php
                    $user  = $this->session->userdata('user');
                    $ambil = $this->db->query("SELECT * FROM tb_siswa WHERE user = '$user' ");
                    $satu  = $ambil->row();
                    foreach ($rekomen as $r) :
                        ?>
                        <!-- Data Siswa Hidden -->
                        <input type="hidden" name="id" value="<?php echo $satu->id_siswa; ?>">
                        <input type="hidden" name="id_rekomendasi" value="<?php echo $r->id_rekomendasi ?>">
                        <input type="hidden" name="jurusan" value="<?php echo $r->jurusan_perusahaan; ?>">
                        <input type="hidden" name="alamat" value="<?php echo $r->alamat ?>">
                        <input type="hidden" name="cp" value="<?= $r->cp ?>">
                    
                    <?php endforeach; ?>
                </div>

            </div>
            <div class="modal-footer">
                <a href="<?php echo base_url('siswa/rekomendasi') ?>" class="btn btn-secondary">Tutup</a>
                <button type="submit" class=" btn btn-primary">Unggah</button>
            </div>
        </div>
        </form>


    </div>
</div>

<script>
    $(document).ready(function() {
        $('#modal-kepo').modal('show');
    });
</script>