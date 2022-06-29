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
  $barcode->setBackgroundColor($wrn);
  $code = $barcode->generate();
  return '<img src="data:image/png;base64,' . $code . '" />';
}
?>
<?php if ($kertas == 'A4') { ?>
  <table style="background-color: purple !important; -webkit-print-color-adjust: exact;">
    <?php $i = 0;
    $b = 1;
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
        $b = $b + 1;
      } else {
        $tr1 = '';
        $tr2 = '';
      }
      if ($b == 16) {
        $tab = '<table class="pagebreak" style="background-color: purple !important; -webkit-print-color-adjust: exact;">';
        $tab2 = '</table>';
        $b = 1;
      } else {
        $tab = '';
        $tab2 = '';
      }
      echo $tr1;
      echo $tab;
    ?>
      <td style="border: 1px solid white; min-width: 65mm; max-height: 15mm;">
        <table>
          <td>
            <table>
              <tr>
                <td style="font-size:11px; padding: 2px; background-color: <?= $wrn ?> !important;  -webkit-print-color-adjust: exact; text-align: center; max-width: 32mm;min-width: 32mm">
                  <?= barcodegenerate($row['kode'], $wrn) ?> <br> <?= $datapembelian['no_faktur_supp'] ?> <?= $row['merek'] ?>
                </td>
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td style="font-size:10px; background-color: <?= $wrn ?> !important; -webkit-print-color-adjust: exact; text-align: center; max-width: 32mm;min-width: 32mm">
                  <b><?= $row['kode'] ?></b> <b style="color: red;"><?= $row['kadar'] ?></b> <br> <?= $row['jenis'] ?>, <?= $row['model'] ?><br>NW <?= $row['berat'] ?>Gr / GW <?= $row['berat'] + 0.12 ?>Gr <?php if (substr($row['kode'], 0, 1) == '1' && $row['kadar'] == '24K') {
                                                                                                                                                                                                                echo '<br> Ongkos Rp ' . $row['ongkos'];
                                                                                                                                                                                                              } elseif (substr($row['kode'], 0, 1) == '2') {
                                                                                                                                                                                                                echo '<br> Rp ' . number_format($row['total_harga'], 0, ',', '.');
                                                                                                                                                                                                              } ?>
                </td>
              </tr>
            </table>
          </td>
        </table>
      </td>
    <?php $i++;
    endforeach;
    echo $tr2;
    echo $tab2; ?>
  </table>
  <style>
    @page {
      size: A4;
      /* auto is the initial value */
      margin: 5mm;
      /* this affects the margin in the printer settings */
    }

    @media print {

      html,
      body {
        width: 210mm;
        height: 297mm;
      }

      .pagebreak {
        page-break-before: always;
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
<?php } elseif ($kertas == 'A3+') { ?>
  <table style="background-color: purple !important; -webkit-print-color-adjust: exact;">
    <?php $i = 0;
    $b = 1;
    foreach ($databarcode as $row) :
      if (substr($row['kode'], 0, 1) == '1') {
        $wrn = 'yellow';
      } else {
        $wrn = '#FFB6C1';
      }
      if ($i == 5) {
        $tr1 = '<tr>';
        $tr2 = '</tr>';
        $i = 0;
        $b = $b + 1;
      } else {
        $tr1 = '';
        $tr2 = '';
      }
      if ($b == 28) {
        $tab = '<table class="pagebreak" style="background-color: purple !important; -webkit-print-color-adjust: exact;">';
        $tab2 = '</table>';
        $b = 1;
      } else {
        $tab = '';
        $tab2 = '';
      }
      echo $tr1;
      echo $tab;
    ?>
      <td style="border: 1px solid white; min-width: 65mm; max-height: 15mm;">
        <table>
          <td>
            <table>
              <tr>
                <td style="font-size:11px; padding: 2px; background-color: <?= $wrn ?> !important;  -webkit-print-color-adjust: exact; text-align: center; max-width: 32mm;min-width: 32mm">
                  <?= barcodegenerate($row['kode'], $wrn) ?> <br> <?= $datapembelian['no_faktur_supp'] ?> <?= $row['merek'] ?>
                </td>
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td style="font-size:10px; background-color: <?= $wrn ?> !important; -webkit-print-color-adjust: exact; text-align: center; max-width: 32mm;min-width: 32mm">
                  <b><?= $row['kode'] ?></b> <b style="color: red;"><?= $row['kadar'] ?></b> <br> <?= $row['jenis'] ?>, <?= $row['model'] ?><br>NW <?= $row['berat'] ?>Gr / GW <?= $row['berat'] + 0.12 ?>Gr <?php if (substr($row['kode'], 0, 1) == '1' && $row['kadar'] == '24K') {
                                                                                                                                                                                                                echo '<br> Ongkos Rp ' . $row['ongkos'];
                                                                                                                                                                                                              } elseif (substr($row['kode'], 0, 1) == '2') {
                                                                                                                                                                                                                echo '<br> Rp ' . number_format($row['total_harga'], 0, ',', '.');
                                                                                                                                                                                                              } ?>
                </td>
              </tr>
            </table>
          </td>
        </table>
      </td>
    <?php $i++;
    endforeach;
    echo $tr2;
    echo $tab2; ?>
  </table>
  <style>
    @page {
      size: 329mm 483mm;
      /* auto is the initial value */
      margin: 5mm;
      /* this affects the margin in the printer settings */
    }

    @media print {

      html,
      body {
        width: 210mm;
        height: 297mm;
      }

      .pagebreak {
        page-break-before: always;
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
<?php } else { ?>
  <table style="background-color: purple !important; -webkit-print-color-adjust: exact;">
    <?php $i = 0;
    $b = 1;
    foreach ($databarcode as $row) :
      if (substr($row['kode'], 0, 1) == '1') {
        $wrn = 'yellow';
      } else {
        $wrn = '#FFB6C1';
      }
      if ($i == 4) {
        $tr1 = '<tr>';
        $tr2 = '</tr>';
        $i = 0;
        $b = $b + 1;
      } else {
        $tr1 = '';
        $tr2 = '';
      }
      if ($b == 21) {
        $tab = '<table class="pagebreak" style="background-color: purple !important; -webkit-print-color-adjust: exact;">';
        $tab2 = '</table>';
        $b = 1;
      } else {
        $tab = '';
        $tab2 = '';
      }
      echo $tr1;
      echo $tab;
    ?>
      <td style="border: 1px solid white; min-width: 65mm; max-height: 15mm;">
        <table>
          <td>
            <table>
              <tr>
                <td style="font-size:11px; padding: 2px; background-color: <?= $wrn ?> !important;  -webkit-print-color-adjust: exact; text-align: center; max-width: 32mm;min-width: 32mm">
                  <?= barcodegenerate($row['kode'], $wrn) ?> <br> <?= $datapembelian['no_faktur_supp'] ?> <?= $row['merek'] ?>
                </td>
              </tr>
            </table>
          </td>
          <td>
            <table>
              <tr>
                <td style="font-size:10px; background-color: <?= $wrn ?> !important; -webkit-print-color-adjust: exact; text-align: center; max-width: 32mm;min-width: 32mm">
                  <b><?= $row['kode'] ?></b> <b style="color: red;"><?= $row['kadar'] ?></b> <br> <?= $row['jenis'] ?>, <?= $row['model'] ?><br>NW <?= $row['berat'] ?>Gr / GW <?= $row['berat'] + 0.12 ?>Gr <?php if (substr($row['kode'], 0, 1) == '1' && $row['kadar'] == '24K') {
                                                                                                                                                                                                                echo '<br> Ongkos Rp ' . $row['ongkos'];
                                                                                                                                                                                                              } elseif (substr($row['kode'], 0, 1) == '2') {
                                                                                                                                                                                                                echo '<br> Rp ' . number_format($row['total_harga'], 0, ',', '.');
                                                                                                                                                                                                              } ?>
                </td>
              </tr>
            </table>
          </td>
        </table>
      </td>
    <?php $i++;
    endforeach;
    echo $tr2;
    echo $tab2; ?>
  </table>
  <style>
    @page {
      size: 210mm 297mm;
      /* auto is the initial value */
      margin: 5mm;
      /* this affects the margin in the printer settings */
    }

    @media print {

      html,
      body {
        width: 210mm;
        height: 297mm;
      }

      .pagebreak {
        page-break-before: always;
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
<?php } ?>