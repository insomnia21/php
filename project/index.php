<?php 
  include_once 'Dbconfig.php'; 
  include_once 'header.php';
?>

<div class="clearfix"></div><br />

<div class="container">
    <div class="alert alert-warning">
         Logi ze wszystkich odbić pracowników za pomocą numeru NORFID.
    </div>
</div>

<div class="container">
  <table class='table table-bordered table-responsive'>
       <th>ID</th>
       <th>NORFID</th>
       <th>IMIE</th>
       <th>NAZWISKO</th>
       <th>DATA ODBICIA</th>
       <th>CZAS ODBICIA</th>
       <th>DZIAŁ</th>
       <th>LOKALIZACJA ODBICIA</th>
       <th>STATUS</th>
     <!-- <th colspan="2" align="center">Akcje</th> -->

     <?php
        $crud->CountDiffTime(12345, '2020-02-21');
        $query = "SELECT * FROM www_odbicia ORDER BY r_date DESC";       
        $records_per_page=15;
        $newquery = $crud->paging($query,$records_per_page);
        $crud->views($newquery);
      ?>
     <tr>
        <td colspan="9" align="center">
          <div class="pagination-wrap">
            <?php $crud->paginglink($query,$records_per_page); ?>
          </div>
        </td>
     </tr>
  </table>
</div>


<?php include_once 'footer.php'; ?>