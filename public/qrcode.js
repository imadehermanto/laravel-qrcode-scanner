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
        success: function (response) {
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
            width: 500,
            height: 500
        },
        rememberLastUsedCamera: true,
        showTorchButtonIfSupported: true
    });

html5QrcodeScanner.render(onScanSuccess);
