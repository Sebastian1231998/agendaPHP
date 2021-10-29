<?php

namespace Controllers;

use MVC\Router;
use Model\Contacto;

class AgendaController
{

    public static function muestraAgenda(Router $router)
    {

        $contactos = Contacto::all();



        $router->render('app/agenda', [

            "contactos" => $contactos
        ]);
    }

    public static function actualizarAgenda(Router $router)
    {

        if(isset($_GET['id'])){
            $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
        }
      
      
        $contacto = Contacto::find($id);
       
        if (isset($_POST['accion']) == 'actualizar') {

            $contacto->sincronizar($_POST);
            $resultado = $contacto->actualizarDatos();

            if($resultado){
                $respuesta = array(
                  "respuesta" => "actualizado"
                );
            }

            echo json_encode($respuesta);



        } else if(empty($_POST )){
           
            $router->render('app/actualizar', [

                "id" => $id,
                "contacto" => $contacto
            ]);
        }
    }


    public static function contacto()
    {
        if ($_POST["accion"] == "crear") {

            $contacto = new Contacto($_POST);

            $respuesta = $contacto->guardar();

            echo json_encode($respuesta);
        }
        
    }

    public static function eliminarAgenda(){

        if(isset($_GET['id'])){
            $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
        }

  
        $contacto = Contacto::find($id);
        $resultado = $contacto->eliminar_();

        if($resultado){

            $respuesta = array(

                "respuesta" => "eliminado"

            );

            echo json_encode($respuesta);
        }
    }
}
