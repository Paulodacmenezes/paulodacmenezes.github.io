<?php
include ('cnn.php');
$msg;
  try {
    $idcolab=$_POST["txtidcolab"];
    $nomecolab=$_POST['txtnome'];
    $datanasc=  $_POST['txtdatanasc'];
    $horas=  $_POST['horas'];
    $idloja=  $_POST['parentId'];
    $name =$_FILES['fich']['name'];
    $size =$_FILES['fich']['size'];
    $type =$_FILES['fich']['type'];
    

    if(isset($_FILES['fich'])){
        preg_match("/image/", $type,$matches);
        if(count($matches)>0 && $size <300000){
              $ext = pathinfo($name, PATHINFO_EXTENSION);
              $filename = $idcolab . "." .$ext; 
              $destino = dirname(__DIR__) . "\\TF\\imgs\\" .$filename;
              echo $destino;
              move_uploaded_file($_FILES['fich']['tmp_name'], $destino);
        }
        $sql="update colaboradores set parentId= ?, NomeColaborador= ?,dataNasc= ?,HorasSemanais = ?, photo= ? where id=?;";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$idloja,$nomecolab,$datanasc,$horas,$filename,$idcolab] );
        $total = $stmt->rowCount();
        $msg=array("msg"=>$total);

    }

  } catch (PDOException $e) {
      $msg= array("msg"=> $e->getMessage());
  }

  echo json_encode($msg);

?>