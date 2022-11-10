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

                //Set Session
                $_SESSION['logged'] = "";
                //If ADMIN
                if($userData['role'] == 'ADMIN'){
                    $_SESSION['ADMIN'] = "";
                }

                header('Location: index.php?page=home');

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

    //LOGOUT
    public function logout(){
        unset($_SESSION['logged']);
        unset($_SESSION['ADMIN']);
        header('Location: index.php?page=registration');
    }
}