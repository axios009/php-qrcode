<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <div id="qrCode" style="width: 250px; height :250px; background-repeat: no-repeat; background-size: cover;">
    <!-- <img srv> -->
  </div>
</body>
<script src="./js/jquery-3.7.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $.ajax({
      url: 'http://localhost/php-qrcode/index.php/generateQrCode',
      type: 'POST',
      dataType: 'json',
      data: { text: 'Test' },
      success: function (data) {
        // var url = "data:image/png;base64," + data.qrCode;
        $("#qrCode").css("background-image", "url('" + data.qrCode + "')");
      },
      error: function (xhr, status, error) {
        console.log(error)
      }
    });
  });
</script>

</html>