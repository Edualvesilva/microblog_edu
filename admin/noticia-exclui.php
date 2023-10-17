<?php
require_once "../vendor/autoload.php";
use Microblog\ControleDeAcesso;
$sessao = new ControleDeAcesso;
$sessao->verificaAcesso();
?>