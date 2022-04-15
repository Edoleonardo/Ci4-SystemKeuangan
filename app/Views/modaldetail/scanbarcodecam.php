<script src="./js/html5-qrcode.min_.js"></script>
<!-- <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script> -->
<style>
    .result {
        background-color: green;
        color: #fff;
        padding: 20px;
    }

    .row {
        display: flex;
    }
</style>
<div class="modal fade" id="modal-scan">
    <div class="modal-dialog modal-l">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ScanBarcode</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div style="width:500px;" id="reader"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary btntambah" onclick="matiinscan()" data-dismiss="modal">Selesai</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <script type="text/javascript">
        function ScanBarcode() {
            const html5QrCode = new Html5Qrcode("reader");
            Html5Qrcode.getCameras().then(devices => {
                /**
                 * devices would be an array of objects of type:
                 * { id: "id", label: "label" }
                 */
                if (devices && devices.length) {
                    var cameraId = devices[1].id;
                    // .. use this to start scanning.
                    html5QrCode.start(
                            cameraId, {
                                fps: 10, // Optional, frame per seconds for qr code scanning
                                qrbox: {
                                    width: 250,
                                    height: 100,
                                }, // Optional, if you want bounded box UI
                            },
                            (decodedText, decodedResult) => {
                                console.log(decodedText)
                                $('#kodebarang').val(decodedText)
                                OpenBarcode()
                                html5QrCode.stop().then((ignore) => {
                                    // QR Code scanning is stopped.
                                }).catch((err) => {
                                    // Stop failed, handle it.
                                });
                            },
                            (errorMessage) => {
                                // parse error, ignore it.
                            })
                        .catch((err) => {
                            // Start failed, handle it.
                        });

                }
            }).catch(err => {
                // handle err
            });
        }
        $(document).ready(function() {
            ScanBarcode()
        })
    </script>