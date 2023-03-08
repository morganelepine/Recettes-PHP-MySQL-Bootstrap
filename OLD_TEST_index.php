$query = "SELECT title, recipe FROM recipes WHERE title LIKE '%$searchContent%' OR recipe LIKE '%$searchContent%'";


<!-- CONNEXION A MYSQL -->
<?php
    $servername = 'localhost';
    $username = 'root';
    $password = 'root';
    //On essaie de se connecter
    try {
        $connexion = new PDO("mysql:host=$servername;dbname=my_recipes", $username, $password);
        //On définit le mode d'erreur de PDO sur Exception
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo 'Connexion réussie';

        $sqlQuery1 = "INSERT INTO recipes(title, recipe, author, is_enabled)
        VALUES('Ginger in the breeze','6 cl. Rhum blanc \n 1,5 cl. Liqueur de cerise \n 12 cl. Jus d\'\oranges fraîches \nGinger ale (Canada Dry) pour compléter\n', 'Morgane Lépine Utter', 1)";
        $connexion->exec($sqlQuery1);
        
        // création de la requête
        $sqlQuery2 = "SELECT * FROM recipes";
        // envoi de la requête et récupération du résultat
        $listRecipes = $connexion->query($sqlQuery2)->fetchAll();
        
    }
    //On capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci
    catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,900;1,300;1,400&display=swap" rel="stylesheet">    <title>Ceci est une page de test <?php /*Code PHP*/ ?></title>
</head>

<body>

<div class="container"> <!-- container-fluid pour enlever les marges horizontales appliquées par défaut -->

<div class="row">

    <!-- MENU DE LA PAGE HEADER.PHP -->
    <?php include('header.php'); ?>

    <!-- CONTENU DE LA PAGE -->
    <h1>Liste des recettes de cuisine</h1>

    <!-- INCLUSION DES VARIABLES ET DES FONCTIONS -->
    <?php
        include_once('_variables.php');
        include_once('_functions.php');
    ?>
    <div class="container">

    <?php foreach($listRecipes as $recipe) : ?>
            <article>
                <h3><?php echo $recipe['title']; ?></h3>
                <div><?php echo $recipe['recipe']; ?></div>
                <i><?php echo $recipe['author']; ?></i>
            </article>
        <?php endforeach ?>
    </div>
    
    <?php foreach(getRecipes($recipes) as $recipe) : ?>
            <article>
                <h3><?php echo $recipe['title']; ?></h3>
                <div><?php echo $recipe['recipe']; ?></div>
                <i><?php echo displayAuthor($recipe['author'], $users); ?></i>
            </article>
        <?php endforeach ?>
    </div>

    <!-- FOOTER DE LA PAGE FOOTER.PHP -->
    <?php include('footer.php'); ?>

    <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</div>

</div>

</body>

</html>


<?php
    /*
    // création d'une requête pour ajouter une recette
    $sqlQueryInsert = 'INSERT INTO recipes (title, recipe, author, is_enabled)
        VALUES ("Kir royal", "Champagne \nCrème de cassis", "Morgane Lépine Utter", 1)';
    $connexion -> exec($sqlQueryInsert);
    */
    
    /*
    // création d'une requête pour ajouter une recette (plus visuel)
    $sqlQueryInsertDetails = 'INSERT INTO recipes (title, recipe, author, is_enabled)
        VALUES (:title, :recipe, :author, :is_enabled)';
    $insertRecipe = $connexion -> prepare($sqlQueryInsertDetails);
    $insertRecipe -> execute([
        'title' => 'Mojito',
        'recipe' => '4 cl. Rhum blanc <br> 2 cl. Sirop de canne <br> 1/2 Citron vert <br>
            8 feuilles de menthe fraîche <br> Eau gazeuse <br> Glace pilée',
        'author' => 'Morgane Lépine Utter',
        'is_enabled' => 1,
    ]);
    */

    /*
    // création d'une requête pour supprimer une recette
    $sqlQueryDelete = 'DELETE FROM recipes WHERE title = "Kir royal" ';
    $connexion -> exec($sqlQueryDelete);
    */

    /*
    // création d'une requête pour modifier une recette
    $sqlQueryUpdate = 'UPDATE recipes SET recipe="9 cl. Champagne \n2 cl. Crème de cassis"
        WHERE title = "Kir royal" ';
    $connexion->exec($sqlQueryUpdate);
    */

?>