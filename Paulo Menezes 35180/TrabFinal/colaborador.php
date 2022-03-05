<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Loja</title>


    <!--jquery-->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script src="js/jquery-3.6.0.js"></script>
    <!-- BS5.1.1 CSS/JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="jquerypicker/jquery-ui.css" />
    <script src="jquerypicker/jquery-ui.js"></script>
    <!-- Latest BS-Select compiled and minified CSS/JS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>



<body>

    <?php
    session_start();
     include ('cnn.php');
     
    if($_SERVER['REQUEST_METHOD'] === 'POST'  &&   isset($_POST['submit'])){
//echo"post";

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
              $destino = dirname(__DIR__) . "\\trabFinal\imgs\\" .$filename;
              //echo $destino;
              move_uploaded_file($_FILES['fich']['tmp_name'], $destino);
        
       
        $sql="update colaboradores set parentId= ?, NomeColaborador= ?,dataNasc= ?,HorasSemanais = ?, photo= ? where id=?;";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$idloja,$nomecolab,$datanasc,$horas,$filename,$idcolab] );
        $total = $stmt->rowCount();
        $msg=array("msg"=>$total);
        }
        else{
            $sql="update colaboradores set parentId= ?, NomeColaborador= ?,dataNasc= ?,HorasSemanais = ? where id=?;";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$idloja,$nomecolab,$datanasc,$horas,$idcolab] );
            $total = $stmt->rowCount();
            $msg=array("msg"=>$total);
        }
    }
  

  } catch (PDOException $e) {
      $msg= array("msg"=> $e->getMessage());
  }

    }
    else{
      //  echo 'get';
        $idcolab = $_GET['idcolab'];
    }
        
    
        $sql = "select  * from colaboradores where id=?;";
        

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idcolab]);
        $colab = $stmt->fetch();
   
    include("classes/dbhClass.php");
    include("classes/lojaClass.php");
    $loja = new Loja;
    $lojas = $loja->getAll();
    
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

        <div class="col-8">


            <form action="colaborador.php" id=" frm" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="txtidcolab">id Colaborador</label>
                    <input type="text" name="txtidcolab" id="txtidcolab" class="form-control" readonly="readonly" value="<?php
                                echo ($colab != NULL) ? $colab['id'] : "";
                                ?>" placeholder="">

                </div>

                <div class="form-group">
                    <label for="txtnome">Nome</label>
                    <input type="text" id="txtnome" name="txtnome" value="<?php
                         echo ($colab != NULL) ? $colab['NomeColaborador'] : "";
                        ?>" class="form-control" />

                </div>
                <div class="form-group">
                    <label for="txtdatanasc">DataNasc</label>
                    <input type="text" name="txtdatanasc" id="txtdatanasc" value="<?php
                            echo ($colab != NULL) ? $colab['dataNasc'] : "";
                        ?>" class="form-control" placeholder="" required>

                </div>
                <div class="form-group">
                    <label for="txthorascont">Horas Contratuais</label>
                    <input required type="number" name="horas" min="10" max="40" id="txthorascont" value="<?php
                            echo ($colab != NULL) ? $colab['HorasSemanais'] : "";
                        ?>" class="form-control" placeholder="" required>

                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Loja</label>
                        </div>

                        <select class="selectpicker" data-live-search="true" required name="parentId"
                            id="inputGroupSelect01">
                            <option disabled selected>Escolha...</option>
                            <?php foreach ($lojas as $k=> $item) {
                            echo "

                            <option value='". $item['id'] ."' >
                                    " . $item['nomeLoja'] . " </option>" ; } ?>

                        </select>
                    </div>

                </div>
                <div class="form-group">
                    <img src="<?php
                    
                                if(isset($colab['photo'])){
                                       echo   "imgs/" . $colab['photo'] . "" ;
                                }else{
                                     echo   "imgs/nophoto.jpg";
                                }
                            
                                ?>" alt="" class="" style="width: 300px;display: block;">
                </div>


                <div lass="form-group">
                    <label for="fich">Escolher Foto:</label>
                    <input type="file" class="form-control-file" name="fich" id="fich" placeholder="" value="Clicar">

                </div>

                <div class="form-group p-4">
                    <button name="submit" id="btsave" class="btn btn-primary" value="Save" type="submit">Gravar</button>
                    <!-- <input name="btsave" id="btsave" class="btn btn-primary" type="button" value="Save">
                    &nbsp;&nbsp; -->
                    <input name="btcancel" id="btcancel" class="btn btn-danger" type="button" value="Cancel">
                </div>

            </form>
        </div>
    </div>



    <script>
    $(function() {

        $("#txtdatanasc").datepicker({
            beforeShow: function() {
                setTimeout(function() {
                    $('.ui-datepicker').css('z-index', 99999999999999);
                }, 0);
            },
            todayBtn: "linked",
            language: "it",
            autoclose: true,
            todayHighlight: true,
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy/m/d',
            yearRange: "-110:+0"
        });

        $("#btcancel").click(function(evt) {
            evt = evt ? evt : window.event;
            window.location = document.referrer;
        });


        // $("#frm").submit(function(e) {

        //     // evt = evt ? evt : window.event;
        //     e.preventDefault();
        //     var frm = document.getElementById("frm");
        //     var formdata = new FormData(frm);
        //     for (var item of formdata) console.log(item);
        //     $.ajax({
        //         url: 'updateColab.php',
        //         method: 'post',
        //         dataType: 'json',
        //         processData: false,
        //         contentType: false,
        //         data: formdata,

        //         success: function(dados) {
        //             console.log(dados);
        //             window.location =
        //                 "colaboradores.php?msg=Registo Gravado com Sucesso";
        //         },
        //         error: function(err) {
        //             alert("err");
        //         }
        //     });

        // });


        // $("#btsave").click(function(evt) {
        //     evt = evt ? evt : window.event;
        //     evt.preventDefault();
        //     var frm = document.getElementById("frm");
        //     var formdata = new FormData(frm);
        //     for (var item of formdata) console.log(item);
        //     $.ajax({
        //         url: 'updateColab.php',
        //         method: 'post',
        //         dataType: 'json',
        //         processData: false,
        //         contentType: false,
        //         data: formdata,
        //         success: function(dados) {
        //             console.log(dados);
        //             // window.location =
        //             //     "colaboradores.php?msg=Registo Gravado com Sucesso";
        //         },
        //         error: function(err) {
        //             alert(err);
        //         }
        //     });
        // });


    });
    $("#inputGroupSelect01 ").val(
        <?php
            echo ($colab != NULL) ? $colab['parentId'] : 1;
            ?>);
    </script>
</body>

</html>