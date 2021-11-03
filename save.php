<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$post_message=false;
if(@$_POST['message']){
    $message=$_POST['message'];
    $post_message=true;
}
$prepend='<small>'.date('d.M.Y H:i:s',time()).'</small><p>';
$prepend.=htmlentities($message);
$prepend.='</p><hr>'.PHP_EOL;
$filename=__DIR__.'/messages.txt';
$messages=file_get_contents($filename);
if(!file_put_contents($filename, $prepend.$messages, LOCK_EX)){
    die('erro de permissão ao salvar o arquivo');
}
if($post_message){
    header('Location: index.php');
}
?>
