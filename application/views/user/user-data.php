<?php
$ses_level = $this->session->userdata('ses_level');
?>
    <div class="page-header">
        <h2>Data User</h2>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    List Data
                    <a href="#widget1" data-toggle="collapse"><span class="fa fa-chevron-down" style="float: right"></span>
                    </a>
                </div>
                <div id="widget1" class="panel-body collapse in">
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
                    <div class="nav" style="margin-bottom: 10px">
                        <?php if ($ses_level != 'Pimpinan' and $ses_level != 'Pengunjung'){?>
                            <button data-toggle="modal" data-target="#data-tambah" class="btn btn-info col-md-2">
                                <span class="glyphicon glyphicon-plus"></span>
                                <span>Tambah Data</span>
                            </button>
                        <?php } ?>
                        <?php if ($ses_level != 'Pengunjung'){?>
                            <div class="pull-right">
                                <a href="<?php echo site_url('user/export_print');?>" target="_blank">
                                    <button class="btn btn-success">
                                        <span class="fa fa-print"></span> Print
                                    </button>
                                </a>
                                <a href="<?php echo site_url('user/export_pdf');?>">
                                    <button class="btn btn-danger">
                                        <span class="fa fa-file-pdf-o"></span> Pdf
                                    </button>
                                </a>
                                <a href="<?php echo site_url('user/export_excel');?>">
                                    <button class="btn btn-primary">
                                        <span class="fa fa-file-excel-o"></span> Excel
                                    </button>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <table id="table" class="table penelitian table-bordered table-striped" width="100%">
                        <thead>
                        <tr>
                            <th width="7%">#</th>
                            <th>NAMA USER</th>
                            <th>JABATAN</th>
                            <th>EMAIL</th>
                            <th>LOGIN TERAKHIR</th>
                            <?php if ($ses_level != 'Pimpinan' and $ses_level != 'Pengunjung'){?>
                                <th class="text-center">Opsi</th>
                            <?php } ?>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>nama_user</th>
                            <th>level</th>
                            <th>email</th>
                            <th>last_login</th>
                            <?php if ($ses_level != 'Pimpinan' and $ses_level != 'Pengunjung'){?>
                                <th></th>
                            <?php } ?>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php
                        $no = 0; foreach ($data_user as $data){ $no++
                            ?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo $data['nama_user']?></td>
                                <td><?php echo $data['level']?></td>
                                <td><?php echo $data['email']?></td>
                                <td><?php echo $data['last_login']?></td>
                                <?php if ($ses_level != 'Pimpinan' and $ses_level != 'Pengunjung'){?>
                                    <td class="text-center">
                                        <a href="<?php echo base_url()?>user/detail_data/<?php echo $data['id_user'];?>" data-toggle="tooltip" data-placement ="top" title="detail"><span class="glyphicon glyphicon-check" style="font-size: 14pt"></span></a>
        <?php if ($ses_level == 'Super Admin' or $data['level'] != 'Super Admin' and  $data['level'] != 'Admin'){?>
                                        <a href="<?php echo base_url()?>user/edit_data/<?php echo $data['id_user'];?>" data-toggle="tooltip" data-placement ="top" title="edit"><span class="fa fa-edit ukuran" style="font-size: 14pt"></span></a>
                                        <a href="<?php echo base_url()?>user/hapus_data/<?php echo $data['id_user'];?>" onclick="return confirm('Yakin data dihapus')" data-toggle="tooltip" data-placement ="top" title="hapus"><span class="glyphicon glyphicon-trash" style="font-size: 12pt"></span></a>
       <?php } ?>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view('user/user-tambah');?>