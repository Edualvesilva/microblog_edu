<?php

use Microblog\Noticia;
use Microblog\Utilitarios;

require_once "vendor/autoload.php";

$noticia = new Noticia;
$noticia->setTermo($_POST["busca"]);
$resultado = $noticia->busca();
$quantidade = count($resultado);

if ($quantidade > 0) { ?>
    <h2 class="fs-5">Resultados: <span class="badge bg-success"><?= $quantidade ?></span></h2>
    <div class="list-group">
        <?php foreach ($resultado as $itemNoticia) { ?>
            <a class="list-group-item list-group-item-action" href="noticia.php?id=<?= $itemNoticia["id"] ?>"><?= $itemNoticia["titulo"] ?></a>
        <?php } ?>
    </div>
<?php } else {
?>
    <h2 class="fs-5 text-danger">Sem notícias</h2>
<?php } ?>