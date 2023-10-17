<?php
use Microblog\ControleDeAcesso;
require_once "../vendor/autoload.php";

$sessao = new ControleDeAcesso;
$sessao->verificaAcesso();

use Microblog\Usuario;
$usuario = new Usuario;
$usuario->setId($_GET["id"]);
$usuario->excluir();
header("location:usuarios.php");

?>