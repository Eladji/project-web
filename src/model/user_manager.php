<?php
class user_manager
{

    private $db;

    public function __construct()
    {
        $config = parse_ini_file('../../db_config.ini', true);
        $host = $config['database']['host'];
        $dbname = $config['database']['dbname'];
        $username = $config['database']['username'];
        $password = $config['database']['password'];
        $port = $config['database']['port'];
        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname;port=$port;charset=utf8m4", $username, $password);
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
        $query = $this->db->prepare('INSERT INTO user (name, email, password, git, score, nbt_project, icon) VALUES (:name, :email, :password, :git, :score, :nbt_project, :icon)');
        $query->bindValue(':name', $user->getName(), PDO::PARAM_STR);
        $query->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $query->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $query->bindValue(':git', $user->getGit(), PDO::PARAM_STR);
        $query->bindValue(':score', $user->getScore(), PDO::PARAM_INT);
        $query->bindValue(':nbt_project', $user->getNbt_project(), PDO::PARAM_INT);
        $query->bindValue(':icon', $user->getIcon(), PDO::PARAM_STR);
        $query->execute();

    }
    public function get($id)
    {
        $query = $this->db->prepare('SELECT * FROM user WHERE id = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch();
       $user = new user($data);
        return $user;   
    }

    public function get_all()
    { //gonna have regret over this i can feel it 
        $datas = [];
        $query = $this->db->query("SELECT * FROM 'user' ORDER BY name");
        $query->execute();
        $data = $query->fetchAll();
        foreach ($data as $datas) {
            $user = new user($datas);
            $users[] = $user;
        }
        return $users;
    }

public function update(user $user)
    {
        $query = $this->db->prepare('UPDATE user SET name = :name, email = :email, password = :password, git = :git, score = :score, nbt_project = :nbt_project, icon = :icon WHERE id = :id');
        $query->bindValue(':name', $user->getName(), PDO::PARAM_STR);
        $query->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $query->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $query->bindValue(':git', $user->getGit(), PDO::PARAM_STR);
        $query->bindValue(':score', $user->getScore(), PDO::PARAM_INT);
        $query->bindValue(':nbt_project', $user->getNbt_project(), PDO::PARAM_INT);
        $query->bindValue(':icon', $user->getIcon(), PDO::PARAM_STR);
        $query->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $query->execute();
    }

    public function delete($id)
    {
        $query = $this->db->prepare('DELETE FROM user WHERE id = :id');
        $query->bindValue(':id', $id);
        $query->execute();
    }
}
