<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSS only -->
        <link href="./style.css" rel="stylesheet" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title>Registration</title>
    </head>
<?php
include_once './Class/BDD.php';
include_once './Models/UserManager.php';
include_once './Controllers/UserController.php';
include_once './Models/CategoriesManager.php';
include_once './Controllers/CategoriesControler.php';

?>
<body>
    <main>
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

        if(!isset($_COOKIE['email'])) { /////// IF NOT LOGGED /////////
            echo "Cookie named email is not set";
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
                    case 'login':
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

        } else { /////// IF LOGGED /////////
            echo "Email cookie is set";
            if(isset($_GET['page'])){
                switch ($_GET['page']) {
                    case 'home':
                        $ctrl = new CategoriesControler();
                        echo $ctrl->getCategories();
                        break;
                    default:
                        // INDEX
                        header('Location: index.php?page=home');
                        break;
                }
            }
            else{
                // 404
                header('Location: index.php?page=registration');

            }
        }





        ?>
    </main>
</body>
</html>