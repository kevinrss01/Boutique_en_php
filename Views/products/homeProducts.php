<body id="books">
    <header>
        <?php
        $categorieName = '';
        foreach($categories as $c){
            foreach ($products as $p){
                if ($c['id'] == $p['categorie']){
                    $categorieName = $c['nom'];
                }
            }
        }
        ?>
        <h1>Livre de la catégorie <?= $categorieName ?></h1>
        <?php
        if(isset($_SESSION['ADMIN'])){
            ?>
            <a href="?page=products&action=addProduct&categorieId=<?=$_GET['id'] ?>">Ajouter un nouveau livre</a>
            <?php
        }
        ?>
    </header>
    <main>
        <?php
        if(!empty($products)){
            foreach ($products as $p){
                ?>
                <div class="bookCard">
                    <div class="infoBook">
                        <h1><?= $p['nom'] ?></h1>
                        <h1>Prix : <?= $p['prix'] ?>€</h1>
                    </div>

                    <div class="infoBook2">
                        <strong>
                            <p>Information supplémentaire :</p>
                        </strong>
                        <p>Description : <?= $p['description'] ?></p>
                        <p>Quantité restante : <?= $p['quantité'] ?></p>
                    </div>

                    <div class="link">
                        <?php
                        if(isset($_SESSION['ADMIN'])){
                        ?>
                        <a href="?page=products&action=deleteProduct&id=<?= $p['id'] ?>&categorieId=<?= $p['categorie'] ?>">Supprimer</a>
                        <a href="?page=products&action=updateProduct&id=<?= $p['id'] ?>">Modifier</a>
                        <?php
                    }
                    ?>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "Il n'y aucun livre dans cette categorie. 🥲";
        }
        ?>
    </main>
    <footer>

    </footer>
</body>

