<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSS only -->
        <link href="./style.css" rel="stylesheet" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title></title>
    </head>
<?php
include_once './Class/BDD.php';
include_once './Models/UserManager.php';
include_once './Controllers/UserController.php';
include_once './Models/CategoriesManager.php';
include_once './Controllers/CategoriesController.php';
include_once './Models/ProductsManager.php';
include_once './Controllers/ProductsController.php';
?>

        <?php
        session_start();

        if(isset($_SESSION['error'])){
            echo $_SESSION['error'];
            unset($_SESSION['error']); // Supprime une cellule de tableau
        }

        if(isset($_SESSION['valid'])){
            echo $_SESSION['valid'];
            unset($_SESSION['valid']);
        }

        if(isset($_SESSION['ADMIN'])){
            echo 'vous êtes admin';
        }


        if(isset($_SESSION['logged'])){ //If logged
            if(isset($_GET['page'])){
                switch ($_GET['page']) {
                    case 'home':
                        $ctrl = new CategoriesController();
                        echo $ctrl->getCategoriesPage();
                        break;
                    case 'deleteCategorie':
                        $ctrl = new CategoriesController();
                        if(isset($_GET['id']) && !empty($_GET['id'])){
                            $ctrl->deleteCategorie($_GET['id']);
                        }
                        else{
                            echo '<p>Marque introuvable</p>';
                        }
                        break;
                    case 'logout':
                        $ctrl = new UserController();
                        echo $ctrl->logout();
                        break;
                    case 'addCategorie':
                        $ctrl = new CategoriesController();
                        if(!empty($_POST)){
                            echo $ctrl->addCategorie($_POST);
                        }
                        else{
                            echo $ctrl->getFormAddCategorie();
                        }
                        break;
                    case 'updateCategorie':
                        $ctrl = new CategoriesController();
                        if(isset($_GET['id']) && !empty($_GET['id'])){
                            // Si le formulaire de maj a été soumis
                            if(!empty($_POST)){
                                echo $ctrl->updateCategorie($_POST, $_GET['id']);
                            }
                            // Get update Form
                            else{
                                echo $ctrl->getFormUpdateCategorie();
                            }
                        }
                        else{
                            echo '<p>Marque introuvable</p>';
                        }
                        break;
                    case 'homeProducts': ///////PRODUCTS ⬇️⬇️
                        $ctrl = new ProductsController();
                        echo $ctrl->getProducts($_GET['id']);
                        break;
                    case 'addProduct':
                        if(isset($_SESSION['ADMIN'])){
                            $ctrl = new ProductsController();
                            if(!empty($_POST)){
                                echo $ctrl->insertProduct($_POST);
                            }
                            else{
                                echo $ctrl->getFormAddProduct();
                            }
                        } else {
                            header('Location: index.php?page=home');
                            $_SESSION['error'] = '<p class="alert alert-danger">Vous n\'avez pas le droit d\'acceder à cette page.🛑</p>';
                        }
                        break;
                    case 'updateProduct':
                        $ctrl = new ProductsController();
                        if(isset($_GET['id']) && !empty($_GET['id'])){
                            if(!empty($_POST)){
                                echo $ctrl->updateProduct($_POST, $_GET['id']);
                            }
                            else{
                                echo $ctrl->getFormUpdateProduct($_GET['id']);
                            }
                        }
                        else{
                            echo '<p>Modele introuvable</p>';
                        }
                        break;
                    case 'deleteProduct':
                        $ctrl = new ProductsController();
                        if(isset($_GET['id']) && !empty($_GET['id'])){
                            echo $ctrl->deleteProduct($_GET['id'], $_GET['categorieId']);
                        }
                        else{
                            echo '<p>Modele introuvable</p>';
                        }
                        break;
                    default:
                        // INDEX
                        header('Location: index.php?page=home');
                        break;
                }
            }
            else{
                // 404 => Redirection
                header('Location: index.php?page=home');

            }
        } else { // IF NOT LOGGED
            echo 'NOT CONNECTED';
            if(isset($_GET['page'])){
                switch ($_GET['page']) {
                    case 'registration': // ?page=registration
                        $ctrl = new UserController();
                        if(!empty($_POST)){
                            echo $ctrl->registration($_POST);
                        }
                        else{
                            echo $ctrl->getForm();
                        }
                        break;
                    case 'login': //LOGIN
                        $ctrl = new UserController();
                        if(!empty($_POST)){
                            echo $ctrl->login($_POST);
                        } else {
                            echo $ctrl->getFormLogin();
                        }
                        break;
                    default:
                        // INDEX
                        header('Location: index.php?page=registration');
                        break;
                }
            }
            else{
                // 404
                header('Location: index.php?page=registration');
                echo '<h1>404</h1>';
                echo '<p>Page introuvable</p>';
            }
        }

        ?>
</html>