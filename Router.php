<?php

namespace MVC;


class Router
{


    public $rutasGet = [];

    public $rutasPost = [];


    public function get($url, $fn)
    {

        $this->rutasGet[$url] =  $fn;
    }

    public function post($url , $fn ){
        $this->rutasPost[$url] =  $fn;
    }

    public function validarRutas()
    {
        $urlActual = $_SERVER["PATH_INFO"] ?? "/";

      

        if ($_SERVER["REQUEST_METHOD"] = "GET") {
            $fn = $this->rutasGet[$urlActual] ?? null;
        }else{
            $fn = $this->rutasPost[$urlActual] ?? null;

        }


        if (!is_null($fn)) {
           
            call_user_func($fn , $this);
      
          } else {

 
              echo "página no encontrada";
          }

    }


    public function render($view, $datos = []){

       foreach($datos as $key => $value){

           $$key = $value;
       }

       ob_start(); 
       include __DIR__ . "/views/${view}.php";

       $contenido = ob_get_clean();

       include 'views/layout.php';

    }
}
