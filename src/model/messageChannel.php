<?php 
require_once('database.php');
class MessageChannel{


    private $id;
    private $channelId;
    private $userId;
    private $content;
    private $createdAt;
    
    /**
     * __construct
     *
     * @param  mixed $messageChannel
     * @return void
     */
    public function __construct( $messageChannel = null ) {
          $this->setId( isset( $messageChannel->id ) ? $messageChannel->id : null );
          $this->setChannelId( isset( $messageChannel->channelId ) ? $messageChannel->channelId : null );
          $this->setUserId( isset( $messageChannel->userId ) ? $messageChannel->userId : null );
          $this->setContent( isset( $messageChannel->content ) ? $messageChannel->content : null );
          $this->setCreatedAt( isset( $messageChannel->createdAt ) ? $messageChannel->createdAt : null );
   
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
    public function getChannelId()
    {
        return $this->channelId;
    }

    /**
     * @param mixed $email
     */
    public function setChannelId($channelId)
    {
        $this->channelId = $channelId;
    }


    /**
     * @param mixed $username
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }


    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }


    /**
     * @param mixed $password
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $avatar_url
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }
    
    /**
     * addMessageFromAdmin
     *
     * @param  mixed $channel_id
     * @param  mixed $user_id
     * @param  mixed $content
     * @return void
     */
    public static function addMessageFromAdmin($channel_id, $user_id, $content){
        $db = init_db();
        $req  = $db->prepare( "INSERT INTO message_channel (channel_id, user_id, content) VALUES (?, ?, ?)" );
            $datas = $req->execute(array($channel_id, $user_id, $content));
            
    }
    
}