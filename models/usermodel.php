<?php

class UserModel extends Model implements IModel{

    private $id;
    private $username;
    private $password;
    private $email;

    public function __construct(){
        parent::__construct();

        $this->username = '';
        $this->password = '';
        $this->email= '';
        $this->id = '';
    }
    
    function getAll(){ }
    
    private function getDateLima(){
        $fechaActual=new DateTime();
        $fechaActual->setTimeZone(new DateTimeZone('America/Lima'));
        $fechaNueva = $fechaActual->format('Y-m-d H:i:s');
        return $fechaNueva;
    }

    public function getcvs($id){

        try{

            $select = $this->prepare("SELECT id, DATE(created_at) Fecha, TIME(created_at) Hora FROM curriculum WHERE id_user = :id");

            $select->bindValue(":id", $id, PDO::PARAM_INT);

            $select->execute();

            $data = $select->fetchAll(PDO::FETCH_ASSOC);

            return $data;   

        }catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }

    }

    public function fullUpdate($id, $datos){

        try{

            $pdo = $this->connect();

            $update = $pdo->prepare("UPDATE user SET name = :name, lastname = :lastname, email = :email, phone = :phone, country = :country, city = :city, photo = :photo, street = :street WHERE id = :id");

            $pathFile = $this->saveFile($datos['photo'], 'image');

            if(!$pathFile) $pathFile = $this->get($id)['photo'];

            $update->bindValue(":name", $datos["name"], PDO::PARAM_STR);
            $update->bindValue(":lastname", $datos["lastname"], PDO::PARAM_STR);
            $update->bindValue(":email", $datos["email"], PDO::PARAM_STR);
            $update->bindValue(":phone", $datos["phone"], PDO::PARAM_STR);
            $update->bindValue(":country", $datos["country"], PDO::PARAM_STR);
            $update->bindValue(":city", $datos["city"], PDO::PARAM_STR);
            $update->bindValue(":street", $datos["street"], PDO::PARAM_STR);
            $update->bindValue(":id", $id, PDO::PARAM_INT);
            $update->bindValue(":photo", $pathFile, PDO::PARAM_STR);

            return $update->execute();

        }catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }

    }

    public function deletecv($id){
        try{

            $delete = $this->prepare("DELETE FROM curriculum WHERE id = :id");

            $delete->bindValue(":id", $id, PDO::PARAM_INT);

            return $delete->execute();

        }catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    function updateName($name, $iduser){
        try{
            $select = $this->prepare("UPDATE user SET name = :name WERE id = :id");
            $select->bindValue(":name", $name, PDO::PARAM_STR);
            $select->bindValue(":id", $iduser, PDO::PARAM_INT);
            $select->execute();
            if($select->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            print_r($e->getMessage());
        }
    }

    function updatePassword($new, $iduser){
        try{
            $hash = $this->getHashedPassword($new);
            $query = $this->prepare('UPDATE user SET password = :val WHERE id = :id');
            $query->bindValue(":val", $hash, PDO::PARAM_STR);
            $query->bindValue(":id", $iduser, PDO::PARAM_INT);
            $query->execute();

            if($query->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        
        }catch(PDOException $e){
            return NULL;
        }
    }

    function comparePasswords($current, $userid){
        try{

            $query = $this->prepare('SELECT password FROM user WHERE id = :id');
         
            $query->bindValue(":id", $userid, PDO::PARAM_INT);

            $query->execute();

            if($row = $query->fetch(PDO::FETCH_ASSOC)) return $this->verifyPassword($current, $row['password']);

        }catch(PDOException $e){
            error_log($e->getMessage());
        }
    }

    public function save(){
        try{
            $query = $this->prepare('INSERT INTO user(username, email, password, photo) VALUES(:username, :email, :password, :photo )');
            $query->bindValue(":username", $this->username, PDO::PARAM_STR);
            $query->bindValue(":email", $this->email, PDO::PARAM_STR);
            $query->bindValue(":password", $this->password, PDO::PARAM_STR);
            $query->bindValue(":photo", constant('URL'). '/assets/img/admin.jpg', PDO::PARAM_STR);
            // error_log($this->username, " " , $this->password, " ", $this->created_at);
            if($query->execute()) return true;
            return false;
        }catch(PDOException $e){
            error_log($e->getMessage());
        }
    } 
    /**
     *  Gets an item
     */
    public function get($id){
        try{
            $query = $this->prepare('SELECT * FROM user WHERE id = :id');
            $query->execute([ 'id' => $id]);
            $user = $query->fetch(PDO::FETCH_ASSOC);

            $this->id = $user['id'];
            $this->password = $user['password'];
            $this->username = $user['username'];

            return $user;
        }catch(PDOException $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public function delete($id){
        try{
            $query = $this->prepare('DELETE FROM user WHERE id = :id');
            $query->execute([ 'id' => $id]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    // public function update(){
    //     try{
    //         $query = $this->prepare('UPDATE user SET username = :username, password = :password, budget = :budget, photo = :photo, name = :name WHERE id = :id');
    //         $query->execute([
    //             'id'        => $this->id,
    //             'username' => $this->username, 
    //             'password' => $this->password,
    //             'budget' => $this->budget,
    //             'photo' => $this->photo,
    //             'name' => $this->name
    //             ]);
    //         return true;
    //     }catch(PDOException $e){
    //         echo $e;
    //         return false;
    //     }
    // }

    public function update($id){
        
    }

    public function exists(){
        try{
            $query = $this->prepare('SELECT id FROM user WHERE username = :username OR email = :email');
            $query->bindValue(":username", $this->username, PDO::PARAM_STR);
            $query->bindValue(":email", $this->email, PDO::PARAM_STR);
            $query->execute();
            
            if($query->rowCount() > 0){
                $result = $query->fetch(PDO::FETCH_ASSOC);
                $this->id = $result['id'];
                return true;
            }else{
                error_log("USERMODEL::EXISTS false");
                return false;
            }
        }catch(PDOException $e){
            error_log($e->getMessage());
        }
    }

    public function from($array){
        $this->id = $array['id'] ?? '';
        $this->username = $array['username'] ?? '';
        $this->password = $this->getHashedPassword($array['password'] ?? '');
        $this->email = $array['email'] ?? '';
    }

    private function encryptionOn($password){
        $output=FALSE;
        $key=hash('sha256', SECRET_KEY);
        $iv=substr(hash('sha256', SECRET_IV), 0, 16);
        $output=openssl_encrypt($password, METHOD, $key, 0, $iv);
        $output=base64_encode($output);
        return $output;
    }

    private function encryptionOff($hash){
        $key=hash('sha256', SECRET_KEY);
        $iv=substr(hash('sha256', SECRET_IV), 0, 16);
        $output=openssl_decrypt(base64_decode($hash), METHOD, $key, 0, $iv);
        return $output;
    }

    private function getHashedPassword($password){
        return $this->encryptionOn($password);
    }

    public function verifyPassword($current, $hash){
        $password = $this->encryptionOff($hash);
        error_log("Password acutal -> $current , Passwod Descriptada -> $password");
        if($current === $password){
            return true;
        }else{return false;}
    }

    /**
     * GETTERS AND SETTERS 
     */
    
    public function setPassword($password)    { $this->password = $this->getHashedPassword($password);}
    public function setUsername($username)    { $this->username = $username;}
    public function setEmail($email)          { $this->email = $email;}
   
    public function getId()                   { return $this->id;}
    public function getUsername()             { return $this->username;}
    public function getPassword()             { return $this->password;}
}

?>