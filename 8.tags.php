<?php
    //Connexion à la base de données
    $connexion = new mysqli("localhost", "root", "root", "my_recipes");

    //Sortir la dernière recette
    $querySQL = "SELECT * FROM recipes ORDER BY id DESC LIMIT 1";
    $lastRecipe = $connexion->query($querySQL)->fetch_assoc();
    $recipe_id = $lastRecipe['id'];
    $recipe = $lastRecipe['recipe'];
    
    //Sortir tous les tags
    $sqlTagsQuery = "SELECT id, label FROM tags";
    $listOfTags = $connexion->query($sqlTagsQuery);
    
    while ($tags = $listOfTags->fetch_assoc()) {
        $tag_id = explode(',', $tags["id"]);
        $tag_label = explode(',', $tags["label"]);

        foreach ($tag_label as $key => $tag) {
            //$tag = strtolower($tag);
            //S'il y a un tag dans la recette :
            if (strpos($recipe, $tag)) {
                //Ajouter la recette/le tag dans la table "recipes_tags"
                $insertTagQuery = "INSERT INTO recipes_tags VALUES (NULL, '$recipe_id', '$tag_id[$key]') ";
                $okQuery = $connexion->query($insertTagQuery);
                if (! $okQuery) {
                    echo "Impossible d'intégrer le tag à la base de données : " . $connexion->error;
                }
            }
        }
    }
?>