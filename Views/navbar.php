<div class="navbarContainer">
    <h2 class="title"><a href="?page=home">Boutique de livre</a></h2>
    <div>
        <?php
        if(isset($_SESSION['ADMIN'])){
            ?>
                <a href="?page=listOfUsers">Liste des utilisateurs</a>
            <?php
        }
        ?>
    </div>
    <a href="?page=logout">
        Se déconnecter
    </a>
</div>

<?php
