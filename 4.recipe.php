<div>

    <!-- Titre -->
    <div>
        <h3 class="h4 fw-bold text-danger m-0"><?php echo $recipeTitle; ?></h3>
    </div>

    <div class="d-flex justify-content-center align-items-center mt-2">
        <!-- Like -->
        <div>
            <?php include('7.like.php');?>
        </div>
        <!-- Autrice -->
        <div class="ms-2">
            <small class="fst-italic text-danger">par <?php echo $recipeAuthor; ?></small>
        </div>
    </div>

    <!-- Recette -->
    <div class="mt-3">
        <p><?php
            foreach ($tagId as $tag) {
                //S'il y a un tag dans la recette :
                //if (strpos($recipeContent, $tag)) {
                    //Remplacer le mot par un lien vers la page dédiée
                    $tagLink = '<a class="link-danger text-decoration-none" href="4.recipe-by-tag.php?tag_type=' . $tags_id_type[$tag] . '&tag_name=' . $tags_id_label[$tag] . '&tag_id=' . $tag . '">' . $tags_id_label[$tag] . '</a>';
                    $newRecipe = str_replace($tags_id_label[$tag], $tagLink, $recipeContent);
                    $recipeContent = $newRecipe;
                //}
            }
            echo nl2br($newRecipe);
        ?></p>
    </div>

</div>

<!-- Image -->
<div class="mt-auto">
    <?php
        if ($recipeImage != null) {
            echo '<img alt="Photo du cockail ' . $recipeTitle . '" src="./images/' . $recipeImage . '" class="img-fluid mb-3 rounded-pill "/>';
        }
    ?>
</div>
