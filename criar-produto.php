<!--

____   ____    .__                .__                   
\   \ /   /_ __|  |   ____   _____|  |__   ____ ______  
 \   Y   /  |  \  |  /    \ /  ___/  |  \ /  _ \\____ \ 
  \     /|  |  /  |_|   |  \\___ \|   Y  (  <_> )  |_> >
   \___/ |____/|____/___|  /____  >___|  /\____/|   __/ 
                         \/     \/     \/       |__|    

https://www.youtube.com/watch?v=P7gBAWzcBGI

-->

<?php
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
    header("location: login.php");
    exit;
}
?>
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
      <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
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

    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  <div class="form-group">
    <label for="exampleInputEmail1">Nome do produto</label>
    <input name="titulo" type="titulo" class="form-control" id="titulo" aria-describedby="titulo" placeholder="Carro completo">
    <small id="titulo" class="form-text text-muted">Adicione também a condição do produto em novo ou usado.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Preço</label>
    <input name="preco" type="text" class="form-control" id="preco" placeholder="5,000">
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Descreva o produto</label>
    <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Criar Produto</button>
</form>

<?php
require_once "config/db.php";
if($_SERVER['REQUEST_METHOD'] === 'POST'){
$query = "INSERT INTO produtos (vendedor, titulo, descricao, imagem, preco) VALUES ('".$_SESSION["username"]."', '".$_POST["titulo"]."', '".$_POST["descricao"]."', 'https://www.salonlfc.com/wp-content/uploads/2018/01/image-not-found-1-scaled-1150x647.png', '".$_POST["preco"]."')";
if (mysqli_query($mysqli,$query)) {
    header("location: index.php");
} else {
    printf('erro.');
    echo mysqli_error($mysqli);
}
}
?>

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
