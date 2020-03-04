<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>
<meta name="description" content="PHP MySQL PDO Example">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12">

<table class='table table-bordered'>
<tr>
<th>Time difference</th>
</tr>
<?php
$hostname="10.0.10.13";
$username="terminal";
$password="vbybfnc1232";
$db = "terminal";
$dbh = new PDO("mysql:host=$hostname;dbname=$db", $username, $password);

function jakas( $sekundy ){
    $czas = round($sekundy);
    echo sprintf('%02d:%02d:%02d', ($czas/3600),($czas/60%60), $czas%60);
  }
//   $sekundy = 900;
//   jakas($sekundy);

$crud->CountDiffTime();
?>

</tbody></table>
</div>
</div>
</div>
</body>
</html>