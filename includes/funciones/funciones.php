

<?php 

function debugear($value){

echo"<pre>"; 

var_dump($value);

echo "</pre>"; 
exit;


}


function sanitizar($propiedad)
{

     $propiedad_sanitizada = htmlspecialchars($propiedad);

     return $propiedad_sanitizada;
}



