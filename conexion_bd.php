<?php

function AbrirCon(){

    $serverName="localhost";
    $username="root";
    $password="";
    $dbname="proremodelaciones";

    $conn=new mysqli($serverName,$username, $password, $dbname) or die ("Error: %s\n" . $conn-> error);
    return $conn;

}


function CerrarCon($conn){
    $conn->close();
}

?>