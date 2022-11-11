
<?php
if(!empty($users)){
    ?>
    <div class="listOfUsersBody">
        <h1>Liste des utilisateurs</h1>
        <h2>Vous pouvez rendre des utilisateurs ADMIN ou NON ADMIN </h2>
        <div class="listOfUsersContainer">
            <?php
            foreach ($users as $u){
                $role = 'ADMIN';
                $font = '';
                $icon ='';
                if($u['role'] == 'ADMIN'){
                    $role = 'normal';
                    $font = 'font-weight: bold';
                    $icon = 'fa fa-star';
                }
                ?>
                    <div style='<?= $font ?>' class="userCard">
                        <p>Email : <?= $u['email'] ?> |</p>
                        <p>Rôle : <?= $u['role'] ?> |</p>
                        <a href="?page=updateRole&userId=<?= $u['id'] ?>&role=<?= $role ?>">Rendre l'utilisateur <?= $role ?></a>
                        <i class="<?= $icon ?>"></i>
                    </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
} else {
    ?>
        <h1>Il n'y a aucun utilisateur.🥲</h1>
    <?php
}




