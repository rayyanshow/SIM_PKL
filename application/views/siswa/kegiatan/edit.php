
<div class="container" id="menu-oy">
    <div class="row col-md-12">
        <div class="col-md-12">
            <div class="mb-3">
                <div class="card" id="kotak" style="margin-top: 3%; ">
                    <div class="card-header">
                        <a href="<?php echo site_url('Siswa/kegiatan')?>" class="btn"> <span class="ni ni-bold-left"></span> Kembali</a>
                    </div>
                    <div class="card-body">
                        <h3><strong>Tambah Kegiatan</strong><br></h3>

                        <form action="<?php echo site_url('Siswa/doEditKegiatan') ?>" method="post" enctype="multipart/form-data">
                        <?php foreach($kegiatan as $data){ ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label>Nama Kegiatan</label>
                                        <div class="input-group input-group-alternative mb-4">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-archive-2"></i></span>
                                            </div>
                                            <input class="form-control form-control-alternative" placeholder="Masukkan Nama Kegiatan" type="text" value="<?php echo $data->nama_kegiatan?>" name="nama_kegiatan" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label>Tanggal Kegiatan</label>
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-watch-time"></i></span>
                                        </div>
                                        <input class="form-control form-control-alternative"  type="date" name="tgl_kegiatan" value="<?php echo $data->tgl_kegiatan?>" required>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label>Deskripsi Kegiatan</label>
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-align-left-2"></i></span>
                                        </div>
                                        <input class="form-control form-control-alternative" placeholder="Masukkan Deskripsi Kegiatan" type="text" value="<?php echo $data->deskripsi_kegiatan?>" name="deskripsi_kegiatan" required>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label>Upload Bukti Kegiatan</label>
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-folder-17"></i></span>
                                        </div>
                                        <input class="form-control form-control-alternative" placeholder="Masukkan Deskripsi Kegiatan" type="file" name="bukti_kegiatan" >
                                        <input type="hidden" name="id_kegiatan" value="<?php echo $data->id_kegiatan?>" required>
                                        <input type="hidden" name="bukti" value="<?php echo $data->bukti_kegiatan?>" required>
                                    </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    
                                </div>
                            </div>
                        <?php }?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>


