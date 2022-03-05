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
    <title>Lojas</title>
    <link rel="stylesheet" <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="js/jquery-3.6.0.js"></script>
    <script src="jquerypicker/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

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


    <div class="row d-flex justify-content-center">

        <div class="col-9">
            <h3>Lojas</h3>
            <h4 id="msg" style="color:red"></h4>
            <input class="form-control" id="myInput" type="text" placeholder="Procurar..">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Adicionar Loja
            </button>

            <table id="myTable" class=" table table-responsive table-striped table-bordered table-success">
                <thead>
                    <td>Nome</td>
                    <td>Localização</td>
                    <td colspan="2">comandos</td>

                </thead>
                <tbody id="tb">
                    <?php
                        function del($id)
                        {
                            return "<a name='del' data-idloja='" . $id . "' class ='btn btn-danger' id='" . $id . "'>Del</a>";
                        }
                        function lnk($id)
                        {
                            return "<a href='loja.php?idloja=" . $id . "' class='btn btn-primary' >Editar</a>";
                        }

                        
                        

                        foreach ($lojas as $k => $item) {
                            echo "<tr>
                                
                                <td>" . $item['nomeLoja'] . "</td>
                                <td>" . $item['localizacao'] . "</td>
                                <td>" . lnk($item['id']) .   " ". del($item['id']) . "</td>
                            </tr>";
                        }


                        ?>
                </tbody>

            </table>


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Inserir Loja</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="#" method="post" enctype="application/x-www-form-urlencoded" id="frm">
                                <div class="form-group">
                                    <input type="text" name="txtnome" id="txtnome" class="form-control"
                                        placeholder="Nome da Loja">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="txtlocalizacao" id="txtlocalizacao" class="form-control"
                                        placeholder="localização">
                                </div>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="btinsert" type="button" class="btn btn-primary">Insert</button>
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

    function init() {
        $(function() {
            $("[name='del']").click(function(evt) {
                evt = evt ? evt : window.event;
                // alert($(evt.target).data('idloja'));

                $.ajax({
                    url: "deleteLoja.php",
                    type: 'post',
                    dataType: 'json',
                    processData: true,
                    contentType: 'application/x-www-form-urlencoded',

                    data: {
                        idloja: evt.target.id
                    },
                    success: function(dados) {
                        console.log(dados);
                        if (dados.msg == 1) {
                            $(evt.target).closest("tr").remove();
                            $("#msg").html("loja apagada");
                        }
                        if (dados.msg == 23000) {
                            $("#msg").html("A loja tem colaboradores associados");
                        }
                    },
                    error: function() {
                        alert("erro11");
                    }

                });


            });

        })
    }

    function del($id) {
        return "<a name='del' data-idloja='" + $id + "' class ='btn btn-danger' id='" + $id + "'>Del</a>";
    }
    init();

    function lnk($id) {
        return "<a href='loja.php?idloja=" + $id + "' class='btn btn-primary'>Editar</a>";
    }

    $("#btinsert").click(function(evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();
        // alert(evt.target.id);
        var frm = document.getElementById("frm");
        var formdata = new FormData(frm);
        for (var item of formdata)
            console.log(item);

        $.ajax({
            url: 'inserirLoja.php',
            method: 'post',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: formdata,
            success: function(dados) {
                console.log(dados);
                if (dados.msg == 1) {
                    let linha = "<tr><td>" + dados.nomeloja + "</td><td>" + dados.localizacao +
                        "</td><td>" + lnk(dados.idloja) + " " + del(dados.idloja) + "</td></tr>";
                    $("#tb").append(linha);
                    init();
                    $("#exampleModal").modal("hide");
                }
            },
            error: function(err) {
                alert(err);
            }
        });
    });
    </script>
</body>
</body>

</html>