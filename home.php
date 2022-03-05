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
      <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Lojas
      </a>
      <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <li><a class="dropdown-item" href="#">Action</a></li>
        <li><a class="dropdown-item" href="#">Another action</a></li>
        <li><a class="dropdown-item" href="#">Something else here</a></li>
      </ul>
    </li>
  
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="colaboradores.php">Colaboradores</a>
  </li>
  <?php
      if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {
  ?>
  <li class="nav-item">
    <a class="nav-link" href="#">Editar lojas</a>
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