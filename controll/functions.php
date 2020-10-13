<?php

// Upload de imagem
function image_upload($image){
    $target_dir = "../assets/img/";
    $target_file = $target_dir . basename($image["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($image["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" && $imageFileType != "svg" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        $newFileName = uniqid('uploaded-', true) . '.' . strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        if (move_uploaded_file($image["tmp_name"], $target_file . $newFileName)) {
            return ($image['name'] . $newFileName);
        } else {
            return 0;
        }
    }
}

// Pega dados de cliente já cadastrado
function get_cliente(){
    require '../connect/connect.php';
}

// Cadastra novo cliente
function add_cliente($cliente_nome, $cliente_site, $cliente_responsavel, $cliente_logo){
    require '../connect/connect.php';
    $cliente_logo = image_upload($cliente_logo);
    $sql="INSERT INTO `clientes` (`nome`, `site`, `responsavel`, `logo`) VALUES ('$cliente_nome', '$cliente_site', '$cliente_responsavel', '$cliente_logo')";
    if (mysqli_query($link, $sql)) {
        return mysqli_insert_id($link);
    } 
    else {
        return 0;
    }
}

// Adiciona Evento
function add_evento($cliente_id, $evento_nome, $evento_data, $evento_hora){
    require '../connect/connect.php';
    $sql="INSERT INTO `lives` (`clientes_idclientes`, `nome`, `data`, `hora`) VALUES ('$cliente_id', '$evento_nome', '$evento_data', '$evento_hora')";
    if (mysqli_query($link, $sql)) {
        return mysqli_insert_id($link);
    } 
    else {
        return 0;
    }
}

// Pega todos os convidados da live
function get_convidados($evento_id){
    require '../connect/connect.php';
    $sql = "SELECT * FROM `convidados` WHERE lives_idlives = '$evento_id' ORDER BY nome";
    $result = $link->query($sql);
    
    return $result;
}

// Adiciona convidado
function add_convidado($evento_id, $convidados_nome, $convidados_curriculo, $convidados_bio, $convidados_foto){
    require '../connect/connect.php';
    $convidados_foto = image_upload($convidados_foto);
    $sql="INSERT INTO `convidados` (`lives_idlives`, `nome`, `link_curriculo`, `foto`, `minibio`) VALUES ('$evento_id', '$convidados_nome', '$convidados_curriculo', '$convidados_foto', '$convidados_bio')";
    
    // Execura
    if (mysqli_query($link, $sql)) {
        return 1;
    } 
    else {
        return 0;
    }
}

// Edita convidado
function edit_convidado($edit_convidados_id, $edit_convidados_nome, $edit_convidados_curriculo, $edit_convidados_foto, $edit_convidados_bio){
    require '../connect/connect.php';
    // Verifica se a foto teve alteração
    if($edit_convidados_foto == 0){
        $sql="UPDATE `convidados` SET nome = '$edit_convidados_nome', link_curriculo = '$edit_convidados_curriculo', minibio = '$edit_convidados_bio' WHERE idconvidados = '$edit_convidados_id'";
    } else {
        $edit_convidados_foto = image_upload($edit_convidados_foto);
        $sql="UPDATE `convidados` SET nome = '$edit_convidados_nome', link_curriculo = '$edit_convidados_curriculo', foto = '$edit_convidados_foto', minibio = '$edit_convidados_bio' WHERE idconvidados = '$edit_convidados_id'";
    }

    // Executa
    if (mysqli_query($link, $sql)) {
        return 1;
    } 
    else {
        return 0;
    }
}

// Deleta convidado
function del_convidado($del_convidados_id){
    require '../connect/connect.php';
    $sql="DELETE FROM `convidados` WHERE idconvidados = '$del_convidados_id'";
    
    // Execura
    if (mysqli_query($link, $sql)) {
        return 1;
    } 
    else {
        return 0;
    }
}

// Adiciona personalização
function add_personalizacao($evento_id, $personalizacao_bg, $personalizacao_logo, $personalizacao_cor1, $personalizacao_cor2, $tipo_de_convidados){
    require '../connect/connect.php';
    $personalizacao_bg = image_upload($personalizacao_bg);
    $personalizacao_logo = image_upload($personalizacao_logo);
    $sql="UPDATE `lives` SET bg = '$personalizacao_bg', logo = '$personalizacao_logo', cor1 = '$personalizacao_cor1', cor2 = '$personalizacao_cor2', flag_convidados = '$tipo_de_convidados' WHERE idlives = '$evento_id'";
    if (mysqli_query($link, $sql)) {
        return 1;
    } 
    else {
        return 0;
    }
}

// Adiciona dados de interação
function add_interacao(){
    require '../connect/connect.php';
}

// Adiciona transmissão
function add_transmissao(){
    require '../connect/connect.php';
}

// Adiciona cadastro
function add_cadastro(){
    require '../connect/connect.php';
}

// Adiciona login
function add_login(){
    require '../connect/connect.php';
}

// Adiciona mensagens
function add_mensagens(){
    require '../connect/connect.php';
}

?>