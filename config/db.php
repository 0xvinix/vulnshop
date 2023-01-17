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
$mysqli = new mysqli("localhost","root","root","vulnshop");

if ($mysqli -> connect_errno) {
  echo "[LOG] Erro ao conectar no MySQL :: " . $mysqli -> connect_error;
  exit();
}
?>
