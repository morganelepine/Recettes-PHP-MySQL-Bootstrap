<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes recettes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
        crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <!-- <link href="/dist/output.css" rel="stylesheet"> -->
</head>
    
<body class="text-center pt-5">

    <div class="container justify-content-center">

    <!-- MENU DE LA PAGE HEADER.PHP -->
    <?php include_once('0.header.php'); ?>

    <?php
    //Connexion à la BDD
    $connexion = new mysqli("localhost", "root", "root", "my_recipes");

    //Si le bouton de la barre de recherche est cliqué
    $search = isset($_GET["submit"]);
    if ($search) {
        //Sécuriser le formulaire contre les failles html
        //$_GET["search"] = htmlspecialchars($_GET["search"]);

        //Stocker le contenu de la recherche dans une variable
        $searchContent = $_GET["search"];

        //Sélectionner les titres et les contenus des recettes qui contiennent des mots qui ressemblent à la requête de l'internaute
        //$query = "SELECT title, recipe FROM recipes WHERE title LIKE '%$searchContent%' OR recipe LIKE '%$searchContent%'";
        $query = "SELECT recipes.id as recipe_id,
                    recipes.title,
                    recipes.recipe,
                    recipes.author,
                    users.id as author_id,
                    recipes.image,
                    COUNT(likes.id) as like_number,
                    GROUP_CONCAT(DISTINCT tags.label) AS tag_list,
                    GROUP_CONCAT(DISTINCT tags.id) AS tag_id,
                    GROUP_CONCAT(DISTINCT tags.type) AS tag_type
            FROM recipes
            JOIN users ON users.id = recipes.user_id
            LEFT JOIN recipes_tags ON recipes.id = recipes_tags.recipe_id
            LEFT JOIN tags         ON recipes_tags.tag_id = tags.id
            LEFT JOIN likes        ON likes.recipe_id = recipes.id
            WHERE recipes.title LIKE '%$searchContent%' OR recipes.recipe LIKE '%$searchContent%'
            GROUP BY recipes.id
            ORDER BY recipes.id
            ";
        $searchQuery = $connexion->query($query);
        if (! $searchQuery) {
            echo "Échec de la requete : " . $connexion->error;
        }
    }
    ?>

    <!-- CONTENU DE LA PAGE -->
    <h1 class="mt-5 text-white fw-bold">Résultat de votre recherche</h1>
    <h3 class="text-white font-italic">"<?php echo $searchContent ?>"</h3>

    <?php include_once('4.recipe_query.php'); ?>

    <div class="container">

        <div class="container">

            <div class="row justify-content-center">

                <?php
                while ($listRecipes = $searchQuery->fetch_assoc()) {
                    $recipeId = $listRecipes['recipe_id'];
                    $recipeTitle = $listRecipes['title'];
                    $recipeContent = $listRecipes['recipe'];
                    $recipeAuthor = $listRecipes['author'];
                    $recipeImage = $listRecipes['image'];
                    $recipeLikes = $listRecipes['like_number'];
                    $tags = explode(',', $listRecipes['tag_list']); // Divisez la chaîne de caractères en un tableau
                    $tagId = explode(',', $listRecipes['tag_id']);
                    $tagIdReverse = array_reverse($tagId);
                    $tag_type = explode(',', $listRecipes['tag_type']);
                ?>

                <div class="d-flex flex-column align-content-between col-sm-3 rounded bg-light bg-opacity-75 m-3 p-3">
                    <?php include('4.recipe.php'); ?>
                </div>
            
                <?php } //$searchQuery->closeCursor(); ?>

            </div>

        </div>

    </div>

</body>
