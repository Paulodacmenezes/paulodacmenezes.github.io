<?php

session_start();
include("classes/dbhClass.php");
include("classes/colaboradorClass.php");
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
    <title>Lojas</title>

    <!--jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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

</head>

<body>
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


    <div class="row d-flex justify-content-center">

        <div class="col-9">
            <h3>Colaboradores</h3>
            <h4 id="msg" style="color:red"></h4>
            <input class="form-control" id="myInput" type="text" placeholder="Procurar..">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#colabModal">
                Adicionar Colaborador
            </button>

            <table id="myTable" class=" table table-responsive table-striped table-bordered table-success">
                <thead>
                    <td>Foto</td>
                    <td>Nome</td>
                    <td>Idade</td>
                    <td>Horas Contratuais</td>
                    <td>Banco de Horas</td>
                    <td>Loja</td>
                    <td colspan="2">comandos</td>

                </thead>
                <tbody id="tb">
                    <?php
                    function del($id)
                    {
                        return "<a name='del' data-idcolab='" . $id . "' class ='btn btn-danger' id='" . $id . "'>Del</a>";
                    }
                    function lnk($id)
                    {
                        return "<a href='colaborador.php?idcolab=$id' class='btn btn-primary' >Editar</a>";
                    }

                   
       
                    $colab = new Colaborador;
                    $colabs = $colab->getColabsLoja();

                   
                    

                    foreach ($colabs as $k => $item) {

                        
                       
                        $dateOfBirth = $item['dataNasc'];
                        $today = date("Y-m-d");
                        $diff = date_diff(date_create($dateOfBirth), date_create($today));
                        
                        echo "<tr> <td> <img src='";
                        
                        if(isset($item['photo'])){
                            
                            echo   "imgs/". $item['photo'] ."'";
                        }else{
                             echo  "imgs/nophoto.jpg'";
                        }
                    
                       echo " alt='' class='' style='width: 100px;display: block;'> </td> ";

                    echo "

                        <td>" . $item['NomeColaborador'] . "</td>
                        <td>" . $diff->format('%y') . "</td>
                        <td>" . $item['HorasSemanais'] . "</td>
                        <td class='saldo'>" . $item['saldoHoras'] . "</td>
                        <td>" .$item['nomeLoja']. "</td>
                        <td>" . lnk($item['id']) . " " . del($item['id']) . "</td>

                    </tr>";
                    }

                    ?>
                </tbody>

            </table>


            <!-- Modal -->
            <div class="modal fade" id="colabModal" tabindex="-1" aria-labelledby="colabModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="colabModalLabel">Inserir Colaborador</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="#" method="post" enctype="application/x-www-form-urlencoded" id="frm">
                                <div class="form-group">
                                    <input required type="text" name="txtnome" id="txtnome" class="form-control"
                                        placeholder="Nome Colaborador">
                                </div>
                                <div class="form-group">
                                    <label for="txtdatanasc">Data de Nascimento</label>
                                    <input required type="text" name="txtdatanasc" id="txtdatanasc" class="form-control"
                                        placeholder="yyyy/mm/dd">
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">Loja</label>
                                        </div>

                                        <select class="selectpicker" data-live-search="true" required name="parentId"
                                            id="inputGroupSelect01">
                                            <option disabled>Escolha...</option>
                                            <?php 
                                            
                                            
                                            foreach ($lojas as $k => $item) {
                                                echo "

                                            <option value='" . $item['id'] . "' >
                                            " . $item['nomeLoja'] . " </option>";
                                            } ?>

                                        </select>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <input required type="number" min="10" max="40" name="txthorascont"
                                        id="txthorascont" class="form-control" placeholder="Horas Contratuais">
                                </div>


                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            <button name="btinsert" id="btinsert" class="btn btn-primary" type="submit">Insert</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    function calcIdade($dbo) {

        var dob = new Date($dbo);
        var month_diff = Date.now() - dob.getTime();
        var age_dt = new Date(month_diff);
        var year = age_dt.getUTCFullYear();
        var age = Math.abs(year - 1970);
        return age;
    }

    function init() {


        function lnk($id) {

            return "<a href='colaborador.php?idcolab=" + $id + "' class='btn btn-primary'>Editar</a>";
        }

        $(function() {
            $("[name='del']").click(function(evt) {
                evt = evt ? evt : window.event;

                console.log(evt.target.id)
                $.ajax({
                    url: "deleteColab.php",
                    type: 'post',
                    dataType: 'json',
                    processData: true,
                    contentType: 'application/x-www-form-urlencoded',

                    data: {
                        idcolab: evt.target.id
                    },
                    success: function(dados) {
                        console.log(dados);
                        if (dados.msg == 1) {
                            $(evt.target).closest("tr").remove();
                            $("#msg").html("Colaborador apagado");
                        }
                        if (dados.msg == 23000) {
                            $("#msg").html(
                                "colaborador nao pode ser apagado pois tem registos em Banco de horas"
                            );
                        }
                    },
                    error: function() {
                        alert("erro1");
                    }

                });


            });

        })

        function del($id) {
            return "<a name='del' data-idcolab='" + $id + "' class ='btn btn-danger' id='" + $id + "'>Del</a>";
        }
    }

    $("#txtdatanasc").datepicker({
        todayBtn: "linked",
        language: "it",
        autoclose: true,
        todayHighlight: true,
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy/m/d',
        yearRange: "-110:+0"

    });

    function del($id) {
        return "<a name='del' data-idcolab='" + $id + "' class ='btn btn-danger' id='" + $id + "'>Del</a>";
    }

    function lnk($id) {

        return "<a href='colaborador.php?idcolab=" + $id + "' class='btn btn-primary'>Editar</a>";
    }

    init();

    $("#frm").submit(function(e) {

        e.preventDefault();
        var frm = document.getElementById("frm");
        var formdata = new FormData(frm);
        for (var item of formdata)
            console.log(item);


        $.ajax({
            url: 'inserirColab.php',
            method: 'post',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: formdata,
            success: function(dados) {
                console.log(dados);
                if (dados.msg == 1) {


                    let linha =
                        "<tr><td><img src='imgs/nophoto.jpg' alt='' class='' style='width: 100px;display: block;'></td><td>" +
                        dados.nomecolab + "</td><td>" + calcIdade(dados
                            .dataNasc) +
                        "</td><td>" + dados.horascont + "</td><td>" + dados.saldoHoras +
                        "</td><td>" + dados.nomeLoja + "</td><td>" + lnk(dados.idcolab) + " " + del(
                            dados.idcolab) + "</td></tr>";
                    $("#tb").append(linha);

                    init();

                    $("#colabModal").modal("hide");
                }
            },
            error: function(err) {
                alert(err);
            }
        });
    });
    </script>
</body>

</html>
</body>

</html>