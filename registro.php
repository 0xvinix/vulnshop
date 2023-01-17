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

require_once "config/db.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Digite um usuário.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "O usuário só pode conter letras e números.";
    } else{

        $sql = "SELECT id FROM usuarios WHERE usuario = ?";
        
        if($stmt = mysqli_prepare($mysqli, $sql)){

            mysqli_stmt_bind_param($stmt, "s", $param_username);
            

            $param_username = trim($_POST["username"]);
            

            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Usuario existente.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Erro interno, tente novamente.";
            }


            mysqli_stmt_close($stmt);
        }
    }
    

    if(empty(trim($_POST["password"]))){
        $password_err = "Digite uma senha.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "A senha precisa ter mais de 6 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }
    

    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Confrme a senha.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "As senhas não são iguais.";
        }
    }
    
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        $sql = "INSERT INTO usuarios (usuario, senha) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($mysqli, $sql)){

            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            
            if(mysqli_stmt_execute($stmt)){

                header("location: login.php");
            } else{
                echo "Erro, tente novamente.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    
    mysqli_close($mysqli);
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
      <a href="/home.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        🛒 Vulnshop - Registro
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
<body>
    <div class="wrapper">
        <h2>Registro</h2>
        <p>Preencha os campos abaixo para criar uma conta.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Usuário</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirme a senha</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Registrar">
                <input type="reset" class="btn btn-secondary ml-2" value="Resetar">
            </div>
            <p>Já tem uma conta? <a href="login.php">Login</a>.</p>
        </form>
    </div>    
</body>
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