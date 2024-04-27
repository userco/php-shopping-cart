<?php
if (!isset ($_GET['page']) ) {  
    $page = 1;  
} else if (is_numeric($_GET['page'])){  
    $page = $_GET['page'];  
}  