<?php
  include_once 'dbconfig.php';
  include_once 'header.php'; 
?>

<div class="clearfix"></div>

<div class="container">
  <h2>Aktualna procentowa absencja</h2>
  <div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="211" aria-valuemin="0" aria-valuemax="100" style="width:70%">
      <span class="sr-only">70% Complete</span>
    </div>
  </div>
</div>

<div class="clearfix"></div><br />

<div class="container">
     <table class='table table-bordered table-responsive'>
       <th>ID</th>
       <th>NORFID</th>
       <th>IMIE</th>
       <th>NAZWISKO</th>
       <th>DZIAŁ</th>
       <th>CZAS WEJŚCIA</th>
       <!-- <th colspan="2" align="center">Actions</th> -->
     </tr>
<?php
  date_default_timezone_set('UTC');   
  $f_today = date('d-m-Y');   // ustawia aktualną datę w polskim formacie
  $s_today = date('Y-m-d');   // ustawia date dla formatu z bazy danych
  $current_date =  $crud->dateV('l j f Y',strtotime($f_today));
     echo "<div class='alert alert-warning'><h5><span style='color: green; font-weight: bold; font-size: 15px;'>Lista aktualnie obecnych pracowników na terenie firmy w dniu dzisiejszym tj. </span>
     <span style='color: red; font-weight: bold; font-size: 15px;'> $current_date </span></h5> </div>";
 
    $query = "SELECT * from www_odbicia t JOIN (select max(id) id FROM www_odbicia group by r_name, r_surname) x on t.id=x.id WHERE r_status=0 AND r_date='$s_today'";      
  
    $records_per_page=15;
    $newquery = $crud->paging($query,$records_per_page);
    $crud->activeEmployees($newquery);
        
?>
    <tr>
        <td colspan="7" align="center">
    <div class="pagination-wrap">
            <?php $crud->paginglink($query,$records_per_page); ?>
         </div>
        </td>
    </tr>
 
</table>
   
       
</div>

<?php include_once 'footer.php'; ?>