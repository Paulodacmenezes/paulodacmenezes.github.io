<?php
if(isset($_POST["idcolab"])){
 $idcolab=  $_POST["idcolab"];
 include ("cnn.php");
 try {
    $sql ="delete from bancohoras where idcolab= ?;";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$idcolab]);
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