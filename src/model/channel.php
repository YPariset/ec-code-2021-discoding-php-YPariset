<?php 
require_once('database.php');
class Channel{

    private $id;
    private $serverd;
    private $userId;
    private $content;
    private $createdAt;

    public function __construct( $channel = null ) {
          $this->setId( isset( $channel->id ) ? $channel->id : null );
          $this->setUserId( isset( $channel->user_id ) ? $channel->user_id : null );
          $this->setServerId( isset( $channel->server_id ) ? $channel->server_id : null );
          $this->setId( isset( $channel->name ) ? $channel->name : null );
   
      }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $email
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }


    /**
     * @param mixed $username
     */
    public function setServerId($server_id)
    {
        $this->server_id = $server_id;
    }

    /**
     * @return mixed
     */
    public function getServerId()
    {
        return $this->server_id;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @param mixed $password
     */
    public function setName($name)
    {
        $this->name = $name;
    }

public static function createChannel($name, $number){
    $db = init_db();
    $req  = $db->prepare( "INSERT INTO channels (name, server_id) VALUES (?, ?)" );
    $datas = $req->execute(array($name, $number));
    return $datas;

}

}

