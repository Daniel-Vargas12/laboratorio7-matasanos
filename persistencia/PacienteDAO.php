<?php

class PacienteDAO{
    private $id;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $fechaNacimiento;

    public function __construct($id = 0, $nombre = "", $apellido = "", $correo = "", $clave = "", $fechaNacimiento = ""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> fechaNacimiento = $fechaNacimiento;
    }

       
    public function autenticar(){
        return "select idPaciente
                from Paciente
                where correo = '" . $this -> correo . "' and clave = '" . md5($this -> clave) . "'";
    }
    
    public function consultar(){
        return "select p.nombre, p.apellido, p.correo, p.fechaNacimiento  
                from Paciente p
                where idPaciente = '" . $this -> id . "'";
    }

    public function buscar($filtro){
        $filtro = trim(preg_replace('/\s+/', ' ', $filtro)); 
        $palabras = explode(" ", $filtro);
        
        $condiciones = array();
        foreach ($palabras as $palabra) {
            $condiciones[] = "(p.nombre LIKE '%$palabra%' OR p.apellido LIKE '%$palabra%')";
        }

        $sql = "SELECT p.idPaciente, p.nombre, p.apellido, p.correo
                FROM Paciente p
                WHERE " . implode(" AND ", $condiciones);//añadir todas las condiciones(palabras del filtro)
        return $sql;
    }


}
