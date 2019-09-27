<?php
$rfid = filter_input(INPUT_GET, 'rfid');
if (is_null($rfid)) {
  //Gravar log de erros
  die("Dados inválidos");
} 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smart_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  //Gravar log de erros
  die("Não foi possível estabelecer conexão com o BD: " . $conn->connect_error);
}
$sql = "select registry from users where rfid = $rfid";
$registry_user = $conn->query($sql)) {

if (isset($registry_user)) {
    $granted = true;
}else {
    $granted = false;
}

$sql = "INSERT INTO access_log (registry_user, granted) VALUES ($registry_user,$granted)";
 
if (!$conn->query($sql)) {
  //Gravar log de erros
  die("Erro na gravação dos dados no BD");
}
$conn->close();
?>