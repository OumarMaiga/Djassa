<?php

function getProductFiles($product_id)
{
    $files = DB::select("SELECT * 
                        FROM files 
                        WHERE product_id = $product_id
                        LIMIT 1");
    
    return $files;
}

function custom_date($date) 
{
    $mois = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
    $day = date("d", strtotime($date));
    $month = date("m", strtotime($date));
    $month = $month - 1;
    $year = date("Y", strtotime($date));

    return "$day $mois[$month] $year";
}
