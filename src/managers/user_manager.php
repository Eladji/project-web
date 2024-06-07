<?php
class user_manager
{

    private $db;

    public function __construct()
    {
        $config = parse_ini_file('./db_config.ini', true);
        if ($config === false) {
            // Handle error - for example, by throwing an exception or displaying an error message
            throw new Exception('Failed to connect to database: ' . mysqli_connect_error());
        }        
        $host = $config['database']['host'];
        $dbname = $config['database']['dbname'];
        $username = $config['database']['username'];
        $password = $config['database']['password'];
        $port = $config['database']['port'];
        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname;port=$port;charset=UTF8", $username, $password);
        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }
    public function setdb($db)
    {
        $this->db = $db;
    }
public function add(user $user)
    {
        $req = $this->db->prepare('INSERT INTO user (name, email, password, git, score, nbt_project, icon) VALUES (:name, :email, :password, :git, :score, :nbt_project, :icon)');
        $req->bindValue(':name', $user->getName(), PDO::PARAM_STR);
        $req->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $req->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $req->bindValue(':git', $user->getGit(), PDO::PARAM_STR);
        $req->bindValue(':score', $user->getScore(), PDO::PARAM_INT);
        $req->bindValue(':nbt_project', $user->getNbt_project(), PDO::PARAM_INT);
        $req->bindValue(':icon', $user->getIcon(), PDO::PARAM_STR);
        $req->execute();

    }
    public function get($id)
    {
        $req = $this->db->prepare('SELECT * FROM user WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch();
       $user = new user($data);
        return $user;   
    }

    public function get_all()
    { //gonna have regret over this i can feel it 
        $datas = [];
        $req = $this->db->req("SELECT * FROM 'user' ORDER BY name");
        $req->execute();
        $data = $req->fetchAll();
        foreach ($data as $datas) {
            $user = new user($datas);
            $users[] = $user;
        }
        return $users;
    }

public function update(user $user)
    {
        $req = $this->db->prepare('UPDATE user SET name = :name, email = :email, password = :password, git = :git, score = :score, nbt_project = :nbt_project, icon = :icon WHERE id = :id');
        $req->bindValue(':name', $user->getName(), PDO::PARAM_STR);
        $req->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $req->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $req->bindValue(':git', $user->getGit(), PDO::PARAM_STR);
        $req->bindValue(':score', $user->getScore(), PDO::PARAM_INT);
        $req->bindValue(':nbt_project', $user->getNbt_project(), PDO::PARAM_INT);
        $req->bindValue(':icon', $user->getIcon(), PDO::PARAM_STR);
        $req->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $req->execute();
    }

    public function delete($id)
    {
        $req = $this->db->prepare("DELETE FROM 'user' WHERE id = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
}
