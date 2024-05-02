<!DOCTYPE html>
<html>
  <head>
    <title>Test Scan</title>
</head>
<body>
    <h1>Hasil : <span id="hasil"></span></h1>
    <video id="preview"></video>
    <script type="text/javascript" src="{{ asset('instascan.min.js') }}"></script>
    <script type="text/javascript">
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        scanner.addListener('scan', function (content) {
            document.getElementById('hasil').innerHTML = content
        });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
    </script>
  </body>
</html>