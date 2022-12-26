<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>barcode Scanner</title>
    <script src="{{ asset('html5-qrcode.min.js') }}"></script>
    <style>
        .modal {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: white;
            /* Buat modal muncul dari bawah ke atas */
            transform: translateY(100%);
            /* Tambahkan transisi untuk efek animasi */
            transition: transform 0.3s ease-out;
        }
    </style>
</head>

<body>
    <div id="qr-reader" style="width: 100%"></div>
    <h1>Hasil : </h1>
    <h3 id="scannerResult">Silahkah scan terlebih dahulu</h3>
    <audio id="myAudio">
        <source src="{{ asset('sounds/qrcode.mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <button class="button">modal</button>
    <div class="modal">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima maiores qui aperiam dicta, temporibus at
        architecto, eveniet nihil cupiditate aliquam ab quae commodi, est sit incidunt vero molestias labore eius.
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const button = document.querySelector('.button');
        const modal = document.querySelector('.modal');

        button.addEventListener('click', function() {
            // Tampilkan modal dengan mengubah properti transform
            modal.style.transform = 'translateY(0)';
        });

        var x = document.getElementById("myAudio");

        function playAudio() {
            x.play();
        }

        function pauseAudio() {
            x.pause();
        }

        function onScanSuccess(decodedText, decodedResult) {
            scannerResult = decodedText;

            $.ajax({
                url: '/post',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    data: scannerResult
                },
                success: function(response) {
                    console.log(response);
                    playAudio();
                    $('#scannerResult').html(response['data']);
                }
            });
        }
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                },
                rememberLastUsedCamera: true,
                showTorchButtonIfSupported: true
            });

        html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>

</html>
