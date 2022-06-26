<?php

function getProductFiles($product_id)
{
    $files = DB::select("SELECT * 
                        FROM files 
                        WHERE product_id = $product_id
                        LIMIT 1");
    
    return $files;
}