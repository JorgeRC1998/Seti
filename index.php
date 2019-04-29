<?php

header('Access-Control-Allow-Origin: *');

require './vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/select', function () {

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

    $miArray = array("Nombre"=>$fila['Nombre'], "NombreCientifico"=>$fila['Nombre_Cientifico'], "EsperanzaVida"=>$fila['Esperanza_Vida']);
    array_push($array , $miArray);
    } 
    echo(json_encode(array("animales" => $array)));

    // Libera la memoria del resultado
    mysql_free_result($resultado);

    // Cierra la conexión con la base de datos 
    mysql_close($iden); 

});

$app->post('/insertar', function () use ($app){

    $body = json_decode($app->request->getBody());
    $nom = $body->Nombre;
    $nomcie = $body->NombreCientifico;
    $espvid = $body->EsperanzaVida;

    if(!($iden = mysql_connect("localhost", "root", ""))) 
    die("Error: No se pudo conectar");
    
   // Selecciona la base de datos 
   if(!mysql_select_db("animales", $iden)) 
    die("Error: No existe la base de datos");
    
   // Sentencia SQL: muestra todo el contenido de la tabla "books"
   
   $sentencia = "INSERT INTO tbl_animales (Nombre, Nombre_Cientifico, Esperanza_Vida) VALUES('$nom', '$nomcie', '$espvid')"; 
   $resultado = mysql_query($sentencia, $iden); 
   
   if($resultado){
       echo "Insercion realizada";
   }else{
       echo "Algo fue mal";
   }
   
});

$app->delete('/eliminar/:id', function ($Id) use ($app){
    $body = json_decode($app->request->getBody());

    if(!($iden = mysql_connect("localhost", "root", ""))) 
    die("Error: No se pudo conectar");
    
   // Selecciona la base de datos 
   if(!mysql_select_db("animales", $iden)) 
    die("Error: No existe la base de datos");

    $sentencia = "DELETE FROM tbl_animales WHERE Id='$Id'";    
    
    $resultado = mysql_query($sentencia, $iden); 
   
    if($resultado){
        echo "ELIMINACION realizada";
    }else{
        echo "Algo fue mal";
    }
});

$app->put('/actualizar/:id', function ($Id) use ($app) {
    $body = json_decode($app->request->getBody());
    $nomcie = $body->NombreCientifico;
    
    if(!($iden = mysql_connect("localhost", "root", ""))) 
    die("Error: No se pudo conectar");
    
   // Selecciona la base de datos 
   if(!mysql_select_db("animales", $iden)) 
    die("Error: No existe la base de datos");

    $sentencia = "UPDATE tbl_animales SET Nombre_Cientifico = '$nomcie' WHERE Id = '$Id'";    
    
    $resultado = mysql_query($sentencia, $iden); 
   
    if($resultado){
        echo "actualizacion realizada";
    }else{
        echo "Algo fue mal";
    }
});

$app->run();

?>