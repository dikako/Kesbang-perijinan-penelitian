<div class="page-header">
    <h2>Data Laporan Penelitian</h2>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Data
                <a href="#widget1" data-toggle="collapse"><span class="fa fa-chevron-down" style="float: right"></span>
                </a>
            </div>
            <div id="widget1" class="panel-body collapse in">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th width="20%">Kode Penelitian</th>
                            <th width="3%">:</th>
                            <th><?php if ($kode_penelitian != null){echo $kode_penelitian;}else {echo '-';}?></th>
                        </tr>
                        <tr>
                            <th>Judul Penelitian</th>
                            <th>:</th>
                            <th><?php if ($judul_penelitian != null ){ echo $judul_penelitian; } else {echo '-';}?></th>
                        </tr>
                        <tr>
                            <th>Nama Penanggung Jawab</th>
                            <th>:</th>
                            <th><?php if ($npj != null ){ echo $npj; } else { echo '-'; }?></th>
                        </tr>
                        <tr>
                            <th>Tahun Penelitian</th>
                            <th>:</th>
                            <th><?php if ($tahun_penelitian != null ){ echo $tahun_penelitian; } else{echo '-';}?></th>
                        </tr>
                        <tr>
                            <th>Nama Instansi</th>
                            <th>:</th>
                            <th><?php if ($nama_instansi != null ){ echo $nama_instansi; } else{echo '-';}?></th>
                        </tr>
                        <tr>
                            <th>Alamat Instansi</th>
                            <th>:</th>
                            <th><?php if ($alamat_instansi != null ){ echo $alamat_instansi; } else{echo '-';}?></th>
                        </tr>
                        <tr>
                            <th>Pendanaan</th>
                            <th>:</th>
                            <th><?php if ($pendanaan != null ){ echo $pendanaan; } else{echo '-';}?></th>
                        </tr>
                        <tr>
                            <th>Tanggal Terima</th>
                            <th>:</th>
                            <th><?php if ($tgl_terima != null ){ echo $tgl_terima; } else{echo '-';}?></th>
                        </tr>
                        <tr>
                            <th>Nomor Induk</th>
                            <th>:</th>
                            <th><?php if ($nomor_induk != null ){ echo $nomor_induk; } else{echo '-';}?></th>
                        </tr>
                        <tr>
                            <th>Hadiah Tukar</th>
                            <th>:</th>
                            <th><?php if ($hadiah_tukar != null ){ echo $hadiah_tukar; } else{echo '-';}?></th>
                        </tr>
                        <tr>
                            <th>PDF</th>
                            <th>:</th>
                            <th><?php if ($pdf != null ){ echo $pdf; } else{echo '-';}?></th>
                        </tr>
                    </table>
                    <a href="<?php echo base_url('assets/pdf/'.$tahun_penelitian.'/'.$pdf)?>"><button class="btn btn-danger"><span class="fa fa-file-pdf-o"></span> PDF</button></a>
                    <button class="btn btn-warning" onclick="history.back()"> KEMBALI</button>
                </div>
            </div>
        </div>
    </div>
</div>