<?php 
//instanciar as classes

$usuario = new Usuario();
$usuario = new UsuarioDAO();

//passar os posts

$d = filter_input_array(INPUT_POST);

//se for gravado com sucesso

if(isset($_post['cadastrar'])){
    $usuario-> setnome($d['nome']);
    $usuario-> setsobrenome($d['sobrenome']);
    $usuario-> setidade($d[idade'idade']);
    $usuario-> setsexo($d['sexo']);

    $usuarioDAO->create($usuario);

} else if (isset($GET['del'])){
    
    $usuario->setid($_GET['del']);
    $usuarioDAO->delete($usuario);

}

?>

