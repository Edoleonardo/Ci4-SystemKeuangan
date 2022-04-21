<form action="/pilihkelompok" name="pilihkelompok" id="pilihkelompok" class="pilihkelompok" method="post">
    <?= csrf_field(); ?>
    <input type="hidden" name="iddate" id="iddate" value="<?= $iddate ?>">
    <div class="col-sm-3">
        <!-- text input -->
        <div class="form-group">
            <label>Pilih Kelompok</label>
            <div class="input-group input-group-sm">
                <select name="kelompok" class="form-control" id="kelompok" name="kelompok">
                    <option value="1">Perhiasan Mas</option>
                    <option value="2">Perhiasan Berlian</option>
                    <option value="3">Logam Mulia (Antam, UBS, HWT)</option>
                    <option value="4">Bahan Murni</option>
                    <option value="5">Loose Diamond</option>
                    <option value="6">Barang Dagang</option>
                </select>
                <span class="input-group-append">
                    <button type="submit" id="btnsubmitform" class="btn btn-info btn-flat btnsubmitform">Pilih</button>
                </span>
            </div>
        </div>
    </div>
</form>

<script>
    $('.pilihkelompok').submit(function(e) {
        e.preventDefault()
        Swal.fire({
            title: 'Pilih Kelompok ' + $('#kelompok').val(),
            text: "Pilih Kelompok " + $('#kelompok').val() + " ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Pilih',
        }).then((result) => {
            if (result.isConfirmed) {
                let form = $('.pilihkelompok')[0];
                let data = new FormData(form)
                $.ajax({
                    type: "POST",
                    data: data,
                    url: "<?php echo base_url('pilihkelompok'); ?>",
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: "json",
                    success: function(result) {
                        console.log(result)
                        tampilform()

                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })
            }
        })
    })
</script>