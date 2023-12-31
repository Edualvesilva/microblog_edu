<?php
namespace Microblog;
use PDO, Exception;

 abstract class Utilitarios{
    /* Sobre o parâmetro $dados com tipo array/bool
    Quando um parâmetro pode receber tipos de dados
    diferentes de acordo com a chamada de método,
    usamos o operador | (OU) entre as opções de tipos.
    Essa sintax é valida a partir do PHP 7.4. */
  public static function dump(array | bool | object $dados):void{
    echo "<pre>";
    var_dump($dados);
    echo "</pre>";
  }

  public static function formataData(string $data):string{
    return date("d/m/Y H:i",strtotime($data));
  }
}


?>