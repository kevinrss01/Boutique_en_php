<style>
<?php include 'style.css';
?>
</style>

<?php

class UserController extends UserManager
{
    //Get Register Form
    public function getForm(){
        ob_start();
        require 'views/user/registration.php';
        $vue = ob_get_clean();
        return $vue;
    }

    //Get Login Form
    public function getFormLogin(){
        ob_start();
        require 'views/user/login.php';
        $vue = ob_get_clean();
        return $vue;
    }

    //Login
    public function login($formulaire){
        if($this->isValid($formulaire)){
            if($this->getUser($formulaire) == true){
                //User Found
                $userData = $this->getAllUserDAta($formulaire);
                echo '<p class="validForm">Vous êtes bien connecté.</p>';
                echo '<p>'.$userData['email'].'</p>';

                //Set Cookie
                $cookie_name1 = "email";
                $cookie_value1 = $userData['email'];
                $cookie_name2 = "role";
                $cookie_value2 = $userData['role'];
                setcookie($cookie_name1, $cookie_value1, time() + (86400 * 30), "/");
                setcookie($cookie_name2, $cookie_value2, time() + (86400 * 30), "/");

                if(!isset($_COOKIE[$cookie_name1])) {
                    echo "Cookie named '" . $cookie_name1 . "' is not set!";
                } else {
                    echo "Cookie '" . $cookie_name1 . "' is set!<br>";
                }

                if(!isset($_COOKIE[$cookie_name2])) {
                    echo "Cookie named '" . $cookie_name1 . "' is not set!";
                } else {
                    echo "Cookie '" . $cookie_name2 . "' is set!<br>";
                }

            } else {
                //Incorrect email or password
                $_SESSION['error'] = '<p class="alert alert-danger">Email ou mot de passe invalide</p>';
                header('Location: index.php?page=login');
            }
        } else {
            //invalid form
            $_SESSION['error'] = '<p class="alert alert-danger">Formulaire invalide</p>';
            header('Location: index.php?page=login');
        }
    }

    //Send user Data to register
    public function registration($formulaire){
        if($this->isValid($formulaire)){
            if($this->insertUser($formulaire) > 0){
                //Account created
                $_SESSION['valid'] = '<p class="validForm">Compte créer avec succès ! Veuillez vous connectez.</p>';
                header('Location: index.php?page=login');



            } else {
                //Request error
                echo '<p>Une erreur est survenue lors de l\'inscription</p>';
            }
        } else {
            //invalid form
            $_SESSION['error'] = '<p class="alert alert-danger">Formulaire invalide</p>';
            header('Location: index.php?page=registration');
        }

    }

    //Check if the form is valid
    public function isValid($donnees){
        if(isset($donnees['email']) && !empty($donnees['password'])){
            return true;
        }
        else{
            return false;
        }
    }
}