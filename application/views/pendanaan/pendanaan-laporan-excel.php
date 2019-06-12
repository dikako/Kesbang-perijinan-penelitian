<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=report_pendanaan.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border="1">
    <thead>
    <tr>
        <th colspan="3"><h2><?php echo $title;?></h2></th>
    </tr>
    <tr>
        <th>NO</th>
        <th>PENDANAAN</th>
        <th>DESKRIPSI</th>
    </tr>
    </thead>
    <tbody>
    <?php $i=1; foreach($data_pendanaan as $data) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $data['pendanaan_name']; ?></td>
            <td><?php echo $data['deskripsi']; ?></td>
        </tr>
        <?php $i++; } ?>
    </tbody>
</table>