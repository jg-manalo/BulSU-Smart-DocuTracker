<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/style.css', 'resources/js/script.js'])
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <style>
        #reader{
           
            width: 350px;
            height: 350px;
            margin: auto;
            border: 2px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            
        }
         @media screen and (max-width: 350px) {
               #reader{
                width: 350px;
                height: 350px;
               } 
            }
    </style>
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('QR Code Scanner') }}
            </h2>
        </x-slot>

        <div class="container">
            <div class="row">
                <div id="reader"></div>
                <div class="result"></div>
            </div>
        </div>
        <script>
            const scanner = new Html5QrcodeScanner('reader', { 
                // Scanner will be initialized in DOM inside element with id of 'reader'
                qrbox: {
                    width: 250,
                    height: 250,
                },  // Sets dimensions of scanning box (set relative to reader element width)
                fps: 20, // Frames per second to attempt a scan
            });
            scanner.render(success, error);
            function success(qrCodeMessage, decodedImage) {
                // Handle the scanned QR code message
                console.log("QR Code scanned: ", qrCodeMessage);
                // You can also display the result in the result div
                document.location.href = qrCodeMessage;
            } 
            function error(errorMessage) {
                // Handle scan error
                console.error("QR Code scan error: ", errorMessage);
            }
        </script>
    </x-app-layout>
    
</body>
</html>