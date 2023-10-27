<?php 
require_once "inc/cabecalho.php";
use Microblog\Utilitarios;
$noticia->setId($_GET["id"]);
$DetalhesDeNoticia = $noticia->verDetalhes();
?>


<div class="row my-1 mx-md-n1">

    <article class="col-12">
        <h2> <?=$DetalhesDeNoticia["titulo"]?> </h2>
        <p class="font-weight-light">
            <time><?=Utilitarios::formataData($DetalhesDeNoticia["data"])?></time> - <span><?=$DetalhesDeNoticia["autor"]?></span>
        </p>
        <img src="imagens/<?=$DetalhesDeNoticia["imagem"]?>" alt="" class="float-start pe-2 img-fluid">
        <p class="ajusta-texto"><?=$DetalhesDeNoticia["texto"]?></p>
    </article>
    

</div>        
                  

<?php 
require_once "inc/todas.php";
require_once "inc/rodape.php";
?>

