<?php

class ProductsController extends ProductsManager
{
    //Get all the products from a categorie
    public function getProducts($id_categorie){

        ob_start();

        $manager = new CategoriesManager();
        $categories = $manager->findAllCategories();
        $products = $this->findByCategorie($id_categorie);

        require 'views/navbar.php';
        require 'views/products/homeProducts.php';

        $vue = ob_get_clean();
        return $vue;

    }

    //Get update/add form
    public function getFormAddProduct(){
        if(isset($_SESSION['ADMIN'])){
            ob_start();

            $manager = new CategoriesManager();
            $categories = $manager->findAllCategories();
            require 'views/navbar.php';
            require 'views/products/formProduct.php';

            $page = ob_get_clean();

            return $page;
        } else {
            $_SESSION['error'] = '<p class="alert alert-danger">Vous n\'avez pas le droit d\'acceder à cette page.🛑</p>';
        }


    }

    //Add product in database
    public function insertProduct($formulaire){
        if(isset($_SESSION['ADMIN'])){
            if($this->isValidProductForm($formulaire)){
                if($this->insert($formulaire)){
                    header('Location: index.php?page=homeProducts&id=' . $formulaire['categorie']);
                    $_SESSION['valid'] = '<p class="validForm">Livre bien ajouté dans la catégorie !</p>';
                }
                else{
                    $_SESSION['error'] = '<p class="alert alert-danger">Formulaire invalide</p>';
                    echo '<p>Une erreur est survenue lors de l\'ajout du modèle</p>';
                }
            }
            else{
                echo '<p>Formulaire invalide</p>';
                $_SESSION['error'] = '<p class="alert alert-danger">Formulaire invalide</p>';
            }
        } else {
            $_SESSION['error'] = '<p class="alert alert-danger">Vous n\'avez pas le droit d\'acceder à cette page.🛑</p>';
        }

    }

    //Get Form Update Product
    public function getFormUpdateProduct($product_id){
        if(isset($_SESSION['ADMIN'])){
            ob_start();

            $product = $this->findOneProductById($product_id);
            $manager = new CategoriesManager();
            $categories = $manager->findAllCategories();
            require 'views/navbar.php';
            require 'views/products/formProduct.php';
            $page = ob_get_clean();

            return $page;
        } else {
            $_SESSION['error'] = '<p class="alert alert-danger">Vous n\'avez pas le droit d\'acceder à cette page.🛑</p>';
        }

    }


//Update Product
    public function updateProduct($formulaire, $product_id){
        if(isset($_SESSION['ADMIN'])){
            if($this->isValidProductForm($formulaire)){
                if($this->majProduct($formulaire, $product_id) > 0){
                    $_SESSION['valid'] = '<p class="validForm">Livre modifié !🎉</p>';
                    header('Location: index.php?page=homeProducts&id=' . $formulaire['categorie']);
                }
                else{
                    header('Location: index.php?page=products&action=updateProduct&id=' . $product_id);
                    $_SESSION['error'] = '<p class="alert alert-danger">Une erreur est survenu lors de la mise à jour, veuillez réessayer.</p>';
                }
            }
            else{
                echo '<p>Formulaire invalide</p>';
            }
        } else {
            $_SESSION['error'] = '<p class="alert alert-danger">Vous n\'avez pas le droit d\'acceder à cette page.🛑</p>';

        }

    }

    //Delete Product
    public function deleteProduct($product_id, $categorie_id){
        if(isset($_SESSION['ADMIN'])){
            if($this->delProduct($product_id) > 0){
                header('Location: index.php?page=homeProducts&id=' . $categorie_id);
                $_SESSION['valid'] = '<p class="validForm">Livre supprimé !🎉</p>';
            }
            else{
                echo '<p>Une erreur est survenue lors de la suppression du produit</p>';
            }
        } else {
            $_SESSION['error'] = '<p class="alert alert-danger">Vous n\'avez pas le droit d\'acceder à cette page.🛑</p>';
        }
    }

    public function isValidProductForm($donnees){
        if(
            isset($donnees['nom']) && !empty($donnees['nom'])
            &&
            isset($donnees['description']) && !empty($donnees['description'])
            &&
            isset($donnees['quantité']) && !empty($donnees['quantité'])
            &&
            isset($donnees['prix']) && !empty($donnees['prix'])
            &&
            isset($donnees['categorie']) && !empty($donnees['categorie'])
        ){
            return true;
        }
        else{
            return false;
        }
    }
}