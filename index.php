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
    <h1 class="m-5 text-white display-1 fw-bold">Connexion</h1>

    <?php
    //Traitement du formulaire
    $enCoursDeTraitement = isset($_POST['email']);

    //Si le formulaire a été soumis :
    if ($enCoursDeTraitement) {
        //Récupérer ce qu'il y a dans le formulaire
        $emailAVerifier = $_POST['email'];
        $passwdAVerifier = $_POST['mdp'];

        //Connexion à la base de donnée
        include_once('_connexion.php');

        //Sécurité pour éviter les injection SQL
        $emailAVerifier = $connexion->real_escape_string($emailAVerifier);
        $passwdAVerifier = $connexion->real_escape_string($passwdAVerifier);

        //md5 crypte le mot de passe (pédagogique mais pas recommandé pour une vraie sécurité)
        $passwdAVerifier = md5($passwdAVerifier);

        //Construction de la requete
        $sqlQuery = "SELECT * FROM users WHERE email LIKE '$emailAVerifier' ";

        //Vérification de l'utilisateur
        $queryResult = $connexion->query($sqlQuery);
        $user = $queryResult->fetch_assoc();
        if (! $user || $user["password"] != $passwdAVerifier) {
            echo "La connexion a échoué : " . $connexion->error;
            print_r($emailAVerifier);
            print_r($passwdAVerifier);
        } else {
            //Se souvenir que l'utilisateur s'est connecté pour la suite
            $user_id = $user['id'];
            $_SESSION['connected_id'] = $user_id;
            //Ouvrir l'accès à toutes les pages (redirection vers la page Index)
            header("refresh:0;url=3.index.php");
        }
    }
    ?>

    <form action="./index.php" method="post" class="container">
        
        <input type='hidden' name='id' value='$user_id'>

        <div class="row justify-content-center">
            <div class="col-md-3 mb-1">
                <label for='email' class="pb-3">E-mail</label>
                <input type='email' name='email' class="form-control mb-3">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-3 mb-1">
                <label for='mdp' class="pb-3">Mot de passe</label>
                <input type='password' name='mdp' class="form-control mb-3">
            </div>
        </div>

        <input class="btn btn-danger" type='submit'>

    </form>

    <br>

    <p>
        Vous n'avez pas encore de compte ?
        <a class="btn btn-outline-danger btn-sm" href='./1.registration.php'>Inscrivez-vous</a>
    </p>
    
</body>
</html>