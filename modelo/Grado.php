<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Grado
 *
 * @author JoseCarlos
 */
class Grado extends Modelo{
    //put your code here
    private $idGrado;
    private $nombre;
    
    public function getIdGrado() {
        return $this->idGrado;
    }

    public function setIdGrado($idGrado) {
        $this->idGrado = $idGrado;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function __construct() {
        parent::__construct();
    }
    
     private function mapearGrado(Grado $grado, array $props) {
        if (array_key_exists('idGrado', $props)) {
            $grado->setIdGrado($props['idGrado']);
        }
         if (array_key_exists('nombre', $props)) {
            $grado->setNombre($props['nombre']);
        }  
    }
  
    private function getParametros(Grado $grad){
              
        $parametros = array(
            ':idGrado' => $grad->getIdGrado(),
            ':nombre' => $grad->getNombre()
        );
        return $parametros;
    }
    
    public function crearGrado(Grado $grado) {
        $sql = "INSERT INTO grado (idGrado, nombre) VALUES (?,?)";
        $this->__setSql($sql);
        $this->ejecutar($this->getParametros($grado));
    }

    public function leerGrados() {
        $sql = "SELECT idGrado, nombre FROM grado";
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $grads = array();
        foreach ($resultado as $fila) {
            $grado = new Grado();
            $this->mapearGrado($grado, $fila);
            $grads[$grado->getIdGrado()] = $grado;
        }
        return $grads;
    }

    public function actualizarGrado(Grado $grado) {
        $sql = "UPDATE grado SET nombre=?, horas=? WHERE idGrado=?";
        $this->__setSql($sql);
        $this->ejecutar($this->getParametros($grado));        
        }
    
    
    public function eliminarGrado(Grado $grado) {
        $sql = "DELETE grado where idGrado=?";
        $this->__setSql($sql);
        $param = array(':idGrado' => $grado->getIdGrado());
        $this->ejecutar($param);        
    }
  
    
}

?>
