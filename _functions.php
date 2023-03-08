<?php

function displayAuthor(string $authorEmail, array $users) : string
//prend en paramètre une string et un tableau et return une string
{
    for ($i = 0; $i < count($users); $i++) {
        $author = $users[$i];
        if ($authorEmail === $author['email']) {
            return $author['full_name'] . ' (' . $author['age'] . ' ans)';
        }
    }
}
//On fait le tour du tableau "users"
//On stock le user concerné dans la variable "author"
//Si l'email de l'auteur de la recette = l'email du user concerné
    //alors on affiche son nom et son âge



function isValidRecipe(array $recipe) : bool
//prend en paramètre un tableau et return un booléen
{
    if (array_key_exists('is_enabled', $recipe)) {
        $isEnabled = $recipe['is_enabled'];
    } else {
        $isEnabled = false;
    }
    return $isEnabled;
}
//Si la clé "is_enabled" existe dans le tableau/paramètre "recipe"
    //alors on stock sa valeur dans la variable "isEnabled"
    //sinon, on considère que la valeur est "false" (et on la stock)
//La fonction return la valeur de "is_enabled" (true ou false)



function getRecipes(array $recipes) : array
//prend en paramètre un tableau et return un tableau
{
    $validRecipes = [];

    foreach($recipes as $recipe) {
        if (isValidRecipe($recipe)) {
            $validRecipes[] = $recipe;
        }
    }

    return $validRecipes;
}
//Pour chaque élément du tableau "recipes"
    //si la fonction isValidRecipe retourne 'true' (= "is_enabled" = true)
    //alors on push la recette dans le tableau "validRecipes"


?>