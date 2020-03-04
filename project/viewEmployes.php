<?php
include_once 'dbconfig.php';
?>
<?php include_once 'header.php'; ?>

<div class="clearfix"></div>
<div class="clearfix"></div><br />
<div class="container">
<div class="alert alert-warning">
    Lista pracowników z nadanymi numerami RFID.
</div>
<a href="Add-Data.php" class="btn btn-info" data-toggle="button" aria-pressed="false" autocomplete="off"><i class="glyphicon glyphicon-plus"></i> &nbsp;DODAJ PRACOWNIKA</a>
<div class="clearfix"></div><br />
</div>


<div class="container">
     <table class='table table-bordered table-responsive'>
       <th>ID</th>
       <th>NORFID</th>
       <th>IMIE</th>
       <th>NAZWISKO</th>
       <th>DZIAŁ</th>
     <th colspan="2" align="center">Actions</th>
     </tr>
     <?php
  $query = "SELECT * FROM www_pracownicy";       
  $records_per_page=15;
  $newquery = $crud->paging($query,$records_per_page);
  $crud->viewEmployes($newquery);
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