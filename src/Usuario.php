<?php

namespace Microblog;

use Error;
use PDO, Exception;

class Usuario
{
    private int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private string $tipo;
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = Banco::conecta();
    }


    /* Métodos para rotinas de CRUD no Banco */

    // Insert do Usuario
    public function inserir(): void
    {
        $sql = "INSERT INTO usuarios(nome,email,senha,tipo)
    VALUES (:nome,:email,:senha,:tipo)";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->bindValue(":email", $this->email, PDO::PARAM_STR);
            $consulta->bindValue(":senha", $this->senha, PDO::PARAM_STR);
            $consulta->bindValue(":tipo", $this->tipo, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao inserir usuário: " . $erro->getMessage());
        }
    }


    /* Métodos para codificação de senha */
    public function codificaSenha(string $senha): string
    {
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    public function verificaSenha($senhaFormulario,$senhaBanco): string{
        /* Usamos a função password_verify para COMPARAR as duas senhas: a digitada no formulário e a existente no banco de dados */
        if(password_verify($senhaFormulario, $senhaBanco)){
            /* Se forem iguais, mantemos a senha já existente, sem qualquer modificação */
            return $senhaBanco;
        } else {
            /* Se forem DIFERENTES, então a nova senha (ou seja,a que foi digitada no formulário) DEVE ser codificada. */
            return $this->codificaSenha($senhaFormulario);
        };

        
    }



    // SELECT de Usuário 
    public function listarUM(): array
    {
        $sql = "SELECT * FROM usuarios WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao carregar dados: " .$erro->getMessage());
        }
        return $resultado;
    }

    // UPDATE de usuário 
    public function atualizar(){
        $sql = "UPDATE usuarios SET nome = :nome, email = :email , senha = :senha, tipo = :tipo WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id",$this->id,PDO::PARAM_INT);
            $consulta->bindValue(":nome",$this->nome,PDO::PARAM_STR);
            $consulta->bindValue(":email",$this->email,PDO::PARAM_STR);
            $consulta->bindValue(":senha",$this->senha,PDO::PARAM_STR);
            $consulta->bindValue(":tipo",$this->tipo,PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao Atualizar usuário: ".$erro->getMessage());
        }

    }


    public function listar(): array
    {
        $sql = "SELECT * FROM usuarios ORDER BY nome";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Error $erro) {
            die("Erro ao inserir usuário: " . $erro->getMessage());
        }
        return $resultado;
    }


    public function getId(): int
    {
        return $this->id;
    }


    public function setId(int $id): self
    {
        $this->id = filter_var($id , FILTER_SANITIZE_NUMBER_INT);

        return $this;
    }

    public function getNome(): string
    {
        return $this->nome;
    }


    public function setNome(string $nome): self
    {
        $this->nome = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);

        return $this;
    }


    public function getEmail(): string
    {
        return $this->email;
    }


    public function setEmail(string $email): self
    {
        $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);

        return $this;
    }


    public function getSenha(): string
    {
        return $this->senha;
    }


    public function setSenha(string $senha): self
    {
        $this->senha = filter_var($senha, FILTER_SANITIZE_SPECIAL_CHARS);

        return $this;
    }


    public function getTipo(): string
    {
        return $this->tipo;
    }


    public function setTipo(string $tipo): self
    {
        $this->tipo = filter_var($tipo, FILTER_SANITIZE_SPECIAL_CHARS);

        return $this;
    }
}
