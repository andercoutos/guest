<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(isset($_POST['message'])){
    $append='<small>'.date('d.M.Y H:i',time()).'</small><p>';
    $append.=htmlentities($_POST['message']);
    $append.='</p><hr>'.PHP_EOL;
    $filename=__DIR__.'/messages.txt';
    $messages=file_get_contents($filename);
    if(!file_put_contents($filename, $append.$messages)){
        die('erro de permissão ao salvar o arquivo');
    }
}
        header('Location: index.php');
?>
