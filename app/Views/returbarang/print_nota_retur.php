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
function barcodegenerate2($kode)
{
  $barcodeG =  new BarcodeGenerator();
  $barcode = $barcodeG;
  $barcode->setText($kode);
  $barcode->setType(BarcodeGenerator::Code128);
  $barcode->setScale(1);
  $barcode->setThickness(25);
  $barcode->setFontSize(10);
  $code = $barcode->generate();
  return '<img style="padding: 5px;" src="data:image/png;base64,' . $code . '" />';
}
?>
<style>
  table,
  tbody,
  tr>* {
    vertical-align: middle;
    text-align: center;
  }

  /* #gmbr {
    position: absolute;
    z-index: 1;
  }

  table {
    position: relative;
  } */

  /* #gmbr2 {
    position: absolute;
    left: 0px;
    top: 0px;
    z-index: -999;
  } */
</style>
<table style='border:none;'>
  <tbody>
    <tr>
      <td style='border:none; width: 160mm;'><?= barcodegenerate($dataretur['no_retur']) ?></td>
      <td style='border:none;'>No.Nota : <?= $dataretur['no_retur'] ?><br>Tangerang, <?= date('d-m-y') ?><br>Nama Supplier: <?= (isset($dataretur['nama_supplier'])) ? $dataretur['nama_supplier'] : '________' ?></td>
    </tr>
  </tbody>
</table>
<br><br><br><br><br>
<div class="row">
  <table style='border-bottom:none;'>
    <tbody>
      <thead>
        <tr style="background-color: bisque;">
          <th style="width: 50px;">No</th>
          <th style="width: 100px;">Jenis</th>
          <th style="width: 100px;">Model</th>
          <th style="width: 300px;">Keterangan</th>
          <th style="width: 100px;">Merek</th>
          <th style="width: 100px;">Qty</th>
          <th style="width: 100px;">Berat</th>
          <th style="width: 100px;">Berat Murni</th>
        </tr>
      </thead>
      <?php
      $totalakhirqty = 0;
      $totalakhirberat = 0;
      $totalakhirberatm = 0;
      $qty = 0;
      $berat = 0;
      $beratm = 0;
      $datatotal = 0;
      $kadar = '';
      $i = 1;
      foreach ($datadetailretur as $row) : ?>
        <?php
        if ($kadar != $row['kadar']) : ?>
          <?php if ($datatotal == 1) : ?>
            <tr style="background-color: lightgreen;">
              <td style='border-right:none;border-left:none;'></td>
              <td style='border-right:none;border-left:none;'>Total</td>
              <td style='border-right:none;border-left:none;'></td>
              <td style='border-right:none;border-left:none;'></td>
              <td style='border-right:none;border-left:none;'></td>
              <td style='border-right:none;border-left:none;'><?= $qty ?></td>
              <td style='border-right:none;border-left:none;'><?= $berat ?></td>
              <td style='border-right:none;border-left:none;'><?= $beratm ?></td>
            </tr>
          <?php $datatotal = 0;
            $qty = 0;
            $berat = 0;
            $beratm = 0;
          endif; ?>
          <tr style="background-color: aqua !important;">
            <td style='border-right:none;border-left:none;'></td>
            <td style='border-right:none;border-left:none;'><?= $row['kadar'] ?></td>
            <td style='border-right:none;border-left:none;'></td>
            <td style='border-right:none;border-left:none;'></td>
            <td style='border-right:none;border-left:none;'></td>
            <td style='border-right:none;border-left:none;'></td>
            <td style='border-right:none;border-left:none;'></td>
            <td style='border-right:none;border-left:none;'></td>
          </tr>
        <?php endif; ?>
        <tr>
          <td style="text-align: center;"><?= $i ?></td>
          <td style="vertical-align: middle;"><?= $row['jenis'] ?></td>
          <td style="vertical-align: middle;"><?= $row['model'] ?></td>
          <td style="vertical-align: middle;"><?= $row['keterangan'] ?></td>
          <td style="vertical-align: middle;"><?= $row['merek'] ?></td>
          <td style="vertical-align: middle;"><?= $row['qty'] ?></td>
          <td style="text-align: center;"><?= $row['berat'] ?></td>
          <td style="text-align: center;"><?= $row['berat_murni'] ?></td>
        </tr>

      <?php
        $qty = $qty + $row['qty'];
        $berat = $berat + $row['berat'];
        $beratm = $beratm + $row['berat_murni'];
        $totalakhirqty = $totalakhirqty + $row['qty'];
        $totalakhirberat = $totalakhirberat + $row['berat'];
        $totalakhirberatm = $totalakhirberatm + $row['berat_murni'];
        $datatotal = 1;
        $kadar = $row['kadar'];
        $i++;
      endforeach; ?>
      <tr style="background-color: lightgreen;">
        <td style='border-right:none;border-left:none;'></td>
        <td style='border-right:none;border-left:none;'>Total</td>
        <td style='border-right:none;border-left:none;'></td>
        <td style='border-right:none;border-left:none;'></td>
        <td style='border-right:none;border-left:none;'></td>
        <td style='border-right:none;border-left:none;'><?= $qty ?></td>
        <td style='border-right:none;border-left:none;'><?= $berat ?></td>
        <td style='border-right:none;border-left:none;'><?= $beratm ?></td>
      </tr>
      <tr style="background-color: lightyellow;">
        <td style='border-right:none;border-left:none;'></td>
        <td style='border-right:none;border-left:none;'>Total Akhir</td>
        <td style='border-right:none;border-left:none;'></td>
        <td style='border-right:none;border-left:none;'></td>
        <td style='border-right:none;border-left:none;'></td>
        <td style='border-right:none;border-left:none;'><?= $totalakhirqty ?></td>
        <td style='border-right:none;border-left:none;'><?= $totalakhirberat ?></td>
        <td style='border-right:none;border-left:none;'> <?= $totalakhirberatm ?></td>
      </tr>
    </tbody>
  </table>

</div>
<style>
  @page {
    /* size: landscape; */
    /* auto is the initial value */
    margin: 0mm;
    margin-top: 2cm;
    margin-bottom: 2cm;
    margin-left: 2cm;
    margin-right: 2cm;
    /* this affects the margin in the printer settings */
  }

  @media print {

    html,
    body {
      -webkit-print-color-adjust: exact !important;
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

  table,
  th,
  td {
    border: 1px solid black;
    border-collapse: collapse;

  }
</style>
<script>
  window.addEventListener("load", window.print());
</script>