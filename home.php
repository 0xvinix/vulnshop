<!--

____   ____    .__                .__                   
\   \ /   /_ __|  |   ____   _____|  |__   ____ ______  
 \   Y   /  |  \  |  /    \ /  ___/  |  \ /  _ \\____ \ 
  \     /|  |  /  |_|   |  \\___ \|   Y  (  <_> )  |_> >
   \___/ |____/|____/___|  /____  >___|  /\____/|   __/ 
                         \/     \/     \/       |__|    

https://www.youtube.com/watch?v=P7gBAWzcBGI

-->

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vulnshop - Compre e anuncie seus produtos</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🛒</text></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
  <div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <a href="/home.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        🛒 Vulnshop
      </a>
      <div class="col-md-3 text-end" style="top: 10px;">
      <?php
      session_start();
      if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        printf('<a href="login.php" class="btn btn-primary">Meu Perfil</a>');
        printf('<a href="sair.php" class="btn btn-primary">Sair</a>');
      }else{
          printf('<a href="login.php" class="btn btn-primary">Entrar</a>');
          printf('<a href="registro.php" class="btn btn-primary">Registro</a>');
          printf('<a href="sair.php" class="btn btn-primary">Sair</a>');
        }
        
    ?>
      </div>
    </header>
  </div>
  <div class="container">
    <h3>
        Busque Produtos<br>
    <small class="text-muted">Temos certeza que encontrará o que busca.</small>
    </h3>
    <br>
    <center>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>">
        <input type="text" class="form-control" name="busca" placeholder="Digite o que procura aqui">
        <br>
        <button type="submit" class="btn btn-primary mb-2">Buscar</button>
        </form>
        <?php
        if(isset($_GET['busca'])){

            echo "Exibindo resultados para ".$_GET['busca'];

        }
        ?>
   </div>
   <center>
    <br><br>
    <div class="container">
    <?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    require_once "config/db.php";
    $query = "SELECT * FROM produtos ORDER BY ID DESC";
    $result = $mysqli->query($query);
    while ($row = $result->fetch_row()) {
        printf('<div class="card" style="width:400px">');
        printf('<img class="card-img-top" src="'.$row[4].'" alt="Produto">');
        printf('<div class="card-body">');
        printf('<h4 class="card-title">'.$row[2].'</h4>');
        printf('<p class="card-text">'.$row[3].'</p>');
        printf('<a href="produto.php?id='.$row[0].'" class="btn btn-primary">Conferir</a>');
        printf('</div>');
        printf('</div>');
        printf('<br>');
    }
    ?>
  <br>
</div>
<br><br>
<footer class="container py-5">
  <div class="row">
    <div class="col-12 col-md">
 
      <small class="d-block mb-3 text-muted">&copy; 2022 - Vulnshop</small>
    </div>
    <div class="col-6 col-md">
      <h5>Links</h5>
      <ul class="list-unstyled text-small">
        <li><a class="text-muted" href="#">Login</a></li>
        <li><a class="text-muted" href="#">Registro</a></li>
      </ul>
    </div>
    <div class="col-6 col-md">
      <h5>Blog</h5>
      <ul class="list-unstyled text-small">
        <li><a class="text-muted" href="#">Como comprar</a></li>
        <li><a class="text-muted" href="#">Vendendo na Internet</a></li>
        <li><a class="text-muted" href="#">Melhores marketplaces</a></li>
      </ul>
    </div>
    <div class="col-6 col-md">
      <h5>Social</h5>
      <ul class="list-unstyled text-small">
        <li><a class="text-muted" href="#">Instagram</a></li>
        <li><a class="text-muted" href="#">Facebook</a></li>
        <li><a class="text-muted" href="#">YouTube</a></li>
        <li><a class="text-muted" href="#">Tiktok</a></li>
      </ul>
    </div>
    <div class="col-6 col-md">
      <h5>Sobre</h5>
      <ul class="list-unstyled text-small">
        <li><a class="text-muted" href="#">Equipe</a></li>
        <li><a class="text-muted" href="#">Sobre nós</a></li>
        <li><a class="text-muted" href="#">Trabalhe conosco</a></li>
        <li><a class="text-muted" href="#">Anuncie</a></li>
      </ul>
    </div>
  </div>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>