<?php
include_once 'dbconfig.php';

if(isset($_POST['btn-update'])) {
    $id = $_GET['edit_id'];
    $e_norfid = $_POST['e_norfid'];
    $e_name = $_POST['e_name'];
    $e_surname = $_POST['e_surname'];
    $e_dept = $_POST['e_dept'];
 
    if($crud->update($id,$e_norfid,$e_name,$e_surname,$e_dept)) {
         $msg = "<div class='alert alert-success'>
                 <strong>GOTOWE! </strong> Dane pracownika zostały pomyślnie zaktualizowane!
                 </div>";
    }else{
         $msg = "<div class='alert alert-warning'>
                 <strong>BŁĄD !</strong> Nie udało się zaktualizować danych pracownika, spróbuj ponownie.
                 </div>";
    }
}

if(isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];
    extract($crud->getID($id)); 
}

?>
<?php include_once 'header.php'; ?>

<div class="clearfix"></div>
<div class="container">

<?php
if(isset($msg)) {
    echo $msg;
}
?>

</div>

<div class="clearfix"></div><br />

<div class="container">  
     <form method='post'>
        <table class='table table-bordered'>
 
        <tr>
            <td>KARTA NORFID</td>
            <td><input type='text' name='e_norfid' class='form-control' value="<?php echo $e_norfid; ?>" required></td>
        </tr>
 
        <tr>
            <td>IMIĘ</td>
            <td><input type='text' name='e_name' class='form-control' value="<?php echo $e_name; ?>" required></td>
        </tr>
 
        <tr>
            <td>NAZWISKO</td>
            <td><input type='text' name='e_surname' class='form-control' value="<?php echo $e_surname; ?>" required></td>
        </tr>
 
        <tr>
            <td>DZIAŁ</td>
            <td><input type='text' name='e_dept' class='form-control' value="<?php echo $e_dept; ?>" required></td>
        </tr>
 
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-update">
                    <span class="glyphicon glyphicon-edit"></span> Aktualizuj
                </button>
                <a href="viewEmployes.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Powrót</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once 'footer.php'; ?>