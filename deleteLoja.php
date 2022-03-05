<?php
if(isset($_POST["idloja"])){
 $idloja=  $_POST["idloja"];
 include ("cnn.php");
 try {
    $sql ="delete from lojas where id= ?;";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$idloja]);
    $total = $stmt->rowCount();
    $msg=array("msg"=>$total); 
 } catch (PDOException $e ) {
     $msg=array("msg"=>$e->getCode()); 
 }

}else{
  $msg=array("msg"=>"erro");
}
echo json_encode($msg);
?>