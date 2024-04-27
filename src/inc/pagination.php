<?php

if($page >= 2){   
    echo "<a href='$file?page=".($page-1)."'>  Prev </a>";   
}       
$pagLink = '';          
for ($i = 1; $i <= $model->getTotalNumberPages(); $i++) {   
  if ($i == $page) {   
      $pagLink .= "<a class = 'active' href='$file?page=".$i."'> ".$i." </a>";   
  }               
  else  {   
      $pagLink .= "<a href='$file?page=".$i."'> ".$i." </a>";     
  }   
};     
echo $pagLink;   

if($page < $model->getTotalNumberPages()){   
    echo "<a href='$file?page=".($page+1)."'>  Next </a>";   
}   
?>