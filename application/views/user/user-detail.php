<div class="page-header">
    <h2>Data User</h2>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Detail Data
                <a href="#widget1" data-toggle="collapse"><span class="fa fa-chevron-down" style="float: right"></span>
                </a>
            </div>
            <div id="widget1" class="panel-body collapse in">
                <div class="col-md-3">
                    <img src="<?php echo base_url('/assets/upload/foto-user/'.$foto)?>" style="max-height: 140px;" class="img-responsive">
                </div>
                <div class="col-md-9">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th width="25%">NAMA USER</th>
                                <td width="3%">:</td>
                                <td><?php echo $nama_user;?></td>
                            </tr>
                            <tr>
                                <th>LEVEL</th>
                                <td>:</td>
                                <td><?php echo $level;?></td>
                            </tr>
                            <tr>
                                <th>EMAIL</th>
                                <td>:</td>
                                <td><?php echo $email;?></td>
                            </tr>
                            <tr>
                                <th>LOGIN TERAKHIR</th>
                                <td>:</td>
                                <td><?php echo $last_login;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <button class="btn btn-default" onclick="history.back()"><span class="glyphicon glyphicon-step-backward"></span> Kembali</button>
            </div>
        </div>
    </div>
</div>