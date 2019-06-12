<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=report_user.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border="1">
    <thead>
    <tr>
        <th colspan="5"><h2><?php echo $title;?></h2></th>
    </tr>
    <tr>
        <th>No</th>
        <th>NAMA USER</th>
        <th>LEVEL</th>
        <th>EMAIL</th>
        <th>LOGIN TERAKHIR</th>
    </tr>
    </thead>
    <tbody>
    <?php $i=1; foreach($data_user as $data) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $data['nama_user']; ?></td>
            <td><?php echo $data['level']; ?></td>
            <td><?php echo $data['email']; ?></td>
            <td><?php echo $data['last_login']; ?></td>
        </tr>
        <?php $i++; } ?>
    </tbody>
</table>