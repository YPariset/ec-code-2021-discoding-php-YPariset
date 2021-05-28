<?php
require_once('database.php');
class Server{

    private $id;
    private $url;
    private $created_at;
    private $name;
    private $id_user;
    private $avatar_url;

    public function __construct( $server = null ) {
        $this->setId( isset( $server->id ) ? $server->id : null );
        $this->setUrl( isset( $server->url ) ? $server->url : null );
        $this->setCreatedAt( isset( $server->created_at ) ? $server->created_at : null );
        $this->setName( isset( $server->name ) ? $server->name : null );
        $this->setIdUser( isset( $server->id_user ) ? $server->id_user : null );
        $this->setAvatarUrl( isset( $server->avatar_url ) ? $server->avatar_url : null );
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
   * @param mixed $username
   */
  public function setCreatedAt($created_at)
  {
      $this->created_at = $created_at;
  }

  /**
   * @return mixed
   */
  public function getCreatedAt()
  {
      return $this->created_at;
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

  /**
   * @return mixed
   */
  public function getIdUser()
  {
      return $this->id_user;
  }

  /**
   * @param mixed $avatar_url
   */
  public function setIdUser($id_user)
  {
      $this->id_user = $id_user;
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

  /**
   * @return mixed
   */
  public function getUrl()
  {
      return $this->url;
  }
  public function setUrl($url)
  {
      $this->url = $url;
  }

  

/******************************************************/
public static function createNewServer($name, $id_user){

        $db = init_db();
        $avatar = '/static/img/anonyme_avatar.png';
        $url = 'index.php&action=server&server='.$name.'##'.substr(md5($name), 0, 10);

        // Check if email already exist
        $req  = $db->prepare( "SELECT * FROM servers WHERE name = ? " );
        $req->execute( array($name));
    
        if( $req->rowCount() > 0 ) :
          return false;
        else : 
            $req->closeCursor();
            $req  = $db->prepare( "INSERT INTO servers (name, user_id, avatar_url, url) VALUES (?, ?, ?, ?)" );
            $datas = $req->execute(array($name, $id_user, $avatar, $url));
        endif;
        }

        public static function createUserServer($name, $id_user){
                $db = init_db();
                $req  = $db->prepare( "SELECT id FROM servers WHERE name = ?" );
                $req->execute(array($name));
                $data = $req->fetch();
                $row = $data['id'];
                $req->closeCursor();

                $req  = $db->prepare( "INSERT INTO user_server (id_server, id_user) VALUES (?, ?)" );
                $datas = $req->execute(array($row, $id_user));
            }

    public static function displayServeur($idServeur){
        $db = init_db();
        $req  = $db->prepare( "SELECT c.name as rooms, s.name as nom_server, s.user_id as admin, s.url, s.avatar_url
                                 FROM servers as s,  channels as c
                                WHERE  c.server_id = s.id
                                AND  s.id = ? " );
            $req->execute( array($idServeur));
    }

    public static function getAllServeurByUser($idUser){
        $db = init_db();
        $req  = $db->prepare( "SELECT * FROM servers as s, user_server as us, users as u
                                WHERE  s.id = us.id_server
                                AND u.id = us.id_user
                                AND u.id = ?");
            $req->execute(array($idUser));
        return $req->fetchAll();
    }
}