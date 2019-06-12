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
<h2>Data Tahun Penelitian</h2>
<table align="center">
    <thead>
    <tr>
        <th align="center">No</th>
        <th>Tahun Penelitian</th>
    </tr>
    </thead>
    <tbody>
    <?php $i=1; foreach($data_years as $data) { ?>
        <tr>
            <td align="center"><?php echo $i; ?></td>
            <td align="center"><?php echo $data['years_name']; ?></td>
        </tr>
        <?php $i++; } ?>
    </tbody>
</table>
</body>
</html>