
<div class="container" id="menu-oy">
    <div class="row col-md-12">
        <div class="col-md-12">
            <div class="mb-3">
                <div class="card" id="kotak" style="margin-top: 3%; ">
                    <div class="card-header">
                        Nilai PKL mu
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <tr>
                                <th>No</th>
                                <th>Kerajinan</th>
                                <th>Prestasi</th>
                                <th>Disiplin</th>
                                <th>Kerjasama</th>
                                <th>Inisiatif</th>
                                <th>Tanggung Jawab</th>
                                <th>Ujian Prakerin</th>
                            </tr>
                            <?php $no= 1; foreach($nilai as $data){?>
                            <tr>
                                <td><?php echo $no++?></td>
                                <td><?php echo $data->kerajinan?></td>
                                <td><?php echo $data->prestasi?></td>
                                <td><?php echo $data->disiplin?></td>
                                <td><?php echo $data->kerjasama?></td>
                                <td><?php echo $data->inisiatif?></td>
                                <td><?php echo $data->tanggung_jawab?></td>
                                <td><?php echo $data->ujian_prakerin?></td>
                            </tr>
                            <?php }?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>


