<!DOCTYPE html>
<html>

<head>
    <title>Page Title</title>
</head>

<body>
    <div id="coba"></div>
    <h1>This is a Heading</h1>
    <p>This is a paragraph.</p>

</body>

</html>
<script src="/js/quagga.min.js"></script>
<script>
    Quagga.init({
        inputStream: {
            name: "Live",
            type: "LiveStream",
            target: document.querySelector('#coba') // Or '#yourElement' (optional)
        },
        decoder: {
            // readers: ["code_128_reader", "ean_reader", "ean_8_reader", "code_39_reader", "code_39_vin_reader", "codabar_reader", "upc_reader", "upc_e_reader", "i2of5_reader", "2of5_reader", "code_93_reader", ]
            readers: ["code_128_reader", "ean_reader", "ean_8_reader", "code_39_reader", "code_39_vin_reader", "codabar_reader", "upc_reader", "upc_e_reader", "i2of5_reader", "2of5_reader", "code_93_reader", ]

        }
    }, function(err) {
        if (err) {
            console.log(err);
            return
        }
        console.log("Initialization finished. Ready to start");
        Quagga.start();
    });

    Quagga.onDetected(function(data) {
        alert(data.codeResult.code + ' ' + data.codeResult.format)
        Quagga.stop()
    })
</script>