<?php
$title = 'Ajouter';
if(isset($product)){
    $btn = 'Mettre à jour';
    $title = 'Modifier';
}
if(isset($_SESSION['ADMIN'])){
    ?>
    <div id="bodyForm">
        <h1><?= $title ?> un produit dans la categorie</h1>
        <form action="" method="POST" class="form">
            <label for="nom">Nom : </label>
            <input type="text" name="nom" id="nom"
                <?php
                $btn = 'Ajouter';
                if(isset($product)){
                    $btn = 'Mettre à jour';
                    echo 'value="'.$product['nom'].'"';
                }
                ?>
            >
            <br>
            <label for="description">Description</label>
            <textarea type="text" name="description" id="description"><?php if(isset($product)){echo $product['description'];} ?></textarea>
            <br>
            <label for="quantité">Quantité : </label>
            <input type="number" name="quantité" id="quantité"
                <?php
                if(isset($product)){
                    echo 'value="'.$product['quantité'].'"';
                }
                ?>
            >
            <br>
            <label for="prix">Prix : </label>
            <input type="number" name="prix" id="prix"
                <?php
                if(isset($product)){
                    echo 'value="'.$product['prix'].'"';
                }
                ?>
            >
            <br>
            <label for="categorie">Categorie : </label>
            <select name="categorie" id="categorie">
                <?php
                foreach($categories as $c){
                    ?>
                    <option value="<?= $c['id']; ?>"
                        <?php
                        if(isset($product) && $c['id'] == $product['categorie']){
                            echo 'selected';
                        }
                        ?>
                    ><?= $c['nom']; ?></option>
                    <?php
                }
                ?>
            </select>
            <br>
            <input type="submit" name="envoyer" value="<?= $btn; ?>">
        </form>
    </div>

    <?php
} else {
    echo "Vous n'êtes pas autorisé à acceder à ce contenu";
}
?>
