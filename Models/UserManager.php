<?php

class UserManager extends BDD
{
    public function getAllUsers(){
        $sql = 'SELECT * FROM Users';
        $select = $this->co->prepare($sql);
        $select->execute();

        return $select->fetchAll();
    }

    public function insertUser($donnees){
        //Hash the password
        $password = $donnees['password'];
        $hash = password_hash($password, PASSWORD_DEFAULT);

        //Insert Data
        $sql = 'INSERT INTO Users (email, password) VALUES (:e, :p)';
        $insert = $this->co->prepare($sql);
        if ($insert) {
            trigger_error('This email is already taken', E_USER_WARNING);
        }
        $insert->execute([
            'e'=>$donnees['email'],
            'p'=>$hash
        ]);

        return $insert->rowCount();
    }

    //Get and verify input of the user
    public function getUser($donnee){

            $sql = 'SELECT * FROM Users WHERE email = :e';
            $select = $this->co->prepare($sql);
            $select->execute([
                'e' => $donnee['email']
            ]);

            //get data with fetch
            $user = $select->fetch();

            //Verify hash password
            return password_verify($donnee['password'], $user['password']);


    }

    //Get all the data about the user
    public function getAllUserDAta($donnee){
        $sql = 'SELECT * FROM Users WHERE email = :e';
        $select = $this->co->prepare($sql);
        $select->execute([
            'e' => $donnee['email']
        ]);

        return $select->fetch();
    }

    //Change the role of user
    public function changeUserRole($userId, $role){
        $sql = 'UPDATE Users SET role = :r WHERE id = :id';
        $update = $this->co->prepare($sql);
        $update->execute([
            'r' => $role,
            'id' => $userId
        ]);

        return $update->rowCount();
    }

}
