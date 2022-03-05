<?php

session_start();

include("classes/dbhClass.php");
include("classes/lojaClass.php");

$loja = new Loja;
$lojas = $loja->getAll();
?>

<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>



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
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="imgs/glood Areeiro.png" class="d-block w-600" alt="...">

                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="imgs/Oeiras.jpg" class="d-block w-100" alt="...">

                </div>
                <div class="carousel-item">
                    <img src="imgs/Telheiras.png" class="d-block w-100" alt="...">

                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</body>

</html>