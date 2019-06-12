<html>
<head>
    <?php $this->load->view('template/header');?>
</head>
<body>
<div class="container" style="margin: auto auto;">
    <div class="row">
        <div class="col-md-4 col-md-offset-4" style="margin-top: 130px;margin-bottom: 130px">
            <div class="panel panel-default modal-content">
                <div class="panel-heading">
                    <div style="font-size: 14pt" class="panel-title text-center">Halaman Login</div>
                </div>
                <form action="<?php echo site_url('login/sign_in');?>" method="post">
                    <div class="panel-body">
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
                        <div style="margin-bottom: 25px; margin-top: 10px" class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div style="margin-bottom: 20px" class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="input-group" style="width: 100%">
                            <input type="submit" class="btn btn-primary" name="log" value="LOGIN" style="width:100%;">
                        </div>
                        <div class="" style="margin-top: 10px">
                            <div class="pull-left">
                                <a href="" data-toggle="modal" data-target="#lupa">Lupa Password</a>
                            </div>
                            <div class="pull-right">
                                <a href="#" data-toggle="modal" data-target="#register">Daftar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="register" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Daftar User sebagai Pengunjung</h4>
            </div>
            <form action="<?php echo site_url('login/daftar_data')?>" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama User</label>
                        <input type="text" class="form-control" name="nama_user" required>
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <select name="level" class="form-control">
                            <option value="Pengunjung">Pengunjung</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="file_upload" value="">
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                    <input type="submit" class="btn btn-primary" value="Daftar" name="daftar">
                </div>
            </form>
        </div>
    </div>
</div>
<div id="lupa" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Lupa Password</h4>
            </div>
            <form action="<?php echo site_url('login/lupa_password')?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Ulangi Password</label>
                        <input type="password" name="ulangi_password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                    <input type="submit" class="btn btn-primary" value="Ubah" name="ganti">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>