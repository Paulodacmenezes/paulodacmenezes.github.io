<?php

session_start();

include("classes/dbhClass.php");
include("classes/lojaClass.php");

$loja = new Loja;
$lojas = $loja->getAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Loja</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <script src="js/jquery-3.6.0.js"></script>
    <script src="jquerypicker/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

<body>
    <?php 
           try {
               include ("cnn.php");
               $sql="select  * from lojas where id=?;";
               $idloja = $_GET['idloja'];
               
               $stmt=$pdo->prepare($sql);
               $stmt->execute([$idloja]);
               $loja =$stmt->fetch();
            
               $sql="select * from colaboradores Where parentId=?;";
               $stmt=$pdo->prepare($sql);
               $stmt->execute([$idloja]);
               $total=$stmt->rowCount();
               $colaboradores=$stmt->fetchAll();
               
           } catch (PDOException $e) {
               echo $e->getMessage();
           }
        
        ?>
    <div class="row">



        <div class="col-12">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">
                        <img src="imgs/logo.svg" alt="" width="30" height="24">
                    </a>
                    <?php
            if (isset($_SESSION["admin"])) {
            ?>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">

                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Lojas
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="lojas.php">Ver Todas</a></li>
                                    <?php 
                                    
                                    
                            foreach ($lojas as $k => $item) {
                                echo "
                                <li><a class='dropdown-item' href='loja.php?idloja=" . $item['id'] ."'>" . $item['nomeLoja']. "</a></li>
            
                                "; };
                                ?>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                    href="colaboradores.php">Colaboradores</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="datatables.php">Vista geral</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="bancoHoras.php">Banco de Horas</a>
                            </li>
                        </ul>
                    </div>
                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item">

                            <a class="nav-link" href="" data-bs-target="#myModal" data-bs-toggle="modal"><?php echo $_SESSION["uid"];
                        ?></a>


                        </li>



                        <li class="nav-item">

                            <a class="btn btn-danger" href="includes/logoutInclude.php">Logout</a>

                        </li>
                        <?php 
                    }else{
                    
                    ?>

                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">

                                <a class="btn btn-dark" style="margin-right:5px" href="signup.html">Registar</a>

                            </li>
                            <li class="nav-item">

                                <a class="btn btn-success" href="login.html">Login</a>

                            </li>
                        </ul>
                        <?php
                    }
                ?>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <br>


    <br>
    <div class="container">

        <div class="row">
            <?php
                    if($total>0){
                 ?>
            <div class="col-md-4 col-sm-12">
                <h4>Colaboradores</h4>


                <table id="myTable" class=" table table-responsive table-striped table-bordered table-success">
                    <thead>
                        <td>Nome</td>
                        <td>Horas Contratuais</td>
                        <td>Saldo Banco de Horas</td>
                        <td>comandos</td>

                    </thead>
                    <tbody id="tb">
                        <?php
                        
                        function lnk($id)
                        {
                            return "<a href='colaborador.php?idcolab=" . $id . "' class='btn btn-primary' >Editar</a>";
                        }

                        
                        foreach ($colaboradores as $k => $item) {
                            echo "<tr>
                                
                                <td>" . $item['NomeColaborador'] . "</td>
                                <td>" . $item['HorasSemanais'] . "</td>
                                <td>" . $item['saldoHoras'] . "</td>
                                <td>" . lnk($item['id']) .   "</td>
                            </tr>";
                        }
                    

                        ?>
                    </tbody>

                </table>
            </div>
            <?php
                   }
                 ?>
            <div class="col-md-8 col-sm-12">

                <form id="frm" name="frm" method="post">
                    <div class="form-group">
                        <label for="idloja">ID loja</label>
                        <input type="text" name="txtidloja" id="txtidloja" class="form-control" readonly="readonly"
                            value="<?php 
                                  echo ($loja !=NULL)?$loja['id']:"";
                                ?>" placeholder="">

                    </div>
                    <div class="form-group">
                        <label for="txtnome">Nome</label>
                        <input type="text" id="txtnome" name="txtnome" value="<?php 
                                  echo ($loja !=NULL)?$loja['nomeLoja']:"";
                                ?>" class="form-control" />

                    </div>
                    <div class="form-group">
                        <label for="txtdatanasc">Localização</label>
                        <input type="text" name="txtlocalizacao" id="txtlocalizacao" value="<?php 
                                  echo ($loja !=NULL)?$loja['localizacao']:"";
                                ?>" class="form-control" placeholder="">

                    </div>

                    <div class="form-group p-4">
                        <input name="btsave" id="btsave" class="btn btn-primary" type="button" value="Save">
                        &nbsp;&nbsp;
                        <input name="btcancel" id="btcancel" class="btn btn-danger" type="button" value="Cancel">
                    </div>

                </form>
            </div>
        </div>

        <script src="js/jquery-3.6.0.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="jquerypicker/jquery-ui.js"></script>
        <script>
        $(function() {



            $("#btcancel").click(function(evt) {
                evt = evt ? evt : window.event;
                window.location = document.referrer;
            });

            $("#btsave").click(function(evt) {
                evt = evt ? evt : window.event;
                evt.preventDefault();
                var frm = document.getElementById("frm");
                var formdata = new FormData(frm);
                for (var item of formdata) console.log(item);
                $.ajax({
                    url: 'updateLoja.php',
                    method: 'post',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    data: formdata,
                    success: function(dados) {
                        console.log(dados);
                        window.location =
                            "lojas.php?msg=Registo Gravado com Sucesso";
                    },
                    error: function(err) {
                        alert(err);
                    }
                });
            });

        });
        </script>
</body>

</html>