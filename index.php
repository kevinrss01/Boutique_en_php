
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
            unset($_SESSION['error']);
        }


        if(isset($_SESSION['valid'])){
            echo $_SESSION['valid'];
            unset($_SESSION['valid']);
        }

        // If not ADMIN access to action is denied
        if(isset($_SESSION['ADMIN'])){
            if(isset($_GET['action'])){
                $action = $_GET['action'];
            }
            else{
                $action = null;
            }
        }

        if(isset($_SESSION['logged'])){ //If logged
            if(isset($_GET['page'])){
                switch ($_GET['page']) {
                    case 'home':
                        $ctrl = new CategoriesController();
                        echo $ctrl->getCategoriesPage();
                        break;
                    case 'logout':
                        $ctrl = new UserController();
                        echo $ctrl->logout();
                        break;
                    case 'listOfUsers':
                        $ctrl = new UserController();
                        echo $ctrl->findAllUsers();
                        break;
                    case 'updateRole':
                        $ctrl = new UserController();
                        echo $ctrl->updateUserRole($_GET['userId'], $_GET['role']);
                        break;
                    case 'categories': //////CATEGORIES
                        $ctrl = new CategoriesController();
                        // If not ADMIN access to action is denied
                        switch ($action){
                            case 'addCategorie':
                                $ctrl = new CategoriesController();
                                if(!empty($_POST)){
                                    echo $ctrl->addCategorie($_POST);
                                }
                                else{
                                    echo $ctrl->getFormAddCategorie();
                                }
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
                            case 'updateCategorie':
                                $ctrl = new CategoriesController();
                                if(isset($_GET['id']) && !empty($_GET['id'])){
                                    // If form was sent
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
                            default:
                                // INDEX
                                header('Location: index.php?page=home');
                                $_SESSION['error'] = '<p class="alert alert-danger">Vous n\'avez pas le droit d\'acceder à cette page.🛑</p>';
                                break;
                        }
                        break;
                    case 'homeProducts': ///////PRODUCTS ⬇️⬇️
                        $ctrl = new ProductsController();
                        echo $ctrl->getProducts($_GET['id']);
                        break;
                    case 'products':
                        $ctrl = new CategoriesController();
                        // If not ADMIN access to action is denied
                        switch ($action){
                            case 'addProduct':
                                $ctrl = new ProductsController();
                                if(!empty($_POST)){
                                    echo $ctrl->insertProduct($_POST);
                                }
                                else{
                                    echo $ctrl->getFormAddProduct();
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
                            default:
                                // INDEX
                                header('Location: index.php?page=home');
                                break;
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/bb3aa8f2a8.js" crossorigin="anonymous"></script>
    <link href="./style.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title></title>
</head>