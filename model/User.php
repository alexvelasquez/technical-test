<?php
class User extends Model
{
    private $id;
    private $name;
    private $lastName;
    private $username;
    private $email;
    private $password;
    private $createdAt;
    private $updatedAt;
    
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->username = $data['username'];
        $this->lastName = $data['last_name'];
        $this->createdAt = $data['created_at'];
        $this->updatedAt = $data['updated_at'];
    }
 
    protected static function tableName()
    {
        return 'user';
    }
    /** getters */
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getLastName()
    {
        return $this->lastName;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /** setters */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public static function userExists($params, $user=null)
    {
        $query = "SELECT * From user WHERE (username = ? or email = ?) ";
        if($user){
            $query .= " AND (username <> '".$user->getUsername()."' or email <> '".$user->getEmail()."')";
        }
        $result = self::executeQuery($query,$params);
        $result = self::fetchQuery($result);
        return $result;
    }
}