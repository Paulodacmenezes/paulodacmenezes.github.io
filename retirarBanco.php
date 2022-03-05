<?php
if(isset($_POST["idcolab"]) && isset($_POST['horas']) && isset($_POST['txtdata'])){
  $idColab=$_POST["idcolab"];
  $horas = $_POST['horas'];
  $dataHoras= $_POST['txtdata'];
  
  
 include ("cnn.php");
 try {

    if($dataHoras == ""){
        $sql ="insert into bancohoras(horas,adicionarRetirar,idcolab)
        values(?,?,?);";
        
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$horas,0,$idColab]);
        $total = $stmt->rowCount();
        $msg=array("msg"=>$total);
        
     }
     else{
    $sql ="insert into bancohoras(horas,adicionarRetirar,idcolab,dataHoras)
    values(?,?,?,?);";
    
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$horas,0,$idColab,$dataHoras]);
    $total = $stmt->rowCount();
    $msg=array("msg"=>$total);
     }
    
 } catch (PDOException $e ) {
     $msg=array("msg"=>$e->getCode()); 
 }

}else{
    $msg=array("msg"=>-1);
}
echo json_encode($msg);
?>