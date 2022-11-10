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
        <a href="?page=addProduct&categorieId=<?=$_GET['id'] ?>">Ajouter un nouveau livre</a>
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
                        <a href="?page=deleteProduct&id=<?= $p['id'] ?>&categorieId=<?= $p['categorie'] ?>">Supprimer</a>
                        <a href="?page=updateProduct&id=<?= $p['id'] ?>">Modifier</a>
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

