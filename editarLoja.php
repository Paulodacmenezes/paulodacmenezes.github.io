<?php

session_start();

if(isset($_REQUEST['submit'])){
    echo "<pre>";
        print_r($_REQUEST);
    echo "<pre>";    
    
}

    
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <div class="row">



        <div class="col-12">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Navbar</a>
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
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                    href="colaboradores.php">Colaboradores</a>
                            </li>
                            <?php
    if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {
?>
                            <li class="nav-item">
                                <a class="nav-link" href="editarLoja.php">Editar lojas</a>
                            </li>
                            <?php 
    }
                    
?>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Pricing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled">Disabled</a>
                            </li>
                        </ul>
                    </div>
                    <ul class="navbar-nav ms-auto">
                        <?php
                        if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {
                    ?>
                        <li class="nav-item">

                            <a class="nav-link" href="" data-bs-target="#myModal" data-bs-toggle="modal"><?php echo $_SESSION["uid"];
                        ?></a>


                        </li>

                        <li class="nav-item">

                            <a class="nav-link" href="signup.html">Registar</a>

                        </li>

                        <li class="nav-item">

                            <a class="btn btn-danger" href="includes/logoutInclude.php">Logout</a>

                        </li>
                        <?php 
                    }elseif(isset($_SESSION["uid"])){
                    
                    ?>
                        <li class="nav-item">

                            <a class="btn btn-danger" href="includes/logoutInclude.php">Logout</a>

                        </li>

                        <?php 
                    }
                    if(!isset($_SESSION["uid"])){
                    
                    ?>
                        <li class="nav-item">

                            <a class="btn btn-success" href="login.html">Login</a>

                        </li>
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
            <h3>Tabela Lojas</h3>

            <table class=" table table-responsive table-striped table-bordered table-success">
                <thead>
                    <td>Nome</td>
                    <td>Localização</td>
                    <td colspan="2">comandos</td>

                </thead>
                <tbody id="tb">
                    <?php
                            function del($id){
                                return "<a name='del' data-idloja='".$id."' class ='btn btn-danger' id='".$id."'>Del</a>";
                            }
                            function lnk($id){
                                return "<a href='loja.php?idloja=".$id."' class='btn btn-primary' >Editar</a>";
                            }

                            include("classes/dbhClass.php");
                            include("classes/lojaClass.php");
                            $loja = new Loja;
                            $lojaV=$loja->getAll();
                            //error handler and user signin
                            
                            foreach($lojaV as $k =>$item){
                                echo "<tr>
                                
                                <td>".$item ['nomeLoja']."</td>
                                <td>".$item ['localizacao']."</td>
                                <td>".lnk($item['id'])."</td>
                                <td>".del($item['id'])."</td>
                                </tr>";

                            }

                            
                            ?>
                </tbody>

            </table>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Adicionar Loja
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Inserir Cliente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="#" method="post" enctype="application/x-www-form-urlencoded" id="frm">
                                <div class="form-group">
                                    <label for="txtnome">Nome</label>
                                    <input type="text" name="txtnome" id="txtnome" class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="txtdatanasc">Data de Nascimento</label>
                                    <input type="text" name="txtdatanasc" id="txtdatanasc" class="form-control"
                                        placeholder="yyyy/mm/dd">
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
    function init() {
        $("[name='del']").click(function(evt) {
            evt = evt ? evt : window.event;
            alert($(evt.target).data('idloja'));

            $(evt.target).css({
                "background-color": "blue"

            });
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
                        $("#msg").html("apagou");
                    }
                    if (dados.msg == 23000) {
                        $("#msg").html("Cliente não pode ser apagado porque tem alugueres");
                    }
                },
                error: function() {
                    alert("erro");
                }

            });


        });

    }

    function del($id) {
        return "<a name='del' data-idloja='" + $id + "' class ='btn btn-danger' id='" + $id + "'>Del</a>";
    }
    $(function() {
        $.ajax({
            url: "treeview.php",
            method: 'GET',
            dataType: 'json',
            success: function(dados) {
                $("#tree").treeview({
                    levels: 2,
                    data: dados,
                    enableLinks: true
                });
            },
            error: function() {}
        });


        // $("#txtdatanasc").datepicker({
        //     todayBtn: "linked",
        //     language: "it",
        //     autoclose: true,
        //     todayHighlight: true,
        //     changeMonth: true,
        //     changeYear: true,
        //     dateFormat: 'yy/m/d'
        // });


        init();
        $("#btinsert").click(function(evt) {
            evt = evt ? evt : window.event;
            evt.preventDefault();
            //alert(evt.target.id);
            var frm = document.getElementById("frm");
            var formdata = new FormData(frm);
            for (var item of formdata) console.log(item);
            $.ajax({
                url: 'inserirCliente.php',
                method: 'post',
                dataType: 'json',
                processData: false,
                contentType: false,
                data: formdata,
                success: function(dados) {
                    console.log(dados);
                    if (dados.msg == 1) {
                        let linha = "<tr><td>" + dados.idcli + "</td><td>" + dados
                            .nome + "</td><td>" + dados.datanasc + "</td><td>" + dados
                            .idade + "</td><td>" + del(dados.idcli) + "</td></tr>";
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


    });
    </script>
</body>

</html>