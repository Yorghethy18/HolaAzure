<?php
// PHP Data Objects(PDO) Sample Code:
class Conexion{

  public function getConexion(){
    try {
      //Conexión al servidor
        $conn = new PDO("sqlsrv:server = tcp:server1392696.database.windows.net,1433; Database = bd1392696", "yhernandez1392696", "Senati123#");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
    catch (PDOException $e) {
        print("Error connecting to SQL Server.");
        die(print_r($e));
    }
  }
}


// SQL Server Extension Sample Code:
/*$connectionInfo = array("UID" => "yhernandez1392696", "pwd" => "{your_password_here}", "Database" => "bd1392696", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:server1392696.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);*/
?>