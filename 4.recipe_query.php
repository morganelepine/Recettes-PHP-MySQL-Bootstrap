<?php
//Connexion à la BDD
include_once('connexion.php');
    
//Requête pour récupérer toutes les recettes classées par ordre d'ajout à la BDD
$sqlQuery = "SELECT recipes.id as recipe_id,
                    recipes.title,
                    recipes.recipe,
                    recipes.author,
                    recipes.image,
                    users.id as author_id,
                    COUNT(likes.id) as like_number,
                    GROUP_CONCAT(DISTINCT tags.label) AS tag_list,
                    GROUP_CONCAT(DISTINCT tags.id) AS tag_id,
                    GROUP_CONCAT(DISTINCT tags.type) AS tag_type
            FROM recipes
            JOIN users ON users.id = recipes.user_id
            LEFT JOIN recipes_tags ON recipes.id = recipes_tags.recipe_id
            LEFT JOIN tags         ON recipes_tags.tag_id = tags.id
            LEFT JOIN likes        ON likes.recipe_id = recipes.id
            GROUP BY recipes.id
            ORDER BY recipes.id
            ";

$queryOK = $connexion->query($sqlQuery);
if (! $queryOK) {
    echo "Échec de la requete : " . $connexion->error;
}

//Sortir tous les tags
$tagsQuery = "SELECT * FROM tags";
$query=$connexion->query($tagsQuery);
if (! $query) {
    echo "Échec de la requete : " . $connexion->error;
}

$tags_id_label = [];
$tags_id_type = [];
$tagsFromDB = $query->fetch_all();
foreach ($tagsFromDB as $tag) {
    $tags_id_label[$tag[0]] = $tag[1];
    $tags_id_type[$tag[0]] = $tag[2];
}

?>
