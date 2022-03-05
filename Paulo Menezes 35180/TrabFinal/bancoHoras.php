<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco de Horas</title>

    <!--jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- BS5.1.1 CSS/JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="jquerypicker/jquery-ui.css" />

    <!-- Latest BS-Select compiled and minified CSS/JS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
    <script src="js/moment.js"></script>

<body>
    <?php
   

    include("classes/dbhClass.php");
    include("classes/colaboradorClass.php");
    $colab = new Colaborador;
    $colab = $colab->getAll();
    
    include("classes/lojaClass.php");

    $loja = new Loja;
    $lojas = $loja->getAll();
    ?>

    </div>
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
    <div class="container">


        <div class="row">
            <div class="col-8">
                <h3 id="msg"></h3>
                <form id="frm" name="frm" method="post">

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="idcolab">Nome
                                    Colaborador</label>
                            </div>

                            <select class="selectpicker" data-live-search="true" name="idcolab" id="idcolab" required>
                                <option disabled selected>Escolha...</option>
                                <?php foreach ($colab as $k=> $item) {
                            echo "

                            <option value='". $item['id'] ."' >
                                    ".$item['id'] ." " . $item['NomeColaborador'] . " </option>" ; } ?>

                            </select>

                            <button name="delAll" id="delAll" class="btn btn-danger" data-bs-toggle="tooltip"
                                data-bs-placement="right" title="Apagar todos os registos de banco de horas">
                                <i class="bi bi-trash"></i></button>
                            <button name="horastable" id="horastable" class="btn btn-outline-primary" data-bs-toggle="tooltip"
                                data-bs-placement="right" title="Ver todos os registos do colaborador">
                                <i class="bi bi-calendar"></i></button>
                                
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="txtidcolab">Horas</label>
                        <input type="time" name="horas" id="horas" class="form-control" required>

                    </div>

                    <div class="form-group">
                        <label for="txtdata">Data</label>
                        <input type="text" name="txtdata" id="txtdata" class="form-control" placeholder="yyyy-mm-dd"
                            required>

                    </div>



                    <div class="form-group p-4">
                        <button name="btadd" id="btadd" class="btn btn-primary" value="add" type="submit"><i
                                class="bi bi-plus-circle"></i>Adicionar horas</button>
                        <button name="bttake" id="bttake" class="btn btn-warning" value="take" type="submit"><i
                                class="bi bi-dash-circle"></i>Retirar horas</button>
                        <input name="btcancel" id="btcancel" class="btn btn-danger" type="button" value="Cancel">


                    </div>

                </form>
            </div>
            <div class="col-4">
                <div id="divtablehoras">
                    
                </div>
                
            </div>
        </div>




        <script src="jquerypicker/jquery-ui.js"></script>
        <script>
        $(function() {


            $(".dropdown-menu").click(function(evt) {
                $("#tablehoras").remove();
                $("#msg").html("")
                              
            })

            $("#txtdata").datepicker({
                todayBtn: "linked",
                language: "it",
                autoclose: true,
                todayHighlight: true,
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy/m/d'
            });

            $("#btcancel").click(function(evt) {
                evt = evt ? evt : window.event;
                window.location = document.referrer;
            });


            $("#btadd").click(function(evt) {
                evt = evt ? evt : window.event;
                evt.preventDefault();

                $("#tablehoras").remove();
                var frm = document.getElementById("frm");
                var formdata = new FormData(frm);
                for (var item of formdata) console.log(item);
                $.ajax({
                    url: 'insertBanco.php',
                    method: 'post',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    data: formdata,
                    success: function(dados) {
                        console.log(dados);
                        if (dados.msg == 1) {
                            $("#msg").css("color", "green")
                            $("#msg").html("Registo bem sucedido")
                        }
                    },
                    error: function() {

                    }
                });
            });

            $("#bttake").click(function(evt) {
                evt = evt ? evt : window.event;
                evt.preventDefault();
                $("#tablehoras").remove();
                var frm = document.getElementById("frm");
                var formdata = new FormData(frm);
                for (var item of formdata) console.log(item);
                $.ajax({
                    url: 'retirarBanco.php',
                    method: 'post',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    data: formdata,
                    success: function(dados) {
                        console.log(dados);
                        if (dados.msg == 1) {
                            $("#msg").css("color", "green")
                            $("#msg").html("Registo bem sucedido")
                        }
                    },
                    error: function() {
                        alert("error")
                    }
                });
            });

            $("#delAll").click(function(evt) {
                evt = evt ? evt : window.event;

                evt.preventDefault();
                var idcolab = $('#idcolab option:selected').val();
                console.log(idcolab)
                $("#tablehoras").remove();
                $.ajax({
                    url: "deleteBanco.php",
                    type: 'post',
                    dataType: 'json',
                    processData: true,
                    contentType: 'application/x-www-form-urlencoded',

                    data: {
                        idcolab: idcolab
                    },
                    success: function(dados) {
                        console.log(dados);

                        if (dados.msg == 22007) {
                            $("#msg").html(
                                "Selecione um colaborador"
                            );
                        } else {

                            if (dados.msg >= 1) {
                                $("#msg").css("color", "red")
                                $("#msg").html(
                                    "todos os registos do colaborador apagado");
                            }
                            else{
                                $("#msg").html(
                                "Sem registos de Horas"
                            );
                            }

                        }
                    },
                    error: function() {
                        alert("erro11");
                    }

                });
            });

            $("#horastable").click(function(evt) {
                evt = evt ? evt : window.event;

                evt.preventDefault();
                $("#msg").html("");
                var idcolab = $('#idcolab option:selected').val();
                console.log(idcolab)
                $("#tablehoras").remove();
                
                if(idcolab==="Escolha...")
                    $("#msg").html("Selecione um colaborador");
                         
                else
                $.ajax({
                    url: "SelectColabBanco.php",
                    type: 'post',
                    dataType: 'json',
                    processData: true,
                    contentType: 'application/x-www-form-urlencoded',

                    data: {
                        idcolab: idcolab
                        
                    },
                    success: function(dados) {
                        console.log(dados);
                        
                        if (dados.length > 0) {
                            
                            let table ="<table id='tablehoras' class=' table table-responsive table-striped table-bordered table-success'>"
                             table +="<thead><td>Horas</td><td>Data</td></thead>"
                            table +="<tbody id='tb'></tbody></table>"
                            
                            $('#divtablehoras').append(table)

                            $.each(dados, function(i, litem) {
                                var thedate = moment(litem.dataHoras).format('YYYY-MM-DD');
                                console.log(litem.dataHoras);

                                let linha=""

                                if(litem.adicionarRetirar === 1){
                                     linha = "<tr><td style='color:green'>" + litem.horas +"</td><td>"
                                }   
                                else if(litem.adicionarRetirar === 0){
                                    linha = "<tr><td style='color:red'>" + litem.horas +"</td><td>"
                                }
                                    linha+= thedate +"</tr>";
                                        
                                    
                                $("#tb").append(linha);
                                

                            });
                         
                        } else {

                            $("#msg").html(
                                "Sem registos de Horas"
                            );
                        }

                    },

                    error: function() {
                        alert("erro");

                    }

                });


            });



        });
        </script>
</body>

</html>