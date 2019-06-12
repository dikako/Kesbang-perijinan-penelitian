<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>
    <style>
        table{
            border-collapse: collapse;
        }
        table, td, th {
            border: 1px solid black;
        }
        h2{
            text-align: center;
        }
        table thead tr th{
            background: #e1e1e1;
        }
        table th{
            padding: 5px;
            font-size: 12pt;
        }
        table td{
            padding: 3px 5px;
            font-size: 11pt;
        }
    </style>
</head>
<body onload="window.print()">
<h2>Data Laporan Penelitian</h2>
<table align="center">
    <thead>
    <tr>
        <th align="center">No</th>
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
            <td align="center"><?php echo $i; ?></td>
            <td align="center"><?php echo $data['kode_penelitian']; ?></td>
            <td align="center"><?php echo $data['judul_penelitian']; ?></td>
            <td align="center"><?php echo $data['npj']; ?></td>
            <td align="center"><?php echo $data['years_name']; ?></td>
            <td align="center"><?php echo $data['nama_instansi']; ?></td>
            <td align="center"><?php echo $data['alamat_instansi']; ?></td>
            <td align="center"><?php echo $data['pendanaan_name']; ?></td>
            <td align="center"><?php echo $data['nomor_induk']; ?></td>
            <td align="center"><?php echo $data['tgl_terima']; ?></td>
            <td align="center"><?php echo $data['hadiah_tukar']; ?></td>
            <td align="center"><?php echo $data['pdf']; ?></td>
        </tr>
        <?php $i++; } ?>
    </tbody>
</table>
</body>
</html>