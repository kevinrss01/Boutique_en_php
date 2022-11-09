<?php

class CategoriesControler extends CategoriesManager
{
    public function getCategories(){
        ob_start();
        require 'views/categories/homeCategories.php';
        $vue = ob_get_clean();
        return $vue;
    }
}