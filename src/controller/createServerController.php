<?php

require_once('model/channel.php');
require_once('model/messageChannel.php');

function createServer(){
    $name_server = isset($_POST['server_name']) ? $_POST['server_name'] : '';
    $rooms = isset($_POST['number_rooms']) ? $_POST['number_rooms'] : '';
    $user_id = $_SESSION['user_id'] ?? false;

    if(!empty($name_server) && !empty($rooms) ){
        Server::createNewServer($name_server, $user_id);
        Server::createUserServer($name_server, $user_id);

        for($i = 1; $i <= intval($rooms); $i++){
            Channel::createChannel('Room'.$i, $rooms);
        }
        $welcome = 'Welcome on the server '.$name_server. ' , enjoy!';
        MessageChannel::addMessageFromAdmin(0, $user_id,  $welcome );
        $msg = 'Serveur crée';
    }else{
        $msg = 'Veuillez remplir tous les champs';
    }


    require 'view/CreateServerView.php';
}