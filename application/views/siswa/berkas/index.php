
<div class="container" id="menu-oy">
    <div class="row col-md-12">
        <div class="col-md-12">
            <div class="mb-3">
                <div class="card" id="kotak" style="margin-top: 3%; ">
                    <div class="card-header">
                        <h1>Berkas Prakerin</h1>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Berkas</th>
                                <th>Download</th>
                            </tr>
                            <?php 
                                $no = 1;
                                foreach($berkas as $data){
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data->nama_berkas ?></td>
                                <td><a href="<?php echo site_url('Siswa/downloadBerkas/'.$data->file_berkas)?>" class="btn btn-primary"> LINK </a></th>
                            </tr>
                            <?php }?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>


