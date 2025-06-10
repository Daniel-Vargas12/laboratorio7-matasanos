<?php 
require ("logica/Persona.php");
require ("logica/Paciente.php");
// si existe, devuelve la cadena sin espacios al inicio/final
// si no existe, devuelve una cadena vacía
$filtro = isset($_GET["filtro"]) ? trim($_GET["filtro"]) : '';

if ($filtro === '') {
    echo "<div class='alert alert-warning mt-3'>Por favor ingresa un término de búsqueda.</div>";
    return;
}
$paciente = new Paciente();
$pacientes = $paciente -> buscar($filtro);

if(count($pacientes) > 0){
    echo "<table class='table table-striped table-hover mt-3'>";
    echo "<tr><th>Id</th><th>Nombre</th><th>Apellido</th><th>Correo</th></tr>";

    $palabras = explode(" ", $filtro);

    foreach($pacientes as $pac){
        $nombre = $pac->getNombre();
        $apellido = $pac->getApellido();

        foreach ($palabras as $palabra) {
            if (strlen($palabra) > 0) {
                $nombre = preg_replace("/\b(" . preg_quote($palabra, '/') . ")\b/i", "<strong>$1</strong>", $nombre);
                $apellido = preg_replace("/\b(" . preg_quote($palabra, '/') . ")\b/i", "<strong>$1</strong>", $apellido);
            }
        }

        echo "<tr>";
        echo "<td>" . $pac->getId() . "</td>";
        echo "<td>" . $nombre . "</td>";
        echo "<td>" . $apellido . "</td>";
        echo "<td>" . $pac->getCorreo() . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    
}else{
    echo "<div class='alert alert-danger mt-3' role='alert'>No hay resultados</div>";
}
?>
