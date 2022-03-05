<?php
$msg;
  try {
    $idloja=$_POST["txtidloja"];
    $nomeloja=$_POST['txtnome'];
    $localizacao=  $_POST['txtlocalizacao'];
    include ('cnn.php');
    $sql="update lojas set nomeLoja= ?, localizacao= ? where id=?;";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$nomeloja,$localizacao,$idloja] );
    $total = $stmt->rowCount();
    $msg=array("msg"=>$total);

  } catch (PDOException $e) {
      $msg= array("msg"=> $e->getMessage());
  }

  echo json_encode($msg);

?>