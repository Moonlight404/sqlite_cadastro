<?php

namespace Classes;

require 'Conexao.php';
use Classes\Conexao;

class Usuario {
    
    private $conexao;
    
    public function __construct() {
        $this->conexao = Conexao::getConexao();
    }
    
    public function listar() {
        $sql = "select * from usuario;";       
        $q = $this->conexao->prepare($sql);
        $q->execute();
        $users = array();
        foreach($q as $result){
            $users[] = $result;
        };
        return $users;
    }

    public function editar($codigo, $nome, $email, $login, $senha){
        if(strlen($senha) == 0){
           $sql = "update usuario set nome = ?, email = ?, login = ? where codigo = ?;";       
        $q = $this->conexao->prepare($sql);
        $q->bindParam(1, $nome);
        $q->bindParam(2, $email);
        $q->bindParam(3, $login);
        $q->bindParam(4, $codigo);
        $q->execute();
        } else{
        $sql = "update usuario set nome = ?, email = ?, login = ?, senha = ? where codigo = ?;";       
        $q = $this->conexao->prepare($sql);
        $q->bindParam(1, $nome);
        $q->bindParam(2, $email);
        $q->bindParam(3, $login);
        $q->bindParam(4, md5($senha));
        $q->bindParam(5, $codigo);
        $q->execute();
        }
    }

    public function delete($codigo){
        $sql = "delete from usuario where codigo = ?;";       
        $q = $this->conexao->prepare($sql);
        $q->bindParam(1, $codigo);
        $q->execute();
    }
    
    public function inserir($nome, $email, $login, $senha) {
        $sql = "insert into usuario (nome, email, login, senha) values (?, ?, ?, ?);";
        $q = $this->conexao->prepare($sql);
        $q->bindParam(1, $nome);
        $q->bindParam(2, $email);
        $q->bindParam(3, $login);
        $q->bindParam(4, md5($senha));
        $q->execute();
    }
    
}

?>