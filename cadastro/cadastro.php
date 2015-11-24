<?php
require_once 'dbconfig.php';
 
/*
 * verifica se o botão cadastrar foi pressionado
 */
if(isset($_POST['btn'])) {
    


/*
 * Conexão com banco de dados
 */
try { //criação do objeto $conn - conexão
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    //echo "Connected to $dbname at $host successfully.";
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}


/*
 * Recepção de dados
 */

echo "$_POST[email]";

//fechar conexão com o banco
$conn= null;
} else {
    //Botão cadastrar nao foi pressionado
    // redireciona para pagina inicial
    header('Location: index.php');
}