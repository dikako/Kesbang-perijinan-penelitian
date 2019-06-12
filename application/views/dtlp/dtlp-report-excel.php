<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=report_dtlp.xls");
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
        <th>Kode Penelitian</th>
        <th>Judul Penelitian</th>
        <th>Nama Penanggung Jawab</th>
        <th>Tahun Penelitian</th>
        <th>Nama Instansi</th>
        <th>Alamat Instansi</th>
        <th>Pendanaan</th>
        <th>Nomor Induk</th>
        <th>Tanggal Terima</th>
        <th>Hadiah Tukar</th>
        <th>Pdf</th>
    </tr>
    </thead>
    <tbody>
    <?php $i=1; foreach($data_laporan as $data) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $data['kode_penelitian']; ?></td>
            <td><?php echo $data['judul_penelitian']; ?></td>
            <td><?php echo $data['npj']; ?></td>
            <td><?php echo $data['years_name']; ?></td>
            <td><?php echo $data['nama_instansi']; ?></td>
            <td><?php echo $data['alamat_instansi']; ?></td>
            <td><?php echo $data['pendanaan_name']; ?></td>
            <td><?php echo $data['nomor_induk']; ?></td>
            <td><?php echo $data['tgl_terima']; ?></td>
            <td><?php echo $data['hadiah_tukar']; ?></td>
            <td><?php echo $data['pdf']; ?></td>
        </tr>
        <?php $i++; } ?>
    </tbody>
</table>