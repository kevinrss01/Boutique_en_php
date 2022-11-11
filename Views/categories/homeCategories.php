<div id="categories">
    <header>
        <h1>Categories des livres</h1>
        <?php
        if(isset($_SESSION['ADMIN'])){
            ?>
            <a href="?page=categories&action=addCategorie">Ajouter une nouvelle catégorie</a>
            <?php
        }
        ?>
    </header>
    <main>
        <?php
        if(!empty($categories)){
            foreach ($categories as $c){
                ?>
                <div class="categorieCard">
                    <h1><?= $c['nom'] ?></h1>
                    <?php
                    if(isset($_SESSION['ADMIN'])){
                        ?>
                        <a href="?page=categories&action=deleteCategorie&id=<?= $c['id'] ?>">Supprimer</a>
                        <a href="?page=categories&action=updateCategorie&id=<?= $c['id'] ?>">Modifier</a>
                        <?php
                    }
                    ?>
                    <a href="?page=homeProducts&id=<?= $c['id'] ?>">Voir les livres de la catégorie</a>
                </div>

                <?php
            }
        } else {
            echo "Aucune catégorie n'a été trouver. 🥲";
        }
        ?>
    </main>
    <footer>

    </footer>
</div>










