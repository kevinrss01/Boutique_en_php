<?php
if(isset($_SESSION['ADMIN'])){
    ?>
    <div id="bodyForm">
        <?php
        $value = 'Ajouter';
        $inputValue = '';
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $value = 'Modifier';
            echo '<h1>Modifier une catégorie</h1>';
        }
        else{
            echo '<h1>Ajouter une catégorie</h1>';
        }
        ?>

        <form action="" method="POST" class="form">
            <label for="nom">Nom de la catégorie : </label>
            <input type="text" name="nom" id="nom">
            <br>
            <input type="submit" name="ajouter">
        </form>
    </div>

    <?php
}
?>


<?php


