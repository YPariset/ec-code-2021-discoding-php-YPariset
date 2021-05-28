<?php

require_once('database.php');

class User
{
    protected $id;
    protected $email;
    protected $username;
    protected $password;
    protected $avatar_url;
    
    /**
     * __construct
     *
     * @param  mixed $user
     * @return void
     */
    public function __construct( $user = null ) {

        if( $user != null ):
          $this->setId( isset( $user->id ) ? $user->id : null );
          $this->setEmail( $user->email );
          $this->setUsername( $user->username );
          $this->setPassword( $user->password, isset( $user->password_confirm ) ? $user->password_confirm : null );
          
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username.'#'.rand(1000, 9999);
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getAvatarUrl()
    {
        return $this->avatar_url;
    }

    /**
     * @param mixed $avatar_url
     */
    public function setAvatarUrl($avatar_url)
    {
        $this->avatar_url = $avatar_url;
    }


  /***********************************
  * -------- CREATE NEW USER ---------
  ************************************/
  
  /**
   * createUser
   *
   * @return void
   */
  public function createUser() {

    // Open database connection
    $db   = init_db();
    //Default avatar
    $avatar = '/static/img/default-avatar.jpeg';


    // Check if email already exist
    $req  = $db->prepare( "SELECT * FROM users WHERE email = ?" );
    $req->execute( array( $this->getEmail() ) );

    
    if( $req->rowCount() > 0 ) :
        return false;
      else : 
        // Insert new user
        $req->closeCursor();

        $req  = $db->prepare( "INSERT INTO users ( email, password, username, avatar_url ) VALUES ( :email, :password, :username, :avatar )" );
        $req->execute( array(
        'email'     => $this->getEmail(),
        'password'  => $this->getPassword(),
        'username'  => $this->getUsername(),
        'avatar'    => $avatar
        ));
        return true;
    endif;

    // Close databse connection
    $db = null;

  }


    /**************************************
     * -------- GET USER DATA BY ID --------
     ***************************************/
    
    /**
     * getUserById
     *
     * @param  mixed $id
     * @return void
     */
    public static function getUserById($id)
    {
        // Open database connection
        $db = init_db();

        $req = $db->prepare("SELECT * FROM users WHERE id = ?");
        $req->execute([$id]);

        // Close database connection
        $db = null;

        return $req->fetch();
    }

    /***************************************
     * ------- GET USER DATA BY USERNAME -------
     ****************************************/
    
    /**
     * getUserByCredentials
     *
     * @param  mixed $email
     * @param  mixed $password
     * @return void
     */
    public static function getUserByCredentials($email, $password)
    {
        // Open database connection
        $db = init_db();

        $req = $db->prepare("SELECT * FROM users WHERE email=? AND password=?");
        $req->execute([
            $email,
            $password
        ]);

        // Close database connection
        $db = null;

        return $req->fetch();
    }
    
    /**
     * getFriendsForUser
     *
     * @param  mixed $user_id
     * @return array
     */
    public static function getFriendsForUser($user_id): array
    {
        // Open database connection
        $db = init_db();

        $req = $db->prepare("SELECT users.* FROM users LEFT JOIN friends ON users.id = friends.friend_user_id WHERE friends.user_id = ?");
        $req->execute([$user_id]);

        // Close database connection
        $db = null;

        return $req->fetchAll();
    }
    
    /**
     * findUserWithUsername
     *
     * @param  mixed $username
     * @return void
     */
    public static function findUserWithUsername($username)
    {
        // Open database connection
        $db = init_db();

        $req = $db->prepare("SELECT * FROM users WHERE username = ?");
        $req->execute(array($username));
        
        $db = null;

        return $req->fetch();
    }

    
    /**
     * isAlreadyFriend
     *
     * @param  mixed $user_id
     * @param  mixed $friend_id
     * @return void
     */
    public static function isAlreadyFriend($user_id, $friend_id)
    {
        // Open database connection
        $db = init_db();

        $req = $db->prepare("SELECT COUNT(*) FROM friends WHERE (user_id = ? AND friend_user_id = ?) OR (user_id = ? AND friend_user_id = ?)");
        $req->execute([
            $user_id,
            $friend_id,
            $friend_id,
            $user_id
        ]);

        $isAlreadyFriend = $req->fetchColumn() > 0;

        // Close database connection
        $db = null;

        return $isAlreadyFriend;
    }
    
    /**
     * filterUsers
     *
     * @param  mixed $username
     * @return array
     */
    public static function filterUsers($username = null) : array
  {
      // Open database connection
      $db = init_db();
      $sql = "SELECT * FROM users WHERE ";

      $fields = [];

      if ($username != null) {
          array_push($fields, "username LIKE '%" . $username . "%'");
      }

      if (sizeof($fields) > 0) {
          $sql .= join(" AND ", $fields);
      }
      else {
          $sql .= "1";
      }
      $sql .= " ORDER BY username DESC";

      $req = $db->prepare($sql);
      $req->execute();
      // Close database connection
      $db = null;
      return $req->fetchAll(PDO::FETCH_ASSOC);
  }
    
    /**
     * addFriend
     *
     * @param  mixed $user_id
     * @param  mixed $friend_id
     * @return void
     */
    public static function addFriend($user_id, $friend_id)
    {
        // Open database connection
        $db = init_db();

        $req = $db->prepare("INSERT INTO friends VALUES (NULL, ?, ?)");
        $req->execute([
            $user_id,
            $friend_id
        ]);

        $id = $db->lastInsertId();
        // Close database connection
        $db = null;

        return $id;
    }
}
