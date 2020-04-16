<?php
header('Content-Type: application/json');
require 'classes/Usuario.php';
use Classes\Usuario;

$usu = new Usuario;
if(isset($_GET['tipo'])){
    if($_GET['tipo'] == "cadastrar"){
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $usu->inserir($data['nome'], $data['email'], $data['login'], $data['senha']);
    } else if($_GET['tipo'] == "listar"){
        $data = $usu->listar(); 
        echo json_encode($data);
    } else if($_GET['tipo'] == "editar"){
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $usu->editar($data['codigo'],$data['nome'], $data['email'], $data['login'], $data['senha']);
    } else if($_GET['tipo'] == "deletar"){
        if($_GET['codigo']){
        $usu->delete($_GET['codigo']);
        }
    }
}