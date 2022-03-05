<?php
if(isset($_POST["idcolab"])){
  $idColab=$_POST["idcolab"];
  
  
  
 include ("cnn.php");
 try {
   
    $sql ="SELECT * FROM bancohoras  colaboradores WHERE idcolab = ?;";
    
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$idColab]);
    $total = $stmt->rowCount();
    $colab = $stmt->fetchAll(); 
    
    
    
 } catch (PDOException $e ) {
     $colab=array("msg"=>$e->getCode()); 
 }

}else{
    $colab=array("msg"=>-1);
}
echo json_encode($colab);
?>