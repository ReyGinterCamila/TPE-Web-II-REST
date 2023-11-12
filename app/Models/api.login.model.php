<?php
    require_once 'api.model.php';
    class UserModel extends Model
{
    public function getByUsername($username)
    {
        $query = $this->db->prepare('SELECT * FROM usuario WHERE username = ?');
        $query->execute([$username]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}

?>