<?php

class CategoriesController extends CategoriesManager
{
    //Get Categories data
    public function getCategoriesPage(){
        ob_start();

        $categories = $this->findAllCategories();

        require 'views/navbar.php';
        require 'views/categories/homeCategories.php';

        $vue = ob_get_clean();

        return $vue;
    }


    //Get Form add categorie
    public function getFormAddCategorie(){
        if(isset($_SESSION['ADMIN'])){
            ob_start();

            require 'views/navbar.php';
            require 'views/categories/formCategorie.php';

            $vue = ob_get_clean();

            return $vue;
        } else {
            $_SESSION['error'] = '<p class="alert alert-danger">Vous n\'avez pas le droit d\'acceder à cette page.🛑</p>';
        }

    }

    //Send new categorie
    public function addCategorie($formulaire){

        if(isset($_SESSION['ADMIN'])){
            if($this->isValidCategorie($formulaire)){
                if($this->insertCategorise($formulaire) > 0){
                    echo '<p>'.$formulaire['nom'].' ajouté</p>';
                    header('Location: index.php?page=home');
                }
                else{
                    echo '<p>Une erreur est survenue lors de l\'insertion de '.$formulaire['nom'].'</p>';
                }
            }
            else{
                $_SESSION['erreur'] = '<p class="alert alert-danger">Formulaire invalide</p>';
                header('Location: index.php?page=marque_add');
                return;
            }
        } else {
            $_SESSION['error'] = '<p class="alert alert-danger">Vous n\'avez pas le droit d\'acceder à cette page.🛑</p>';
        }

    }


    public function isValidCategorie($donnees){
        if(isset($donnees['nom']) && !empty($donnees['nom'])){
            return true;
        }
        else{
            return false;
        }
    }

    // get Form Categorie
    public function getFormUpdateCategorie(){
        if(isset($_SESSION['ADMIN'])){
            ob_start();
            require 'views/navbar.php';
            require 'views/categories/formCategorie.php';
            $vue = ob_get_clean();
            return $vue;
        } else {
            $_SESSION['error'] = '<p class="alert alert-danger">Vous n\'avez pas le droit d\'acceder à cette page.🛑</p>';
        }

    }


    public function updateCategorie($formulaire, $id_marque){
        if(isset($_SESSION['ADMIN'])){
            if($this->isValidCategorie($formulaire)){
                if($this->editCategorie($formulaire, $id_marque) > 0){
                    header('Location: index.php?page=home');
                }
                else{
                    echo '<p>Une erreur est survenue lors de la mise à jour</p>';
                }
            }
            else{
                echo '<p>Formulaire invalide</p>';
            }
        } else {
            $_SESSION['error'] = '<p class="alert alert-danger">Vous n\'avez pas le droit d\'acceder à cette page.🛑</p>';
        }
    }

    // Delete Categorie
    public function deleteCategorie($id_marque){
        if(isset($_SESSION['ADMIN'])){
            if($this->del($id_marque) > 0){
                header('Location: index.php?page=home');
            }
            else{
                echo '<p>Marque introuvable</p>';
            }
        } else {
            $_SESSION['error'] = '<p class="alert alert-danger">Vous n\'avez pas le droit d\'acceder à cette page.🛑</p>';
        }
    }

}