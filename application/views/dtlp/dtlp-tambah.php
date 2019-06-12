<div id="data-tambah" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Tambah Data Laporan Penelitian</h4>
            </div>
            <form action="<?php echo site_url('dtlp/simpan_data')?>" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Penelitian</label>
                        <input type="text" name="kode_penelitian" class="form-control" required>
                        <p style="color:red;">format kode DTLP(..tahun penelitian..).(..urutan..)</p>
                    </div>
                    <div class="form-group">
                        <label>Judul Penelitian</label>
                        <textarea name="judul_penelitian" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Nama Penanggung Jawab</label>
                        <input type="text" name="npj" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Tahun Penelitian</label>
                        <select name="tahun_penelitian" class="form-control" required >
                            <option value="">Pilih</option>
                            <?php $no = 1; foreach ($data_years as $data) { $no++ ?>
                            <option value="<?php echo $data['code_years'];?>"><?php echo $data['years_name'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Instansi</label>
                        <input type="text" name="nama_instansi" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Alamat Instansi</label>
                        <input type="text" name="alamat_instansi" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Pendanaan</label>
                        <select name="pendanaan" class="form-control">
                            <option value="">Pilih</option>
                            <?php $no = 1; foreach ($data_pendanaan as $data) { $no++ ?>
                            <option value="<?php echo $data['code_pendanaan'];?>"><?php echo $data['pendanaan_name'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Terima</label>
                        <div class="form-group">
                            <div class='input-group date' id='datepicker'>
                                <input type='text' name="tgl_terima" class="form-control" />
                                <span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nomor Induk</label>
                        <input type="text" name="nomor_induk" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Hadiah Tukar</label>
                        <input type="text" name="hadiah_tukar" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>File Pdf</label>
                        <input type="file" name="pdf">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                    <input type="submit" class="btn btn-primary" value="Simpan" name="simpan">
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker').datetimepicker({
            format: 'DD MMMM YYYY HH:mm'
        });

        $('#datepicker').datetimepicker({
            format: 'DD MMMM YYYY'
        });

        $('#timepicker').datetimepicker({
            format: 'HH:mm'
        });
    });
</script>