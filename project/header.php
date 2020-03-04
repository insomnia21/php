<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pl" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>REJESTR CZASU PRACY</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
<script src="bootstrap/js/bootstrap.min.js"></script> 

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

$( function() {
    $( "#datepicker" ).datepicker();
});

</script>
</head>


<body>
 
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">  
            <!-- <a class="navbar-brand" href="index.php" title='system rejestracji czasu pracy'>STRONA GŁÓWNA</a> -->
            <div class="navbar-brand">
                <div class="container">
                    <a href="index.php" class="btn btn-danger" data-toggle="button" aria-pressed="false" autocomplete="off"><i class="glyphicon glyphicon-check"></i> &nbsp;LOGI</a>
                    <a href="activeEmployees.php" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off"><i class="glyphicon glyphicon-check"></i> &nbsp;Aktualnie obecni</a>
                    <a href="viewEmployes.php" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off"><i class="glyphicon glyphicon-check"></i> &nbsp;Lista pracowników</a>
                    <a href="reportDay.php" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off"><i class="glyphicon glyphicon-check"></i> &nbsp;Raporty dzienne</a>
                </div>
            </div>
            <div class="clearfix"></div><br />
        </div>
    </div>
</div>

<p>Date: <input type="text" id="datepicker"></p>
<div class="container">

<div>


</html>
