<?php 
  include_once 'dbconfig.php'; 
  include_once 'header.php';

    // $datetime = time();
    // echo $datetime . "<br>" . "<br>";
    // $s = 1581335699201;
    // $s = time();
    // echo($s . "<br>");
    // echo(date("Y-m-d, H:i:s",$s));

    // $crud->getDifferntTime();
?>

<div class="clearfix"></div><br />

<div class="container">
    <div class="alert alert-warning">
        Raporty dzienne czasu pracy pracowników.
    </div>


<?php
  // $crud->checkTime();
?>

<form action="reportDay.php" method="POST">
  
  <label for="norfid">Imię</label>
  <input type="text" name="r_name" id="text">

  <label for="norfid">Nazwisko</label>
  <input type="text" name="r_surname" id="text">
  
  <!-- <label for="norfid">Dział</label>
  <input type="text" name="r_dept" id="text"> -->
  
  <label for="norfid">Data i czas</label>
  <input type="text" name="r_date" id="datepicker">
  <button type="submit" name="szukaj">Wyszukaj</button>
</form>
</div>

<div class="clearfix"></div><br />

<div class="container">
  <table class='table table-bordered table-responsive'>
       <th>IMIE</th>
       <th>NAZWISKO</th>
       <th>DZIAŁ</th>
       <th>CAŁKOWITY CZAS</th>

     <?php
        if(isset($_POST['szukaj'])) {

          $r_name = $_POST['r_name'];
          $r_surname = $_POST['r_surname'];
          $r_date = $_POST['r_date'];      

          echo $r_date;
          
          $crud->CountDiffTime(12345 ,$r_date);
          // $crud->search($r_name, $r_surname, $r_dept);
          // $crud->checkTime();
        }
      ?>
     <tr>
        <td colspan="8" align="center">
          <div class="pagination-wrap">
            
          </div>
        </td>
     </tr>
  </table>
</div>


<?php include_once 'footer.php'; ?>