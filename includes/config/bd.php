<?php


function connect_bd():mysqli {

    $bd = new mysqli('localhost','root','', 'agenda'); 



    if(!$bd){

      echo "No se pudo conectar"; 
      exit; 

    }
    return $bd;

}





?> 