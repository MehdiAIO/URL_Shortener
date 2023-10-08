<?php

require "../config.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];



    // Getting link :
    $sql = $conn->prepare("SELECT * FROM urls WHERE id = :id");
    $sql->execute([':id' => $id]);
    $url = $sql->fetch(PDO::FETCH_OBJ);

    // Add click :
    $clicks=$url->click + 1;
    $count = $conn->prepare("UPDATE urls SET click=:clicks WHERE id='$id'");
    $count->execute([':clicks' => $clicks]);


    header("Location: " . $url->url);

}


?>