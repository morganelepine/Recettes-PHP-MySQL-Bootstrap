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

    <?php
    //Récupérer l'id et le label du tag de la page
    $tag_id = intval($_GET['tag_id']);
    $tag_name = $_GET['tag_name'];
    $tag_type = $_GET['tag_type'];
    ?>
    
    <?php include_once('0.header.php'); ?>

    <!-- CONTENU DE LA PAGE -->
    <h1 class="m-5 text-white fw-bold">Recettes contenant : <?php echo $tag_name ?></h1>

    <?php include_once('4.recipe_query.php'); ?>

    <div class="container">

        <div class="container">
 
            <div class="row justify-content-center">
                
            <?php
            while ($listRecipes = $queryOK->fetch_assoc()) {
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

            if (in_array($tag_id, $tagId)) {
            ?>

                <div class="d-flex flex-column align-content-between col-sm-3 rounded bg-light bg-opacity-75 m-3 p-3">
                    <?php include('4.recipe.php'); ?>
                </div>
        
                <!-- Fermeture des boucle while et if -->
                <?php }} ?>

            <!-- <div class="row justify-content-center"> -->
            </div>

        <!-- Container -->
        </div>

    <!-- Container -->
    </div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous">
</script>

</body>

</html>
