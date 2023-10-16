<?php
require_once "../inc/cabecalho-admin.php";

use Microblog\Usuario;

$usuario = new Usuario;
$usuario->setId($_GET["id"]);


$recebeUsuario = $usuario->listarUM();
if (isset($_POST["atualizar"])) {
	$usuario->setNome($_POST["nome"]);
	$usuario->setEmail($_POST["email"]);
	$usuario->setSenha($_POST["senha"]);
	$usuario->setTipo($_POST["tipo"]);
	header("location:usuarios.php");
}
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">

		<h2 class="text-center">
			Atualizar dados do usuário
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
				<input class="form-control" type="password" id="senha" name="senha" value="<?= $recebeUsuario["senha"] ?>" placeholder="Preencha apenas se for alterar">
			</div>

			<div class="mb-3">
				<label class="form-label" for="tipo">Tipo:</label>
				<select class="form-select" name="tipo" id="tipo" required>

					<option value=""></option>
					<option value="editor" <?php if ($recebeUsuario["tipo"] == "editor") echo "selected"; ?>>Editor</option>
					<option value="admin" <?php if ($recebeUsuario["tipo"] == "admin") echo "selected"; ?>>Administrador</option>
				</select>
			</div>

			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
		</form>

	</article>
</div>


<?php
require_once "../inc/rodape-admin.php";
?>