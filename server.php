<?php
$address = '127.0.0.1';
$port = 8080;
system("clear");
print "Disponível em http://$address:$port";
function processar_header($header,$client){
    $arr=explode(PHP_EOL,$header);
    $method=explode(' ',$arr[0])[0];
    if($method=='POST'){
        $str=end($arr);
        $str=explode('message=',$str)[1];
        $message=urldecode($str);
        require 'save.php';
    }
    tela('index',$client);
}
function retornar_mensagem($client,$msg){
    $msg=str_replace("\n"," ",$msg);
    $len=mb_strlen($msg);
    $msg="HTTP/1.1 200 OK\r\n".
    "Content-Length: ".$len."\r\n".
    "Content-Type: text/html; charset=UTF-8\r\n\r\n".
    $msg;
    socket_write($client, $msg, mb_strlen($msg));
}
function tela($tela,$client){
    ob_start();
    require $tela.'.php';
    $msg=ob_get_contents();
    ob_end_clean();
    retornar_mensagem($client,$msg);
}
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);
socket_bind($socket, $address, $port);
socket_listen($socket, 5);
$client=false;
do {
    $client = socket_accept($socket);
    tela('index',$client);
    do {
        $buf = @socket_read($client, 2048);
        if (!$buf = trim($buf)) {
            continue;
        }
        processar_header($buf,$client);
    } while (true);
    socket_close($client);
} while (true);
socket_close($socket);
?>
