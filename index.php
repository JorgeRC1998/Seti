<?php

require './vendor/autoload.php';

$app = new \Slim\Slim();
$app->get('/select/', function () {

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
 
$array = [];
while($fila = mysql_fetch_assoc($resultado)) 
{ 

 $miArray = array("Nombre"=>$fila['Nombre'], "Nombre Cientifico"=>$fila['Nombre_Cientifico'], "Esperanza Vida"=>$fila['Esperanza_Vida']);
 array_push($array , $miArray);
} 
echo(json_encode(array("animales" => $array)));
echo '</table>';

// Libera la memoria del resultado
mysql_free_result($resultado);

// Cierra la conexión con la base de datos 
mysql_close($iden); 

});

$app->get('/insertar/:name:scientisName:age:id', function($name, $scientisName, $age, $id){
         // Se conecta al SGBD 
 if(!($iden = mysql_connect("localhost", "root", ""))) 
 die("Error: No se pudo conectar");
 
// Selecciona la base de datos 
if(!mysql_select_db("animales", $iden)) 
 die("Error: No existe la base de datos");

 $param1 = str_replace(":", "", $name);
 $param2 = str_replace(":", "", $scientisName);
 $param3 = str_replace(":", "", $age);
 $param4 = str_replace(":", "", $id);
 $param7 = (float) $param3;
 $param8 = (int) $param4;
$param5 = (string) $param1;
$param6 = (string) $param2;
 echo('<br>');
 echo($param1);
 echo($param2);
 echo($param3);
 echo($param4);

// Sentencia SQL: muestra todo el contenido de la tabla "books" 
$sentencia = "INSERT INTO tbl_animales (Nombre, Nombre_Cientifico, Esperanza_vida, Id) VALUES ($param5, '$param6', '$param7' ,'$param8')"; 
// Ejecuta la sentencia SQL 
mysql_query($sentencia, $iden); 

 echo("Operacion realizada exitosamente");

echo '</table>';


// Cierra la conexión con la base de datos 
mysql_close($iden); 
}) ;

$app->run();
?>