<?php declare(strict_types=1);

if(count($_GET)>0){
  header('HTTP/1.0 404 Not Found', true, 404);
}
