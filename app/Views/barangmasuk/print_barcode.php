<?php

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;

function barcodegenerate($kode, $wrn)
{
  $barcodeG =  new BarcodeGenerator();
  $barcode = $barcodeG;
  $barcode->setText($kode);
  $barcode->setType(BarcodeGenerator::Code128);
  $barcode->setScale(1);
  $barcode->setThickness(25);
  $barcode->setFontSize(10);
  // $barcode->setBackgroundColor($wrn);
  $code = $barcode->generate();
  return '<img src="data:image/png;base64,' . $code . '" />';
}
?>
<table>
  <tbody>

    <?php $i = 0;
    foreach ($databarcode as $row) :
      if (substr($row['kode'], 0, 1) == '1') {
        $wrn = 'yellow';
      } else {
        $wrn = '#FFB6C1';
      }
      if ($i == 3) {
        $tr1 = '<tr>';
        $tr2 = '</tr>';
        $i = 0;
      } else {
        $tr1 = '';
        $tr2 = '';
      }
      echo $tr1;
    ?>
      <td style=" background-color: <?= $wrn ?> !important;  -webkit-print-color-adjust: exact;"><?= barcodegenerate($row['kode'], $wrn) ?> <br> <?= $row['merek'] ?></td>
      <td style=" background-color: <?= $wrn ?> !important;  -webkit-print-color-adjust: exact;"><?= $row['kode'] ?> <?= $row['kadar'] ?><br><?= $row['jenis'] ?>, <?= $row['model'] ?><br><?= $row['berat'] ?></td>
    <?php $i++;
    endforeach;
    echo $tr2; ?>

  </tbody>
</table>
<style>
  @page {
    size: A4;
    /* auto is the initial value */
    margin: 0mm;
    /* this affects the margin in the printer settings */
  }

  @media print {

    html,
    body {
      width: 210mm;
      height: 297mm;
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
    margin: 5mm 5mm 5mm 5mm;
    /* margin you want for the content */
  }
</style>
<script>
  window.addEventListener("load", window.print());
</script>