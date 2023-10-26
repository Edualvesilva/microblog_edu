<?php
require_once "../vendor/autoload.php";
use Microblog\ControleDeAcesso;
$sessao = new ControleDeAcesso;
$sessao->verificaAcesso();

use Microblog\Noticia;
$noticia = new Noticia;
$noticia->setId($_GET["id"]);
$noticia->usuario->setId($_SESSION["id"]);
$noticia->usuario->setTipo($_SESSION["tipo"]);
$noticia->excluir();
header("location:noticias.php");
?>