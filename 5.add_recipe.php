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

    <!-- CONTENU DE LA PAGE -->
    <h1 class="m-5 text-white fw-bold">Ajouter une recette</h1>

    <?php
    //Connexion à la base de donnée
    include_once('_connexion.php');
        
    // Si le formulaire est soumis :
    $enCoursDeTraitement = isset($_POST['submit']);
    if ($enCoursDeTraitement) {

        //--------IMAGE
        $photo_name = $_FILES['photo']['name'];
        $dossier_temporaire = $_FILES['photo']['tmp_name']; //tmp_name = chemin où l'image se trouve de façon temporaire
        $dossier_site = './images/'.$photo_name;
        $deplacer = move_uploaded_file($dossier_temporaire, $dossier_site);

        /*$max_size = 1000000;
        $file_size = filesize($dossier_temporaire);
        if ($file_size > $max_size) {
            echo "Fichier trop volumineux";
        } else {
            echo "Fichier de taille correcte";
        }*/
        
        //Stocker l'image dans la BDD
        /*
        if ($deplacer) {
            echo "Ton image a bien été importée. <br>";
            //$sql = "INSERT INTO recipes VALUES (NULL, '$user_idactuel', '$new_recipe_name', '$new_recipe', '$user_name')"
        } else {
            echo "Ton image n'a pas été importée. <br>";
        }*/
        

        //--------RECETTE
        $new_recipe_name = $_POST['name_recipe'];
        $new_recipe = $_POST['recipe'];
            // + sécurité pour éviter les injection SQL
            $new_recipe_name = $connexion->real_escape_string($new_recipe_name);
            $new_recipe = $connexion->real_escape_string($new_recipe);
        
        //Récupérer le prénom de l'utilisateur
        $querySQL = "SELECT user_name FROM users WHERE id = $user_idactuel";
        $queryOK = $connexion->query($querySQL);
        while ($name = $queryOK->fetch_assoc()) {
            $user_name = $name['user_name'];
    
            //Construction de la requete
            $sqlQuery = "INSERT INTO recipes VALUES (NULL, '$user_idactuel', '$new_recipe_name', '$new_recipe', '$user_name', '$photo_name') ";
                                           //VALUES (id, user_id, title, recipe, author, image)
    
            //Exécution de la requete
            $connexionIsOk = $connexion->query($sqlQuery);
            if ($connexionIsOk && $deplacer) {
                echo "<p class='pb-3'>Merci " . $user_name . ", votre recette '" . $new_recipe_name . "' a bien été ajoutée à la base de recettes ! </p>";
            } else {
                echo "Votre recette n'a pas été ajoutée à la base de recettes : " . $connexion->error;
            }

            include('8.tags.php');
        }

    }
    ?>

    <!-- L'attribut et la valeur enctype='multipart/form-data' permettent au formulaire d'ajouter des données binaires, ici une image -->
    <form action="5.add_recipe.php" method="post" id="add_recipe" class="container" enctype="multipart/form-data">

        <input type='hidden' name='id' value='$new_recipe'>

        <div class="row justify-content-center">
            <div class="col-md-6 mb-3">
                <!-- <label for='name_recipe' class="pb-3">Nom de la recette</label> -->
                <input type='text' name='name_recipe' placeholder="Le titre de votre recette" class="form-control mb-4">
                <!-- <label for='recipe' class="pb-3">Contenu de la recette</label> -->
                <textarea name='recipe' placeholder="Votre recette" class="form-control mb-2" rows="3" aria-describedby="aideRecette"></textarea>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6 mb-3">
                <!-- <label for='photo_recipe' class="pb-3">Photo de la recette</label> -->
                <input type="hidden" name="MAX_SIZE_FILE" value="5000000">
                <input type="file" name='photo'>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-6 mb-3">
                <small class="form-text" id="aideRecette">Merci de respecter la synthaxe utilisée pour les autres recettes <br>
                    ("cl.", majuscule au premier mot, retour à la ligne après chaque ingrédient) <br>
                    par exemple : <br>
                    9 cl. Champagne <br>
                    2 cl. Crème de cassis
                </small>
            </div>
        </div>

        <button class="btn btn-danger" name="submit" type='submit'>Envoyer</button>

    </form>

</body>
</html>
