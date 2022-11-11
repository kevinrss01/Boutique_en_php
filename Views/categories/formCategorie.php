<?php
if(isset($_SESSION['ADMIN'])){
    ?>
    <div id="bodyForm">
        <?php
        $value = 'Ajouter';
        $inputValue = '';
        $name = '';
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $value = 'Modifier';
            $id = $_GET['id'];
            if(!empty($categories)){
                foreach ($categories as $c){
                    if($c['id'] == $id){
                        $name = $c['nom'];
                    }
                }
            }
            echo '<h1>Modifier une catégorie</h1>';
        }
        else{
            echo '<h1>Ajouter une catégorie</h1>';
        }
        ?>

        <form action="" method="POST" class="form">
            <label for="nom">Nom de la catégorie : </label>
            <input type="text" name="nom" id="nom" value="<?= $name ?>">
            <br>
            <input type="submit" name="ajouter" value="<?= $value ?>">
        </form>
    </div>

    <?php
}
?>


<?php


