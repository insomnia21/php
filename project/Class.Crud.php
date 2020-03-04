<?php

////////////////////  // CLASS CRUD  \\   //////////////////// 


class crud  {
   private $db;
 
   function __construct($DB_con) {
      $this->db = $DB_con;
   }
 
 ////////////////////  // CREATE EMPLOYEES FUNCTION \\   //////////////////// 


   public function create($norfid,$fname,$lname,$depart) { 
      try {
         $stmt = $this->db->prepare("INSERT INTO www_pracownicy(e_norfid, e_name, e_surname, e_dept) VALUES (:e_norfid, :e_name, :e_surname, :e_dept)");
         $stmt->bindparam(":e_norfid",$norfid);
         $stmt->bindparam(":e_name",$fname);
         $stmt->bindparam(":e_surname",$lname);
         $stmt->bindparam(":e_dept",$depart);
         $stmt->execute();
         return true;
      }catch(PDOException $e) { 
         echo $e->getMessage(); 
         return false;
      }
   }
 
 public function getID($id)   {
      $stmt = $this->db->prepare("SELECT * FROM www_pracownicy WHERE id=:id");
      $stmt->execute(array(":id"=>$id));
      $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  return $editRow;
 }

 ////////////////////  // getDifferntTime \\   //////////////////// 

 public function getDifferntTime() {
   $stmt = $this->db->prepare("SELECT * FROM www_odbicia WHERE id = 680");
   $stmt->execute();
   if (!$stmt->rowCount() == 0) 
   {
       while ($results = $stmt->fetch()) 
       {
           print($results['r_current_time']);
           print($results['r_name']);
       }       
   } 
   else 
   {
       echo 'Nothing found';
   }

}


// public function CountTime() {
//    $obj = $this->db->prepare("SELECT max(r_time) AS maxTime, min(r_time) AS minTime 
//                               FROM www_odbicia 
//                               WHERE norfid = 12345 AND r_date ='2020-02-14'");
//    $obj->execute();
//       if(!$obj->rowCount() == 0)
//       {
//          while($results = $obj->fetch()) {
//             print($results['minTime']);
//             print($results['maxTime']);
//          }
//       }
//       else {
//         echo "Taki przedział dla czasu pracy jeszcze nie istnieje";
//       }
// }

/**
* Funkcja zwraca różnice czasu biorąc pod uwagę maksymalny i minimalny czas pomiędzy odbiciami w ciągu jednego dnia
*/
public function CountDiffTime(int $norfid, string $date) { 
   $obj = $this->db->prepare("SELECT min(r_time) AS minTime, max(r_time) AS maxTime, r_date AS r_date, r_name, r_surname, r_dept
                              FROM www_odbicia 
                              WHERE norfid = ".$norfid." AND r_date = '$date' GROUP BY r_name, r_surname, r_dept");
   $obj->execute();
      if(!$obj->rowCount() == 0)
      {
         while($results = $obj->fetch(PDO::FETCH_ASSOC)) {
            // przypisanie do zmiennych wartości godzin wejścia i wyjścia z tablicy
            $maxTime = $results['maxTime'];
            $minTime = $results['minTime'];
            $name = $results['r_name'];
            $surName = $results['r_surname'];
            $department = $results['r_dept'];

            // przekonwertowanie na czas unixowy
            $timestampMinTime = strtotime($minTime);
            $timestampMaxTime = strtotime($maxTime) ? strtotime($maxTime) : 'jeszcze jest w pracy' ;
            // wyliczenie różnicy
            $diff = ($timestampMaxTime - $timestampMinTime);
            $diffTime = round($diff);
                echo sprintf('%02d:%02d:%02d', ($diffTime/3600),($diffTime/60%60), $diffTime%60); 
                ?>
                   <tr>
                     <td><?php print($results['r_name']); ?></td>
                     <td><?php print($results['r_surname']); ?></td>
                     <td><?php print($results['r_dept']);  ?></td>
                     <td><?php print(sprintf('%02d:%02d:%02d', ($diffTime/3600),($diffTime/60%60), $diffTime%60));  ?></td>
               </tr>
                <?php
         }
      }                                                  
      else {
        echo "Taki przedział dla czasu pracy jeszcze nie istnieje";
      }
}


public function DiffTime( $sekundy ){
   $czas = round($sekundy);
   echo sprintf('%02d:%02d:%02d', ($czas/3600),($czas/60%60), $czas%60);
 }

 
////////////////////  // UPDATE EMPLOYEES FUNCTION \\   //////////////////// 


 public function update($id,$e_norfid,$e_name,$e_surname,$e_dept)
 {
  try
  {
   $stmt=$this->db->prepare("UPDATE www_pracownicy SET e_norfid=:e_norfid, 
                                                       e_name=:e_name, 
                                                       e_surname=:e_surname, 
                                                       e_dept=:e_dept
                                                   WHERE id=:id ");
   $stmt->bindparam(":e_norfid",$e_norfid);
   $stmt->bindparam(":e_name",$e_name);
   $stmt->bindparam(":e_surname",$e_surname);
   $stmt->bindparam(":e_dept",$e_dept);
   $stmt->bindparam(":id",$id);
   $stmt->execute();
   
   return true; 
  }
  catch(PDOException $e)
  {
   echo $e->getMessage(); 
   return false;
  }
 }


 //////////////////// report EMPLOYES \\\\\\\\\\\\\\\\\\\\

 public function reportEmployess() {

   $stmt = $this->db->prepare("SELECT * FROM www_pracownicy");
   $stmt->execute();

   if($stmt !== 0)  {
      while($row=$stmt->fetch(PDO::FETCH_ASSOC))  {
         // echo('<select name="e_name">');
         // echo('<option>'.$row['e_surname'].'</option>');
           print ($row['e_surname']);
	      // echo('</select>');
      } 
	}
 }

 ////////////////////  // check TIME MIN MAX FUNCTION \\   //////////////////// 


public function checkTime() {
   $stmt = $this->db->prepare("SELECT min(r_time) as cos1, max(r_time) as cos2 FROM www_odbicia WHERE r_date = '2020-02-03' AND norfid= '1234';");
   $stmt->execute();

   if($stmt == true)  {
         while($row=$stmt->fetch(PDO::FETCH_ASSOC))  {
            //   print($row['cos1']);
            //   print($row['cos2']);

            $result = ("SELECT min(r_time) as cos , max(r_time) as cos2 FROM www_odbicia WHERE r_date = '2020-02-13' AND norfid = 1234");
            
            $a = "'";
            
            //echo  "SELECT TIMEDIFF(" . $a  . "2020-02-03 " . $row['cos2']  . $a  . " ," . $a  . " 2020-02-03 " .  $row['cos1'] .  $a  .")"; 

            $stmt1 = $this->db->prepare("SELECT TIMEDIFF(" . $a  . "2020-02-13" . $row['cos2']  . $a  . " ," . $a  . "2020-02-13" .  $row['cos1'] .  $a  .") as T_TIME");
            $stmt1->execute();

            if($stmt1 == true)  {
               while($row=$stmt1->fetch(PDO::FETCH_ASSOC))  {
                    print($row['T_TIME']);
               }
            }
         }
   }
}

/////////////////////   SEARCH FUNCTION LIKE  \\\\\\\\\\\\\\\\\\\\\

public function searchLike() {
   $query = $database->prepare('SELECT * FROM table WHERE r_name LIKE ?');
   $query->bindValue(1, "%$value%", PDO::PARAM_STR);
   $query->execute();
   
   if (!$query->rowCount() == 0) 
   {
       while ($results = $query->fetch()) 
       {
           print($results['r_name']);
       }       
   } 
   else 
   {
       echo 'Nothing found';
   }

}


/////////////////////   search function \\\\\\\\\\\\\\\\\\\\\

public function search($r_name, $r_surname, $r_dept)  {
   $stmt4 = $this->db->prepare("SELECT norfid, r_name, r_surname, r_dept FROM www_odbicia WHERE r_name=:r_name OR r_surname=:r_surname OR r_dept=:r_dept LIMIT 3");
   $stmt4->bindparam(':r_name',$r_name, PDO::PARAM_STR);
   $stmt4->bindparam(':r_surname',$r_surname, PDO::PARAM_STR);
   $stmt4->bindparam(':r_dept',$r_dept, PDO::PARAM_STR);
   $stmt4->execute();

    if($stmt4->rowCount()>0) {
      while($row=$stmt4->fetch(PDO::FETCH_ASSOC))  {
      ?>
      <tr>
         <td><?php print($row['norfid']); ?></td>
         <td><?php print($row['r_name']); ?></td>
         <td><?php print($row['r_surname']); ?></td>
         <td><?php print($row['r_dept']);  ?></td>
     </tr>
     <?php

      } 
   }
}

////////////////////  // DELETE EMPLOYEES FUNCTION \\   //////////////////// 

 
 public function delete($id)
 {
  $stmt = $this->db->prepare("DELETE FROM www_pracownicy WHERE id=:id");
  $stmt->bindparam(":id",$id);
  $stmt->execute();
  return true;
 }
 
///////////////////// // view data logs \\   //////////////////// 

public function logs($query)  {
   $stmt = $this->db->prepare($query);
   $stmt->execute();

   if($stmt->rowCount()>0)  {
         while($row=$stmt->fetch(PDO::FETCH_ASSOC))   {
         ?>
            <tr>
               <td><?php print($row['id']); ?></td>
               <td><?php print($row['norfid']); ?></td>
               <td><?php print($row['r_name']); ?></td>
               <td><?php print($row['r_surname']); ?></td>
               <td><?php print($row['r_date']); ?></td>
               <td><?php print($row['r_time']); ?></td>
               <td><?php print($row['r_dept']); ?></td>
               <td><?php print($row['r_status']); ?></td>
            </tr>
         <?php
      }
  }else{
   ?>
       <tr>
          <td>Brak ID</td>
         </tr>
   <?php
  }
}


public function views($query)  {
   $stmt = $this->db->prepare($query);
   $stmt->execute();

   if($stmt->rowCount()>0)  {
         while($row=$stmt->fetch(PDO::FETCH_ASSOC))   {
         ?>
            <tr>
               <td><?php print($row['id']); ?></td>
               <td><?php print($row['norfid']); ?></td>
               <td><?php print($row['r_name']); ?></td>
               <td><?php print($row['r_surname']); ?></td>
               <td><?php print($row['r_date']); ?></td>
               <td><?php print($row['r_time']); ?></td>
               <td><?php print($row['r_dept']); ?></td>
               <td><?php print($row['r_localization']); ?></td>
               <td><?php print($row['r_status']); ?></td>
            </tr>
         <?php
         }  
   }else{   
      ?>
         <tr>
            <td>Brak ID</td>
         </tr>
      <?php
   }
}

////////////////////  // VIEW EMPLOYEES FUNCTION \\   //////////////////// 

public function viewEmployes($query)  {
   $stmt = $this->db->prepare($query);
   $stmt->execute();

   if($stmt->rowCount()>0)  {
         while($row=$stmt->fetch(PDO::FETCH_ASSOC))   {
         ?>
            <tr>
               <td><?php print($row['id']); ?></td>
               <td><?php print($row['e_norfid']); ?></td>
               <td><?php print($row['e_name']); ?></td>
               <td><?php print($row['e_surname']); ?></td>
               <td><?php print($row['e_dept']); ?></td>
               <td align="center">
                  <a href="Edit-Data.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
               </td>
               <td align="center">
                  <a href="delete.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
               </td>
            </tr>
         <?php
         }  
   }else{   
      ?>
         <tr>
            <td>Brak ID</td>
         </tr>
      <?php
   }
}


////////////////////  // ABSENCE EMPLOYEES FUNCTION  \\   //////////////////// 


public function activeEmployees($query)  {
   $stmt = $this->db->prepare($query);
   $stmt->execute();

   if($stmt->rowCount()>0)  {
         while($row=$stmt->fetch(PDO::FETCH_ASSOC))   {
         ?>
            <tr>
               <td><?php print($row['id']); ?></td>
               <td><?php print($row['norfid']); ?></td>
               <td><?php print($row['r_name']); ?></td>
               <td><?php print($row['r_surname']); ?></td>
               <td><?php print($row['r_dept']); ?></td>
               <td><?php print($row['r_time']); ?></td>               
               <!-- <td align="center">
                  <a href="edit-data.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
               </td>
               <td align="center">
                  <a href="delete.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
               </td> -->
            </tr>
         <?php
         }  
   }else{   
      ?>
         <tr>
            <!-- <td>Dziś tj. <? echo date("d m Y"); ?></td> -->
         </tr>
      <?php
   }
}

////////////////////  // DATE SET FUNCTION \\   //////////////////// 

public function dateV($format,$timestamp=null){
	$to_convert = array(
		'l'=>array('dat'=>'N','str'=>array('Poniedziałek','Wtorek','Środa','Czwartek','Piątek','Sobota','Niedziela')),
		'F'=>array('dat'=>'n','str'=>array('styczeń','luty','marzec','kwiecień','maj','czerwiec','lipiec','sierpień','wrzesień','październik','listopad','grudzień')),
		'f'=>array('dat'=>'n','str'=>array('stycznia','lutego','marca','kwietnia','maja','czerwca','lipca','sierpnia','września','października','listopada','grudnia'))
	);
	if ($pieces = preg_split('#[:/.\-, ]#', $format)){	
		if ($timestamp === null) { $timestamp = time(); }
		foreach ($pieces as $datepart){
			if (array_key_exists($datepart,$to_convert)){
				$replace[] = $to_convert[$datepart]['str'][(date($to_convert[$datepart]['dat'],$timestamp)-1)];
			}else{
				$replace[] = date($datepart,$timestamp);
			}
		}
		$result = strtr($format,array_combine($pieces,$replace));
		return $result;
	}
}

////////////////////  // PAGE FUNCTION \\   //////////////////// 
 
 public function paging($query,$records_per_page)
 {
  $starting_position=0;
  if(isset($_GET["page_no"]))
  {
   $starting_position=($_GET["page_no"]-1)*$records_per_page;
  }
  $query2=$query." limit $starting_position,$records_per_page";
  return $query2;
 }


////////////////////  // PAGE LINK FUNCTION \\   //////////////////// 
 

 public function paginglink($query,$records_per_page)
 {
  
  $self = $_SERVER['PHP_SELF'];
  
  $stmt = $this->db->prepare($query);
  $stmt->execute();
  
  $total_no_of_records = $stmt->rowCount();
  
  if($total_no_of_records > 0)
  {
   ?><ul class="pagination"><?php
   $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
   $current_page=1;
   if(isset($_GET["page_no"]))
   {
    $current_page=$_GET["page_no"];
   }
   if($current_page!=1)
   {
    $previous =$current_page-1;
    echo "<li><a href='".$self."?page_no=1'>Pierwsza</a></li>";
    echo "<li><a href='".$self."?page_no=".$previous."'>Ostatnia</a></li>";
   }
   for($i=1;$i<=$total_no_of_pages;$i++)
   {
    if($i==$current_page)
    {
     echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
    }
    else
    {
     echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
    }
   }
   if($current_page!=$total_no_of_pages)
   {
    $next=$current_page+1;
    echo "<li><a href='".$self."?page_no=".$next."'>Następna</a></li>";
    echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Porzednia</a></li>";
   }
   ?></ul><?php
  }
 }
 
 /* paging */
 
}
