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
                <div class="modal-dialog">
                    <?php
                    $data=$this->session->flashdata('error');
                    if($data!=""){ ?>
                        <div id="pesan-flash">
                            <div class='alert alert-danger alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <strong> Error! </strong> <?=$data;?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php
                    $data2=$this->session->flashdata('sukses');
                    if($data2!=""){ ?>
                        <div id="pesan-error-flash">
                            <div class='alert alert-success alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <strong> Succes! </strong> <?=$data2;?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php
                    $data3=$this->session->flashdata('warning');
                    if($data3!=""){ ?>
                        <div id="pesan-error-flash">
                            <div class='alert alert-warning alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <strong> Warning! </strong> <?=$data3;?>
                            </div>
                        </div>
                    <?php } ?>
                    <form action="<?php echo site_url('dtlp/update_data')?>" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="kode_penelitian" value="<?php echo $kode_penelitian;?>">
                        <input type="hidden" name="tahun_penelitian" value="<?php echo $tahun_penelitian;?>">
                        <input type="hidden" name="pdf_lama" value="<?php echo $pdf;?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Kode Penelitian</label>
                                <input type="text" name="kode_penelitian1" class="form-control" required value="<?php echo $kode_penelitian;?>">
                                <p style="color:red;">format kode DTLP(..tahun penelitian..).(..urutan..)</p>
                            </div>
                            <div class="form-group">
                                <label>Judul Penelitian</label>
                                <textarea name="judul_penelitian" class="form-control" required><?php echo $judul_penelitian;?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Nama Penanggung Jawab</label>
                                <input type="text" name="npj" class="form-control" value="<?php echo $npj;?>">
                            </div>
                            <div class="form-group">
                                <label>Tahun Penelitian</label>
                                <select name="tahun_penelitian1" class="form-control" required>
                                    <option value="">Pilih</option>
                                    <?php foreach($years as $years){
                                        if(!in_array($years['code_years'],$years_post)){
                                            ?>
                                            <option value="<?php echo $years['code_years'] ?>"><?php echo $years['years_name'] ?></option>
                                        <?php } else { ?>
                                            <option selected="selected" value="<?php echo $years['code_years'] ?>"><?php echo $years['years_name'] ?></option>
                                        <?php } } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nama Instansi</label>
                                <input type="text" name="nama_instansi" class="form-control" value="<?php echo $nama_instansi;?>">
                            </div>
                            <div class="form-group">
                                <label>Alamat Instansi</label>
                                <textarea name="alamat_instansi" class="form-control"><?php echo $alamat_instansi;?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Pendanaan</label>
                                <select name="pendanaan" class="form-control">
                                    <option value="">Pilih</option>
                                    <?php foreach($pendanaan as $pendanaan){
                                        if(!in_array($pendanaan['code_pendanaan'],$pendanaan_post)){
                                            ?>
                                            <option value="<?php echo $pendanaan['code_pendanaan'] ?>"><?php echo $pendanaan['pendanaan_name'] ?></option>
                                        <?php } else { ?>
                                            <option selected="selected" value="<?php echo $pendanaan['code_pendanaan'] ?>"><?php echo $pendanaan['pendanaan_name'] ?></option>
                                        <?php } } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Terima</label>
                                <div class="form-group">
                                    <div class='input-group date' id='datepicker'>
                                        <input type='text' name="tgl_terima" class="form-control" value="<?php echo $tgl_terima;?>"/>
                                        <span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nomor Induk</label>
                                <input type="text" name="nomor_induk" class="form-control" value="<?php echo $nomor_induk;?>">
                            </div>
                            <div class="form-group">
                                <label>Hadiah Tukar</label>
                                <input type="text" name="hadiah_tukar" class="form-control" value="<?php echo $hadiah_tukar;?>">
                            </div>
                            <div class="form-group">
                                <label>File Pdf</label><br>
                                <?php if ($pdf != null){
                                    echo "<label>".$pdf."</label>";
                                }else{
                                    echo "pdf tidak ada";
                                }?>
                                <input type="file" name="pdf">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-danger ">Reset</button>
                            <button type="button" class="btn btn-warning " data-dismiss="modal" onclick="history.back();">Batal
                            </button>
                            <input type="submit" class="btn btn-primary" value="Update" name="update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>