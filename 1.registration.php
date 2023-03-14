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

<div class="container">

    <!-- MENU DE LA PAGE HEADER.PHP -->
    <?php include_once('0.header.php'); ?>

    <!-- CONTENU DE LA PAGE -->
    <h1 class="m-5 text-white display-1 fw-bold">Inscription</h1>

    <?php
    //Traitement du formulaire
    $enCoursDeTraitement = isset($_POST['email']);

    // Si le formulaire est soumis :
    if ($enCoursDeTraitement) {
        //Récupérer ce qu'il y a dans le formulaire
        $new_name = $_POST['pseudo'];
        $new_email = $_POST['email'];
        $new_password = $_POST['mdp'];

        //Connexion à la base de donnée
        include_once('_connexion.php');

        //Sécurité pour éviter les injection SQL
        $new_name = $connexion->real_escape_string($new_name);
        $new_email = $connexion->real_escape_string($new_email);
        $new_password = $connexion->real_escape_string($new_password);
        
        //md5 crypte le mot de passe (pédagogique mais pas recommandé pour une vraie sécurité)
        $new_password = md5($new_password);

        //Construction de la requete
        $sqlQuery = "INSERT INTO users VALUES (NULL, '$new_name', '$new_email', '$new_password') ";
            //VALUES = user_id, user_name, email, password

        //Exécution de la requete
        $connexionIsOk = $connexion->query($sqlQuery);
        if (! $connexionIsOk) {
            echo "L'inscription a échoué : " . $connexion->error;
        } else {
            echo "Votre inscription est un succès " . $new_name . " ! ";
            echo "<a class='btn btn-outline-danger btn-sm' href='index.php'>Connectez-vous.</a>";
        }
    }
    ?>

    <form action="./1.registration.php" method="post" class="container">
        
        <input type='hidden' name='id' value='$new_email'>
        
        <div class="row justify-content-center">
            <div class="col-md-3 mb-1">
                <label for='pseudo' class="pb-3">Pseudo</label>
                <input type='text' name='pseudo' required="required" class="form-control mb-3">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-3 mb-1">
                <label for='email' class="pb-3">E-mail</label>
                <input type='email' name='email' required="required" class="form-control mb-3">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-3 mb-1">
                <label for='mdp' class="pb-3">Mot de passe</label>
                <input type='password' name='mdp' required="required" class="form-control mb-3">
            </div>
        </div>

        <input class="btn btn-danger" type='submit'>

    </form>

    <br>

    <p>
        Vous avez déjà un compte ?
        <a class="btn btn-outline-danger btn-sm" href='./index.php'>Connectez-vous</a>
    </p>

</body>
</html>
