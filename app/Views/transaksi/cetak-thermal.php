<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Print Receipt</title>
    <style>
        * {
            font-size: 12px;
            font-family: 'Times New Roman';
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
        }

        td.description,
        th.description {
            width: 70px;
            max-width: 70px;
        }

        td.quantity,
        th.quantity {
            width: 20px;
            max-width: 20px;
            word-break: break-all;
        }

        td.price,
        th.price {
            width: 65px;
            max-width: 65px;
            word-break: break-all;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 155px;
            max-width: 155px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        @media print {

            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }
    </style>
</head>

<body onload="window.print();">
    <?php
    $db           = \Config\Database::connect();
    $id = $transaksi['id_member'];
    $id_layanan = $transaksi['id_layanan'];
    $member = $db->table('tb_member')->getWhere(['id' => $id])->getRowArray();
    $query = "SELECT `tb_layanan`.*, `tb_d_layanan` .*
                                            FROM `tb_layanan` JOIN `tb_d_layanan`
                                            ON `tb_layanan`.`id` = `tb_d_layanan`.`id_layanan` WHERE `tb_d_layanan`.`id` = $id_layanan";
    $layanan = $db->query($query)->getRowArray();
    $i = 1;
    ?>
    <div class="ticket">
        <p class="centered"><b>G-sok<sup>2</sup></b>
            <br>
            Jl Alternatif Sentul No 45, Telp 085717766367
        </p>
        <p>Invoice # <?= $transaksi['invoice']; ?><br>
            Tgl <?= $transaksi['tanggal_mulai']; ?>
        </p>
        <P>
            Layanan <?= $layanan['nama_layanan']; ?> - <?= $layanan['layanan']; ?> </P>

        <table>
            <thead>
                <tr>
                    <th class="quantity">B</th>
                    <th class="description">Biaya</th>
                    <th class="price">Harga</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $transaksi['berat']; ?></td>
                    <td><?= 'Rp. ' . number_format($layanan['harga'], 0, ',', '.') . '/KG'; ?></td>
                    <td class="price"><?= 'Rp. ' . number_format($transaksi['total_biaya'], 0, ',', '.'); ?></td>
                </tr>

            </tbody>
        </table>
        <p class="centered">Terima kasih atas kepercayaan anda menggunakan jasa kami</p>
    </div>
</body>

</html>