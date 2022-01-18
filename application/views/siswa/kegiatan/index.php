<?php if ($this->session->tempdata('tambah_kegiatan') == TRUE) : ?>
  <script>
    Swal.fire({
      type: 'success',
      title: 'Berhasil Ditambah!',
      text: '<?php echo $this->session->tempdata('insert_kegiatan') ?>'
    });
  </script>
  <?php
  $url = $_SERVER['REQUEST_URI'];
  header("Refresh: 2; URL=$url");
endif; ?>

<?php if ($this->session->tempdata('update_kegiatan') == TRUE) : ?>
  <script>
    Swal.fire({
      type: 'success',
      title: 'Berhasil Diupdate!',
      text: '<?php echo $this->session->tempdata('update_kegiatan') ?>'
    });
  </script>
  <?php
  $url = $_SERVER['REQUEST_URI'];
  header("Refresh: 2; URL=$url");
endif; ?>

<?php if ($this->session->tempdata('delete_kegiatan') == TRUE) : ?>
  <script>
    Swal.fire({
      type: 'success',
      title: 'Berhasil Dihapus!',
      text: '<?php echo $this->session->tempdata('delete_kegiatan') ?>'
    });
  </script>
  <?php
  $url = $_SERVER['REQUEST_URI'];
  header("Refresh: 2; URL=$url");
endif; ?>

<div class="container" id="menu-oy">
    <div class="row col-md-12">
        <div class="col-md-12">
            <div class="mb-3">
                <div class="card" id="kotak" style="margin-top: 3%; ">
                    <div class="card-header">
                        <?php 
                            $sess       = $this->session->userdata('user');
                            $cekSes     = $this->db->query("SELECT * FROM tb_siswa WHERE user = '$sess' ");
                            $pecah      = $cekSes->row();
                            $id         = $pecah->id_siswa;
                        ?>
                        <a href="<?php echo site_url('Siswa/tambahKegiatan/'.$id)?>" class="btn btn-primary" >Tambah Kegiatan</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Deskripsi</th>
                                <th>Tanggal Kegiatan</th>
                                <th>Bukti Kegiatan</th>
                                <th>Aksi</th>
                            </tr>
                            <?php 
                                $no = 1;
                                foreach($kegiatan as $data){
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data->nama_kegiatan ?></td>
                                <td><?= $data->deskripsi_kegiatan ?></td>
                                <td><?= $data->tgl_kegiatan ?></td>
                                <td>
                                    <a href="<?= base_url('assets/uploads/kegiatan/') . $data->bukti_kegiatan; ?>" class="btn btn-primary" data-toggle="tooltip" data-original-title="Jessica Doe" data-lightbox="image-1" data-title="Bukti Absensi">
                                      Link
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-default" href="<?php echo base_url('siswa/editKegiatan/') . $data->id_kegiatan ?>">Edit</a>
                                    <a class="btn btn-danger" href="<?php echo base_url('siswa/deleteKegiatan/') . $data->id_kegiatan ?>" onclick="return confirm('Yakin?')">Hapus</a>   
                                </td>
                            </tr>
                            <?php }?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>


