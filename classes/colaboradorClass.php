<?php



class Colaborador extends Dbh
{

    public function getColabsLoja()
    {
    
    $sql = "call getColabsLoja()";
    $stmt = $this->connect()->prepare($sql);
    
    if (!$stmt->execute()) {
    $stmt = null;
    header("location: ../index.php?error=stmtfailed1");
    exit();
    }
    
    
    
    if ($stmt->rowCount() == 0) {
    $stmt = null;
    header("location: ../index.php?error=colaboradoresnotfound");
    exit();
    }
    
    
    $colabs = $stmt->fetchAll();
    return $colabs;
    $stmt = null;
    }
    
public function getAll()
{

$sql = "SELECT * FROM colaboradores;";
$stmt = $this->connect()->prepare($sql);

if (!$stmt->execute()) {
$stmt = null;
header("location: ../index.php?error=stmtfailed1");
exit();
}



if ($stmt->rowCount() == 0) {
$stmt = null;
header("location: ../index.php?error=colaboradoresnotfound");
exit();
}


$colabs = $stmt->fetchAll();
return $colabs;
$stmt = null;
}

public function getColab($id)
{

$sql = "SELECT * FROM colaboradores WHERE id = ?;";
$stmt = $this->connect()->prepare($sql);

if (!$stmt->execute([$id])) {
$stmt = null;
header("location: ../index.php?error=stmtfailed");
exit();
}



if ($stmt->rowCount() == 0) {
$stmt = null;
header("location: ../index.php?error=colaboradornotfound1");
exit();
}



$colab = $stmt->fetch();
return $colab;
$stmt = null;
}


}