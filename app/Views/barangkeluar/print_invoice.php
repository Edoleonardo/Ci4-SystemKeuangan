<?php

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;

function barcodegenerate($kode)
{
  $barcodeG =  new BarcodeGenerator();
  $barcode = $barcodeG;
  $barcode->setText($kode);
  $barcode->setType(BarcodeGenerator::Code128);
  $barcode->setScale(2);
  $barcode->setThickness(25);
  $barcode->setFontSize(10);
  $code = $barcode->generate();
  return '<img src="data:image/png;base64,' . $code . '" />';
}
?>
<table style='border:none;'>
  <tbody>
    <tr>
      <td style='border:none; width: 160mm;'><?= barcodegenerate($datajual['no_transaksi_jual']) ?></td>
      <td style='border:none;'>No.Nota : <?= $datajual['no_transaksi_jual'] ?><br>Tangerang, <?= date('d-m-y') ?><br>Bpk/Ibu: <?= $datajual['nama_customer'] ?></td>
    </tr>
  </tbody>
</table>
<br><br><br><br><br>
<div class="row">
  <table>
    <tbody>
      <thead>
        <tr>
          <!-- <th>Gambar</th> -->
          <th style="width: 100px;">Qty</th>
          <th style="width: 500px;">Keterangan</th>
          <th style="width: 100px;">Berat</th>
          <th style="width: 100px;">Ongkos</th>
          <th style="width: 100px;">Jumlah</th>
        </tr>
      </thead>
      <?php $total = 0;
      foreach ($datadetailjual as $row) : ?>
        <tr>
          <td><?= $row['qty'] ?></td>
          <td><?= $row['jenis'] ?>, <?= $row['keterangan'] ?>, <?= $row['model'] ?>, (<?= $row['kode'] ?>)</td>
          <td><?= $row['berat_kotor'] ?></td>
          <td>0</td>
          <td><?= $row['total_harga'] ?></td>
        </tr>
      <?php $total = $total +  $row['total_harga'];
      endforeach; ?>
      <?php if ($datajual['charge']) : $total = $total + ($total / 100 * $datajual['charge']) ?>
        <tr>
          <td style='border:none;'></td>
          <td style='border:none;'></td>
          <td style='border:none;'></td>
          <td>Charge</td>
          <td><?= $datajual['charge'] ?> %</td>
        </tr>
      <?php endif ?>
      <tr>
        <td style='border:none;'></td>
        <td style='border:none;'></td>
        <td style='border:none;'></td>
        <td>Total</td>
        <td><?= number_format($total, 2, ",", ".") ?></td>
      </tr>
      <?php if ($datajual['nama_bank']) : ?>
        <tr>
          <td style='border:none;'></td>
          <td style='border:none;'></td>
          <td style='border:none;'></td>
          <td>Nama Bank</td>
          <td><?= $datajual['nama_bank'] ?></td>
        </tr>
      <?php endif ?>
      <?php if ($datajual['pembulatan']) : ?>
        <tr>
          <td style='border:none;'></td>
          <td style='border:none;'></td>
          <td style='border:none;'></td>
          <td>Diskon</td>
          <td><?= number_format($datajual['pembulatan'], 2, ",", ".") ?></td>
        </tr>
      <?php endif ?>
      <?php if ($datajual['tunai']) : ?>
        <tr>
          <td style='border:none;'></td>
          <td style='border:none;'></td>
          <td style='border:none;'></td>
          <td>Tunai</td>
          <td><?= number_format($datajual['tunai'], 2, ',', '.') ?></td>
        </tr>
      <?php endif ?>
      <?php if ($datajual['debitcc']) : ?>
        <tr>
          <td style='border:none;'></td>
          <td style='border:none;'></td>
          <td style='border:none;'></td>
          <td>Debit / CC</td>
          <td><?= number_format($datajual['debitcc'], 2, ',', '.') ?></td>
        </tr>
      <?php endif ?>
      <?php if ($datajual['transfer']) : ?>
        <tr>
          <td style='border:none;'></td>
          <td style='border:none;'></td>
          <td style='border:none;'></td>
          <td>Transfer</td>
          <td><?= number_format($datajual['transfer'], 2, ',', '.') ?></td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>
<style>
  @page {
    size: landscape;
    /* auto is the initial value */
    margin: 0mm;
    /* this affects the margin in the printer settings */
  }

  @media print {

    html,
    body {
      width: 210mm;
      height: 110mm;
    }

    /* ... the rest of the rules ... */
  }

  html {
    background-color: #FFFFFF;
    margin: 0px;
    /* this affects the margin on the html before sending to printer */
  }

  body {
    /*border: solid 1px black ;*/
    /* margin: 50mm 50mm 50mm 50mm; */
    margin-top: 30mm;
    margin-left: 35mm;
    /* margin you want for the content */
  }

  table,
  th,
  td {
    border: 1px solid black;
    border-collapse: collapse;

  }

  .foto {
    position: absolute;
    left: 150px;
    top: 340px;
    z-index: 991;
  }
</style>
<script>
  window.addEventListener("load", window.print());
</script>