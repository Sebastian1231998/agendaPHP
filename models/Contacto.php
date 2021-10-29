<?php namespace Model;

class Contacto extends ActiveRecord{

    protected static $tabla = "contactos";

    protected $columnDB = ['id', 'nombre', 'empresa', 'telefono'];

    public $id;
    public $nombre; 
    public $empresa; 
    public $telefono; 
   
    public  function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->empresa = $args['empresa'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }




}
   


