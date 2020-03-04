<?php 
include_once 'dbconfig.php'; 
include_once 'header.php';

if(isset($_POST['szukaj'])) {
    $norfid = $_POST['norfid'];
    $r_name = $_POST['r_name'];
    $r_surname = $_POST['r_surname'];
    $r_dept = $_POST['r_dept'];
    
    dateTime(41865000);
    echo dateTime();
    $crud->search($norfid, $r_name, $r_surname, $r_dept);

    }
?>
