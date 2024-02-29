<?php
if(!is_null($_POST) && !empty($_POST && is_array($_POST))){
    foreach($_POST as $idVal => $valEnd){
        echo $idVal." => ".$valEnd."<br>\n";
    }
}