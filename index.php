<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QR-Code Generator</title>
  <link rel="shortcut icon" href="logo.png" type="image/x-icon">
  <!-- Include Bootstrap CSS (you should have Bootstrap installed) -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <!-- Google Poppins Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }

    form {
      padding: 0px 100px 0px 100px;
    }

    .background {
      position: absolute;
      height: 100%;
      width: 100%;
      background-image: url('bg.webp');
      /* background-size: cover; */
      filter: blur(10px);
    }

    .qr-code {
      text-align: center;
      margin-top: 20px;
      padding: 0px 20px;
    }

    .img-fluid {
      max-width: 70%;
    }
  </style>
</head>

<body>
  <div class="background"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3 col-12">

        <h2 class="text-center mb-4 mt-4">
          <b style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);">
            <img src="logo.png" width="50px" height="40px" alt="Logo">&nbsp;QR-Code Generator&nbsp;<img src="logo.png" width="50px" height="40px" alt="Logo">
          </b>
        </h2>
        <form method="post">
          <div class="form-group input-group">
            <div class="input-group-prepend mb-0">
              <span class="input-group-text"><i class="fas fa-phone"></i></span>
            </div>
            <input type="tel" class="form-control" id="private_phone" name="private_phone" placeholder="Phone" required>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Generate QR Code</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          // Get the private or hidden phone number from the form
          $privatePhoneNumber = $_POST['private_phone'];

          // Construct the tel: URL
          $telURL = 'tel:+91' . $privatePhoneNumber;

          // Generate a unique filename for the QR code
          $fileName = 'QR-codes/qrcode_' . time() . '.png';

          // Generate and save the QR code
          $qrCodeURL = 'https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl=' . urlencode($telURL);
          file_put_contents($fileName, file_get_contents($qrCodeURL));

        ?>
          <div class="qr-code">
            <?php
            // Display the QR code
            echo '<img src="' . $fileName . '" class="img-fluid mx-auto" style="border-radius: 6px;" alt="QR Code">';
            ?>
            <div class="row" style="padding: 0 80px 0 80px">
              <div class="col-6 pr-1">

                <?php
                // Provide a download link for the QR code
                echo '<a href="' . $fileName . '" download="' . $fileName . '" class="btn btn-success btn-block mt-2">Download</a>';
                ?>
              </div>
              <div class="col-6 pl-1">
                <?php
                echo '<a href="index.php" class="btn btn-danger btn-block mt-2">Clear</a>';
                ?>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>

  <!-- Include Bootstrap JS (you should have Bootstrap installed) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>