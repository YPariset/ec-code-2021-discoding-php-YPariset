<?php

require_once('database.php');

/**
 * Conversation
 */
class Conversation
{
    protected $id;
    protected $user_id;
    protected $interlocutor_id;
    protected $interlocutor_username;
    protected $updated_at;
    
    /**
     * __construct
     *
     * @param  mixed $conversation
     * @return void
     */
    public function __construct( $conversation = null ) {

        if( $conversation != null ):
            $this->setId( isset( $conversation->id ) ? $conversation->id : null );
            $this->setUserId( isset( $conversation->user_id) ? $conversation->user_id : null );
            $this->setInterlocutorId( isset( $conversation->interlocutor_id) ? $conversation->interlocutor_id : null );
            $this->setInterlocutorUsername( isset( $conversation->interlocutor_username) ? $conversation->interlocutor_username : null );
            $thiis->setUpdatedAt(isset( $conversation->updated_at) ? $conversation->updated_at : null );
          
        endif;
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
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getInterlocutorId()
    {
        return $this->interlocutor_id;
    }

    /**
     * @param mixed $interlocutor_id
     */
    public function setInterlocutorId($interlocutor_id)
    {
        $this->interlocutor_id = $interlocutor_id;
    }

    /**
     * @return mixed
     */
    public function getInterlocutorUsername()
    {
        return $this->interlocutor_username;
    }

    /**
     * @param mixed $interlocutor_username
     */
    public function setInterlocutorUsername($interlocutor_username)
    {
        $this->interlocutor_username = $interlocutor_username;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }
    
    /**
     * getConversationIdBetweenUsers
     *
     * @param  mixed $user_id
     * @param  mixed $user_id2
     * @return void
     */
    public static function getConversationIdBetweenUsers($user_id, $user_id2)
    {
        $db = init_db();

        $req = $db->prepare("SELECT id FROM conversations WHERE (user1_id = ? AND user2_id = ?) OR (user1_id = ? AND user2_id = ?)");
        $req->execute(array(
                $user_id,
                $user_id2,
                $user_id2,
                $user_id)
        );

        // Close database connection
        $db = null;

        $data = $req->fetch();

        return $data['id'] ?? 0;
    }
    
    /**
     * getConversationForUser
     *
     * @param  mixed $conversation_id
     * @param  mixed $user_id
     * @return void
     */
    public static function getConversationForUser($conversation_id, $user_id)
    {
        $db = init_db();

        $req = $db->prepare("SELECT c.id , u.id as interlocutor_id, u.username as interlocutor_username , u.avatar_url as interlocutor_avatar_url, c.updated_at FROM conversations as c JOIN users as u ON (c.user1_id = u.id OR c.user2_id = u.id) WHERE (c.id = ?) AND u.id != ?");
        $req->execute([
                $conversation_id,
                $user_id
            ]
        );

        // Close database connection
        $db = null;

        return $req->fetch();
    }
    
    /**
     * getAllConversationsForUser
     *
     * @param  mixed $user_id
     * @return void
     */
    public static function getAllConversationsForUser($user_id)
    {
        $db = init_db();

        $req = $db->prepare("SELECT c.id, u.id as interlocutor_id, u.username as interlocutor_username, u.avatar_url as interlocutor_avatar_url, c.updated_at FROM conversations as c JOIN users as u ON (c.user1_id = u.id OR c.user2_id = u.id) WHERE (c.user1_id = ? OR c.user2_id = ?) AND u.id != ? ORDER BY c.updated_at DESC;");
        $req->execute([
                $user_id,
                $user_id,
                $user_id
            ]
        );
        // Close database connection
        $db = null;

        return $req->fetchAll();
    }

    
    /**
     * createConversationBetweenUsers
     *
     * @param  mixed $user_id1
     * @param  mixed $user_id2
     * @return void
     */
    public static function createConversationBetweenUsers($user_id1, $user_id2)
    {
        $db = init_db();

        $req = $db->prepare("INSERT INTO conversations VALUES (NULL, ?, ?, CURRENT_TIME())");
        $req->execute([
            $user_id1,
            $user_id2
        ]);

        $conversation_id = $db->lastInsertId();
        // Close database connection
        $db = null;

        return $conversation_id;
    }
    
    /**
     * updateTimeConversation
     *
     * @param  mixed $date
     * @param  mixed $id
     * @return void
     */
    public static function updateTimeConversation($date, $id){
        $db = init_db();
        
        $req = $db->prepare("UPDATE conversations SET updated_at = ? WHERE id = ?");
        $req->execute(array($date, $id));
    }

}