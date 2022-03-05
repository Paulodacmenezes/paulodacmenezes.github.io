<?php

session_start();
include("classes/dbhClass.php");
include("classes/colaboradorClass.php");
include("classes/lojaClass.php");

$loja = new Loja;
$lojas = $loja->getAll();

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script src="js/jquery-3.6.0.js"></script>
<script src="js/bootstrap.js"></script>
<script src="jquerypicker/jquery-ui.js"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css
        ">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css
        ">
<link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/1.4.0/css/searchPanes.bootstrap5.min.css
        ">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.4/css/select.bootstrap5.min.css
        ">


<script src="js/jquery-3.6.0.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/searchpanes/1.4.0/js/dataTables.searchPanes.min.js"></script>
<script src="https://cdn.datatables.net/searchpanes/1.4.0/js/searchPanes.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>
<script src=""></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>


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
                            <a class="nav-link active" aria-current="page" href="colaboradores.php">Colaboradores</a>
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

<body>

    <table id="geral" class="table table-striped nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Loja</th>
                <th>Nome</th>
                <th>Idade</th>
                <th>Contrato</th>
                <th>Banco Horas</th>
                <th>Saldo Horas</th>
            </tr>
        </thead>

    </table>


</body>
<script>
$(document).ready(function() {


    var table = $('#geral').DataTable({


        "ajax": 'getDatatables.php',


        "columns": [

            // {
            //      "data": "nomeLoja"
            // },

            {
                data: null,
                render: function(data, type, row) {
                    // Combine the first and last names into a single table field
                    return "<a href='loja.php?idloja=" + data.parentId +
                        "' style='text-decoration:none'>" + data.nomeLoja + "</a> ";

                }
            },

            // {
            //     "data": "NomeColaborador"
            // },
            {
                data: null,
                render: function(data, type, row) {

                    return "<a href='colaborador.php?idcolab=" + data.id +
                        "' style='text-decoration:none'>" + data.NomeColaborador + "</a> ";

                }
            },
            // {
            //     "data": "dataNasc"
            // },
            {
                data: null,
                render: function(data, type, row) {
                    var dob = new Date(data.dataNasc);
                    var month_diff = Date.now() - dob.getTime();
                    var age_dt = new Date(month_diff);
                    var year = age_dt.getUTCFullYear();
                    var age = Math.abs(year - 1970);
                    return age;
                }
            },

            {
                data: null,
                render: function(data, type, row) {
                    // 
                    if (data.HorasSemanais == 40)
                        return "Full-Time"
                    else
                        return "Part-time"

                }
            },
            {
                "data": "saldoHoras"
            },


            {
                data: null,
                render: function(data, type, row) {

                    if (data.saldoHoras.indexOf('-') != -1)
                        return "<p style='color:red'>Deve horas</p>"
                    else {
                        if (data.saldoHoras == "00:00:00")
                            return "Sem horas"
                    }
                    if (data.saldoHoras.indexOf('-') == -1)
                        return "<p style='color:green'>Horas em Banco</p>"
                }
            },
        ],
        searchPanes: {
            dtOpts: {
                select: {
                    style: 'multi'
                },
                // dom:'tp',
            },
            "viewTotal": true,
            cascadePanes: true,

        },


        columnDefs: [

            {


            },

            {
                searchPanes: {
                    controls: false,
                    show: true
                },
                targets: [3, 5]
            },

            {
                searchPanes: {
                    show: true

                },
                targets: [0, 2, 5]
            },
            {
                searchPanes: {
                    show: false

                },
                targets: [4]
            },


        ],


        "language": {
            searchPanes: {
                title: {
                    _: 'Filtros Selecionados - %d',
                    0: 'Sem filtros Selecionados',
                    1: 'Um Filtro Selecionado'

                },
                clearMessage: "Remover filtros",
                showMessage: "Mostrar todos",
                collapseMessage: "Esconder todos",
                emptyPanes: 'Sem dados'

            },
            "sEmptyTable": "Nenhum registro encontrado",
            "sProcessing": "A processar...",
            "sLengthMenu": "Mostrar _MENU_ registos",
            "sZeroRecords": "Não foram encontrados resultados",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registos",
            "sInfoEmpty": "Mostrando de 0 até 0 de 0 registos",
            "sInfoFiltered": "(filtrado de _MAX_ registos no total)",
            "sInfoPostFix": "",
            "sSearch": "Procurar:",
            "sUrl": "",
            "oPaginate": {

                "sFirst": "Primeiro",
                "sPrevious": "Anterior",
                "sNext": "Seguinte",
                "sLast": "Último"

            },
            "oAria": {

                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"

            }
        },
        dom: 'Pfrtip'
    });

    table.searchPanes.container().prependTo(table.table().container());
    table.searchPanes.resizePanes();
});
</script>

</html>