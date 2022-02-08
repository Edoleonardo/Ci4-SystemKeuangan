<?=
$barcode
?>
<style>
  @page {
    size: auto;
    /* auto is the initial value */
    margin: 0mm;
    /* this affects the margin in the printer settings */
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