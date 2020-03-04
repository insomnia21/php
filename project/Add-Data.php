<?php
include_once 'dbconfig.php';
if(isset($_POST['btn-save']))
{
 $norfid = $_POST['norfid'];
 $fname = $_POST['fname'];
 $lname = $_POST['lname'];
 $depart = $_POST['dept'];
 
 if($crud->create($norfid,$fname,$lname,$depart))
 {
  header("Location: add-data.php?inserted");
 }
 else
 {
  header("Location: add-data.php?failure");
 }
}
?>
<?php include_once 'header.php'; ?>
<div class="clearfix"></div>

<?php
if(isset($_GET['inserted']))
{
 ?>
    <div class="container">
 <div class="alert alert-success">
    <strong>GOTOWE !</strong> Nowy pracowanik dodany do bazy. <a href="viewEmployes.php">Wróć na stronę główną</a>
 </div>
 </div>
    <?php
}
else if(isset($_GET['failure']))
{
 ?>
    <div class="container">
 <div class="alert alert-warning">
    <strong>BŁĄD</strong>Nie udało się dodać nowego pracownika. Spróbuj ponownie lub skntaktuj się działem IT.
 </div>
 </div>
    <?php
}
?>

<div class="clearfix"></div><br />

<div class="container">

  
  <form method='post'>
 
    <table class='table table-bordered'>
        <tr>
            <td>NUMER NORFID</td>
            <td><input type='text' name='norfid' class='form-control' required></td>
        </tr>
        
        <tr>
            <td>IMIĘ</td>
            <td><input type='text' name='fname' class='form-control' required></td>
        </tr>
 
        <tr>
            <td>NAZWISKO</td>
            <td><input type='text' name='lname' class='form-control' required></td>
        </tr>
 
 
        <tr>
            <td>DZIAŁ</td>
            <td><input type='text' name='dept' class='form-control' required></td>
        </tr>
 
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
                <span class="glyphicon glyphicon-plus"></span> Dodaj pracownika
            </button>  
             <a href="viewEmployes.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Powrót</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once 'footer.php'; ?>