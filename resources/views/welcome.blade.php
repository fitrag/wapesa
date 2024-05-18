<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
</head>

<body>
    <div id="html-content-holder" style="background-color: #F0F0F1; color: #00cc65; width: 500px;
        padding-left: 25px; padding-top: 10px;">
        <strong>Codepedia.info</strong>
        <hr/>
        <h3 style="color: #3e4b51;">
            Html to canvas, and canvas to proper image
        </h3>
        <p style="color: #3e4b51;">
            <b>Codepedia.info</b> is a programming blog. Tutorials focused on Programming ASP.Net, C#, jQuery, AngularJs, Gridview, MVC, Ajax, Javascript, XML, MS SQL-Server, NodeJs, Web Design, Software</p>
        <p style="color: #3e4b51;">
            <b>html2canvas</b> script allows you to take "screenshots" of webpages or parts of it, directly on the users browser. The screenshot is based on the DOM and as such may not be 100% accurate to the real representation.
        </p>
    </div>
    <input download="download.png" id="btn-Preview-Image" type="button" value="Download" />
    <br/>


    <script>
        $(document).ready(function() {


            var element = $("#html-content-holder"); // global variable
            var getCanvas; // global variable
            var newData;

            $("#btn-Preview-Image").on('click', function() {
                html2canvas(element, {
                    onrendered: function(canvas) {
                        getCanvas = canvas;
                        var imgageData = getCanvas.toDataURL("image/png");
                        var a = document.createElement("a");
                        a.href = imgageData; //Image Base64 Goes here
                        a.download = "Image.png"; //File name Here
                        a.click(); //Downloaded file
                    }
                });
            });


        });
    </script>
</body>

</html>