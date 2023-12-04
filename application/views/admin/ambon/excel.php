<?php
$title = "Laporan_soal_" . date('d-m-y_His'); // Set the title for the Excel file

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan soal</title>
</head>
<body>
    <h3>Laporan Data soal : <?= date('d F Y'); ?></h3>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Regional</th>
                             <th>Cabang</th>
                             <th>Type Journey</th>
                             <th>Type Option</th>
                             <th>Kapal</th>
                             <th>Pelabuhan</th>
                             <th>Type</th> 
                             <th>Soal</th>
                             <th>Jawaban 1</th>
                             <th>Jawaban 2</th>
                             <th>Jawban benar</th>
                             <th>Gambar</th> 
                             <th>Hari</th> 
                             <th>Last Input</th> 
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($data as $soal):
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $soal->regional; ?></td>
                    <td><?= $soal->cabang; ?></td>
                    <td><?= $soal->journey; ?></td>
                    <td><?= $soal->type_option; ?></td>
                    <td><?= $soal->kapal; ?></td>
                    <td><?= $soal->pelabuhan; ?></td>
                    <td><?= $soal->type; ?></td>
                    <td><?= $soal->soal; ?></td>
                    <td><?= $soal->jawaban_1; ?></td>
                    <td><?= $soal->jawaban_2; ?></td>
                    <td><?= $soal->jawaban_benar; ?></td>
                    <td><?= $soal->gambar; ?></td>
                    <td><?= $soal->hari; ?></td>
                    <td><?= $soal->last_input; ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>
