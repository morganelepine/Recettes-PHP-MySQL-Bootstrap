<?php $user_idactuel = $_SESSION['connected_id'] ?>

<?php

    //Connexion à la BDD
    $connexion = new mysqli("localhost", "root", "root", "my_recipes");

    
    //Vérifier si le bouton est cliqué
    $enCoursDeTraitement = isset($_POST[$recipeId]);
    
    //Si le bouton "J'aime" est cliqué :
    if ($enCoursDeTraitement) {

        //Envoyer le like dans la BDD
        $sqlQuery = "INSERT INTO likes VALUES (NULL, '$user_idactuel', '$recipeId')";
        
        //Si le bouton "Je n'aime plus" est cliqué, retirer le like de la BDD
        if ($_POST["action"] == "dislike") {
            $sqlQuery = "DELETE FROM likes WHERE user_id = $user_idactuel AND recipe_id = $recipeId";
        }

        //Exécuter la requête
        $queryOk = $connexion->query($sqlQuery);
        if (! $queryOk) {
            echo "Impossible de liker cette recette : " . $connexion->error;
        } else {
            header("refresh:0");
        }
    }

    //Sortir le nombre de likes par recette
    $likeQuery = $connexion->query("SELECT COUNT(*) AS count FROM likes WHERE recipe_id = $recipeId");
    if (! $likeQuery) {
        echo "Échec de la requete : " . $connexion->error;
    }
    while ($like_count = $likeQuery->fetch_assoc()) {
        $likes = $like_count['count'];
    }
?>

<!-- On vérifie s'il existe déjà un like du user dans la BDD -->
<?php
    $instructionSql = "SELECT * FROM likes WHERE user_id = $user_idactuel AND recipe_id = $recipeId";
    $ok = $connexion->query($instructionSql);
    $like = $ok->fetch_assoc();
?>

<!-- Si la personne est sortie dans la requête : bouton DISLIKE -->
<?php if ($like['user_id'] != $user_idactuel) { ?>

<form method="post">
    <input type="hidden" name="action" value="like">
    <input
        class="btn btn-outline-danger btn-sm"
        type="submit"
        data-toggle="button" aria-pressed="false" autocomplete="off"
        name="<?php echo $recipeId ?>"
        value="<?php echo $likes ?> ♥"
    >
</form>

<!-- Si la personne n'est pas sortie dans la requête : bouton LIKE -->
<?php } else { ?>

<form method="post">
    <input type="hidden" name="action" value="dislike">
    <input
        class="btn btn-outline-danger btn-sm active"
        type="submit"
        data-toggle="button" aria-pressed="true" autocomplete="off"
        name="<?php echo $recipeId ?>"
        value="<?php echo $likes ?> ♥"
    >
</form>

<!-- Fermeture de la boucle IF/ELSE -->
<?php } ?>