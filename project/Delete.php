<?php
include_once 'dbconfig.php';

if(isset($_POST['btn-del']))
{
 $id = $_GET['delete_id'];
 $crud->delete($id);
 header("Location: delete.php?deleted"); 
}

?>

<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">

 <?php
 if(isset($_GET['deleted']))
 {
  ?>
        <div class="alert alert-success">
     <strong>GOTOWE !</strong> Pracownik został pomyślnie usunięty z bazy danych. 
  </div>
        <?php
 }
 else
 {
  ?>
        <div class="alert alert-danger">
     <strong>UWAGA </strong> Czy napewno chcesz usunąć pracownika z bazy danych? <br /> Pracownik utraci możliwość odbicia się przez system rejestru czasu pracy. 
  </div>
        <?php
 }
 ?> 
</div>

<div class="clearfix"></div>

<div class="container">
  
  <?php
  if(isset($_GET['delete_id']))
  {
   ?>
         <table class='table table-bordered'>
         <tr>
            <th>#</th>
            <th>NR NORFID</th>
            <th>IMIĘ</th>
            <th>NAZWISKO</th>
            <th>DZIAŁ</th>
         </tr>
         <?php
         $stmt = $DB_con->prepare("SELECT * FROM www_pracownicy WHERE id=:id");
         $stmt->execute(array(":id"=>$_GET['delete_id']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {
             ?>
             <tr>
             <td><?php print($row['id']); ?></td>
             <td><?php print($row['e_norfid']); ?></td>
             <td><?php print($row['e_name']); ?></td>
             <td><?php print($row['e_surname']); ?></td>
             <td><?php print($row['e_dept']); ?></td>
             </tr>
             <?php
         }
         ?>
         </table>
         <?php
  }
  ?>
</div>

<div class="container">
<p>
<?php
if(isset($_GET['delete_id']))
{
 ?>
   <form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
    <button class="btn btn-large btn-danger" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; TAK</button>
    <a href="viewEmployes.php" class="btn btn-large btn-primary"><i class="glyphicon glyphicon-backward"></i> &nbsp; NIE</a>
    </form>  
 <?php
}
else
{
 ?>
    <a href="viewEmployes.php" class="btn btn-large btn-default"><i class="glyphicon glyphicon-backward"></i> &nbsp; Powrót do listy pracowników</a>
    <?php
}
?>
</p>
</div> 
<?php include_once 'footer.php'; ?>