<?php

use Microblog\Usuario;

require_once "../inc/cabecalho-admin.php";
$usuario = new Usuario;
/* Atribuimos ao objeto o ID do usuário logado na sessão */
$usuario->setId($_SESSION["id"]);
$recebeUsuario = $usuario->listarUM();

if (isset($_POST["atualizar"])) {
	$usuario->setNome($_POST["nome"]);
	$usuario->setEmail($_POST["email"]);
	$usuario->setTipo($_SESSION["tipo"]); // Mantendo um tipo já existente

	if (empty($_POST["senha"])) {
		$usuario->setSenha($recebeUsuario["senha"]);
	} else {
		$usuario->setSenha($usuario->verificaSenha($_POST["senha"], $recebeUsuario["senha"]));
	}
	$usuario->atualizar();

	/* Atualizando a variável de sessão com o novo nome */
	$_SESSION["nome"] = $usuario->getNome();
	header("location:index.php?perfil_atualizado");
}
?>
<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">

		<h2 class="text-center">
			Atualizar meus dados
		</h2>

		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

			<div class="mb-3">
				<label class="form-label" for="nome">Nome:</label>
				<input class="form-control" type="text" id="nome" name="nome" value="<?= $recebeUsuario["nome"] ?>" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="email">E-mail:</label>
				<input class="form-control" type="email" id="email" name="email" value="<?= $recebeUsuario["email"] ?>" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="senha">Senha:</label>
				<input class="form-control" type="password" id="senha" name="senha" placeholder="Preencha apenas se for alterar">
			</div>

			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
		</form>

	</article>
</div>


<?php
require_once "../inc/rodape-admin.php";
?>