<style>
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


<table>
    <tbody>
        <thead>
            <tr>
                <th colspan="100">
                    Statistik Jumlah Barang
                </th>
            </tr>
            <tr>
                <th></th>
                <th colspan="11">Jenis</th>
            </tr>
            <tr>
                <th>Kadar</th>
                <?php foreach ($kadar as $row) { ?>
                    <th><?= $row['nama_kadar'] ?></th>
                <?php } ?>
            </tr>
        </thead>
    <tbody>
        <tr>
            <td>
                asdasd
            </td>
            <td>
                asdasd
            </td>
        </tr>
    </tbody>
</table>
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
        margin-top: 7mm;
        margin-left: 10mm;
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
    //window.addEventListener("load", window.print());
</script>