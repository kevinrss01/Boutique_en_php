<?php

class ProductsManager extends BDD
{
    //find all Products from categorie
    public function findByCategorie($id_categorie){
        $sql = 'SELECT * FROM Produits WHERE categorie = :id';
        $select = $this->co->prepare($sql);
        $select->execute(['id' => $id_categorie]);

        return $select->fetchAll();
    }

    //Add product
    public function insert($donnees){
        $sql = 'INSERT INTO produits(nom, prix, description, quantité, categorie) VALUES (:n, :p, :d, :q, :c)';
        $insert = $this->co->prepare($sql);
        $insert->execute([
            'n' => $donnees['nom'],
            'p' => $donnees['prix'],
            'd' => $donnees['description'],
            'q' => $donnees['quantité'],
            'c' => $donnees['categorie']
        ]);

        return $insert->rowCount();
    }

    //Find one product
    public function findOneProductById($product_id){
        $sql = 'SELECT * FROM Produits WHERE id = :id';
        $select = $this->co->prepare($sql);
        $select->execute(['id' => $product_id]);

        return $select->fetch();
    }

    //update Product
    public function majProduct($donnees, $id){
        $sql = 'UPDATE Produits SET nom = :n, description = :d, quantité = :q, prix = :p, categorie = :c WHERE id = :id';
        $update = $this->co->prepare($sql);
        $update->execute([
            'n' => $donnees['nom'],
            'd' => $donnees['description'],
            'q' => $donnees['quantité'],
            'p' => $donnees['prix'],
            'c' => $donnees['categorie'],
            'id' => $id
        ]);


        return $update->rowCount();
    }

    public function delProduct($id){
        $sql = 'DELETE FROM Produits WHERE id = :id';
        $del = $this->co->prepare($sql);
        $del->execute(['id' => $id]);

        return $del->rowCount();
    }

}