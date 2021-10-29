<?php

namespace Model;

use Exception;

class ActiveRecord
{



    public static $db;
    protected $columnDB = [];
    protected static $tabla = '';

    public static function setDB($bd)
    {

        self::$db = $bd;
    }


    public function guardar()
    {


        $atributos = $this->santitizarDatos();

        $str = join(",", array_keys($atributos));


        $query = "INSERT INTO " . static::$tabla . "($str)";
        $query .= " VALUES (?,?,?)";


        try {

            $stmt = self::$db->prepare($query);
            $stmt->bind_param("sss", $atributos['nombre'], $atributos['empresa'], $atributos['telefono']);
            $stmt->execute();


            $respuesta = array(
                "respuesta" => "correcto",
                "id" => $stmt->insert_id,
                "nombre" => $atributos['nombre'], 
                "empresa" => $atributos['empresa'],
                "telefono" => $atributos['telefono']

            );
        } catch (Exception $e) {

            $respuesta = array(
                "respuesta" => "error",
                "mensaje_error" => $e->getMessage()

            );
        }




        return $respuesta;
    }

    public function santitizarDatos()
    {

        $atr = $this->identificaColumnDB();
        $sanitizado = [];


        foreach ($atr as $key => $value) {

            $sanitizado[$key] = self::$db->escape_string($value);
        }


        return $sanitizado;
    }



    public function identificaColumnDB()
    {

        $atributos = [];

        foreach ($this->columnDB as $column) {
            if ($column === "id" && static::$tabla == "contactos")  continue;
            $col = $this->$column;

            $atributos[$column] = $col;
        }

        return $atributos;
    }

    public static function all()
    {

        $query = "SELECT * FROM ";
        $query .= static::$tabla;


        $resultado = self::getPropiedades($query);

        return $resultado;
    }


    public static function getPropiedades($query)
    {

        $array = [];
        $resultado = self::$db->query($query);

        self::validarId($resultado);

        while ($registro = $resultado->fetch_assoc()) {

            $array[] =  self::crearObjeto($registro);
        }

        return $array;
    }



      protected static function crearObjeto($registro)
      {
  
          $objeto = new static;
  
  
          foreach ($registro as $key => $value) {
  
              if (property_exists($objeto,  $key)) {
                  $objeto->$key =  $value;
              }
          }
          return $objeto;
      }


      public static function find($id)
      {
  
          $query = "SELECT * FROM ";
          $query .=  static::$tabla . " ";
          return static::consultaQuery(static::$tabla, $query, $id);
      }


      public static function consultaQuery($valor, $query, $id)
    {

            $query .= "where id = '${id}'";
            $resultado = self::getPropiedades($query);
            return  $resultado[0];
       
        
    }

    public function sincronizar($args = [])
    {

 
      
        foreach ($args as $key => $value) {

            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }

    }

    
    public static function validarId($resultado){

    
        if( $resultado->num_rows == 0){
  
          header("Location: ../agenda");
        }
           
      }

      public function actualizarDatos()
      {
  
  
          $atributos = $this->santitizarDatos();
          $valores = [];
  
          foreach ($atributos as $key => $value) {
              $valores[] = "${key} = '{$value}'";
          }
  
          $sql = "UPDATE " . static::$tabla . " SET ";
          $sql .= join(",", $valores);
          $sql .= " where id = '$this->id'";
  
   
          $result =  self::$db->query($sql);
          return $result;
          
      }


      
    public function eliminar_()
    {

        $consulta = "DELETE FROM " . static::$tabla . " WHERE id=$this->id";

    
        $resultado = self::$db->query($consulta);

        
        return $resultado;
    }


}
