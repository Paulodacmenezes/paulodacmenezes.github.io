<?php



class Loja  extends Dbh
{


public function getAll()
{

$sql = "SELECT * FROM lojas;";
$stmt = $this->connect()->prepare($sql);

if (!$stmt->execute()) {
$stmt = null;
header("location: ../index.php?error=stmtfailed1");
exit();
}



if ($stmt->rowCount() == 0) {
$stmt = null;
header("location: ../index.php?error=lojasnotfound");
exit();
}


if (!$stmt->execute()) {
$stmt = null;
header("location: ../index.php?error=stmtfailed");
exit();
}

$lojas = $stmt->fetchAll();
return $lojas;
$stmt = null;
}

public function getLoja($id)
{

$sql = "SELECT * FROM lojas WHERE id = ?;";
$stmt = $this->connect()->prepare($sql);

if (!$stmt->execute([$id])) {
$stmt = null;
header("location: ../index.php?error=stmtfailed1");
exit();
}



if ($stmt->rowCount() == 0) {
$stmt = null;
header("location: ../index.php?error=usernotfound1");
exit();
}


if (!$stmt->execute([$id])) {
$stmt = null;
header("location: ../index.php?error=stmtfailed2");
exit();
}

$loja = $stmt->fetchAll();
return $loja;
$stmt = null;
}


}