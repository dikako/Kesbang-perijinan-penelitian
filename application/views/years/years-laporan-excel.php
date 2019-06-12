<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=report_tahun_penelitian.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border="1">
    <thead>
    <tr>
        <th colspan="2"><h2><?php echo $title;?></h2></th>
    </tr>
    <tr>
        <th>NO</th>
        <th>TAHUN PENELITIAN</th>
    </tr>
    </thead>
    <tbody>
    <?php $i=1; foreach($data_years as $data) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $data['years_name']; ?></td>
        </tr>
        <?php $i++; } ?>
    </tbody>
</table>