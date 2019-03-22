<?php

require './vendor/autoload.php';

$app = new \Slim\Slim();
$app->get('/hello/', function () {


     // Se conecta al SGBD 
 if(!($iden = mysql_connect("localhost", "root", ""))) 
 die("Error: No se pudo conectar");
 
// Selecciona la base de datos 
if(!mysql_select_db("animales", $iden)) 
 die("Error: No existe la base de datos");
 
// Sentencia SQL: muestra todo el contenido de la tabla "books" 
$sentencia = "SELECT * FROM tbl_animales"; 
// Ejecuta la sentencia SQL 
$resultado = mysql_query($sentencia, $iden); 
if(!$resultado) 
 die("Error: no se pudo realizar la consulta");
 
//echo '<table>'; 
//echo '<th>' . 'Nombre' . '</th><th>' . 'Nombre_Cientifico' . '</th><th>' . 'Esperanza_Vida' . '</th>'; 
$array = [];
while($fila = mysql_fetch_assoc($resultado)) 
{ 
 /*echo '<tr>'; 
 echo '<td>' . $fila['Nombre'] . '</td><td>' . $fila['Nombre_Cientifico'] . '</td><td>' . $fila['Esperanza_Vida'] . '</td>'; 
 echo '</tr>'; */
 $miArray = array("Nombre"=>$fila['Nombre'], "Nombre Cientifico"=>$fila['Nombre_Cientifico'], "Esperanza Vida"=>$fila['Esperanza_Vida']);
//print_r(json_encode($miArray));
 array_push($array , $miArray);
} 
echo(json_encode($array));
echo '</table>';

// Libera la memoria del resultado
mysql_free_result($resultado);

// Cierra la conexión con la base de datos 
mysql_close($iden); 

});
$app->run();
?>