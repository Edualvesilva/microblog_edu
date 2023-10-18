<?php
require_once "../vendor/autoload.php";

use Microblog\ControleDeAcesso;
$sessao = new ControleDeAcesso;
$sessao->verificaAcesso();

use Microblog\Categoria;
$categoria = new Categoria;
$categoria->setId($_SESSION["id"]);
$categoria->excluir();
header("location:categorias.php");
?>