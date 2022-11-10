<?php

class CategoriesManager extends BDD
{
    //Get all categories
    public function findAllCategories(){
        $sql = 'SELECT * FROM Categories';
        $select = $this->co->prepare($sql);
        $select->execute();

        return $select->fetchAll();
    }

    // Get one categorie by ID
    public function findCategorieById($id){
        $sql = 'SELECT * FROM Categories WHERE id = :id';
        $select = $this->co->prepare($sql);
        $select->execute(['id' => $id]);

        return $select->fetch();
    }

    //Create new categorie
    public function insertCategorise($donnees){
        $sql = 'INSERT INTO Categories (nom) VALUES (:n)';
        $insert = $this->co->prepare($sql);
        $insert->execute(['n'=>$donnees['nom']]);

        return $insert->rowCount();
    }

    //Delete Categorie
    public function del($id){
        $sql = 'DELETE FROM Categories WHERE id = :id';
        $del = $this->co->prepare($sql);
        $del->execute(['id' => $id]);

        return $del->rowCount();
    }

    //Update Categorie
    public function editCategorie($donnees, $id){
        $sql = 'UPDATE Categories SET nom = :n WHERE id = :id';
        $update = $this->co->prepare($sql);
        $update->execute([
            'n' => $donnees['nom'],
            'id' => $id
        ]);

        return $update->rowCount();
    }
}