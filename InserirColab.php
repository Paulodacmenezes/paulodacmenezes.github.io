<?php
if(isset($_POST["txtnome"]) && isset($_POST["txtdatanasc"]) && isset($_POST["txthorascont"]) && isset($_POST['parentId'])){
 $nome=  $_POST["txtnome"];
 $dataNasc= $_POST["txtdatanasc"];
 $horascont = $_POST["txthorascont"];
 $parentId= $_POST['parentId']; 
 include ("cnn.php");
 try {
    $sql ="insert into colaboradores (NomeColaborador,dataNasc,HorasSemanais,parentId) values(?,?,?,?);";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$nome,$dataNasc,$horascont,$parentId]);
    $total = $stmt->rowCount();
    
    $sql="SELECT LAST_INSERT_ID();";
    $stmt=$pdo->prepare($sql);
    $stmt->execute();
    $id=$stmt->fetchColumn();
    
    $sql="call getColabLoja(?);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $colab = $stmt->fetch();

    $msg=array("msg"=>$total,"nomeLoja"=>$colab["nomeLoja"], "idcolab"=>$colab['id'],"nomecolab"=>$colab['NomeColaborador'], "dataNasc"=>$colab['dataNasc'],"horascont"=>$colab['HorasSemanais'],"saldoHoras"=>$colab['saldoHoras']);
    
    

    
 } catch (PDOException $e ) {
     $msg=array("msg"=>$e->getCode()); 
 }

}else{
    $msg=array("msg"=>-1);
}
echo json_encode($msg);
?>