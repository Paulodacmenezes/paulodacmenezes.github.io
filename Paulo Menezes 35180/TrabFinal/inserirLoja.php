<?php
if(isset($_POST["txtnome"]) && isset($_POST["txtlocalizacao"])){
 $nome=  $_POST["txtnome"];
 $localizacao= $_POST["txtlocalizacao"];
 include ("cnn.php");
 try {
    $sql ="insert into lojas (localizacao,nomeLoja) values(?, ?);";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$nome,$localizacao]);
    $total = $stmt->rowCount();
    
    $sql="SELECT LAST_INSERT_ID();";
    $stmt=$pdo->prepare($sql);
    $stmt->execute();
    $id=$stmt->fetchColumn();
    
    $sql="select * from lojas where id=?;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $loja = $stmt->fetch();

    $msg=array("msg"=>$total,"idloja"=>$loja['id'], "nomeloja"=>$loja['nomeLoja'], "localizacao"=>$loja['localizacao']);
    
    

    
 } catch (PDOException $e ) {
     $msg=array("msg"=>$e->getCode()); 
 }

}else{
    $msg=array("msg"=>-1);
}
echo json_encode($msg);
?>