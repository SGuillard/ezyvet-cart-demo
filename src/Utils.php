<?php

/**
 * Helpfull functions for various class
 * 
 * @author Sylvain Guillard
 */
class Utils
{
    /**
     * Check if a product is in a list and return its key
     *
     * @param string $productName
     * @param array $list
     * @return int|bool
     */
    public function getProductInList(string $productName, array $list)
    {
        // Get the key of the product in the array list 
        $productKey = array_search($productName, array_column($list, "name"));

        if (false !== $productKey) {
            return $productKey;
        } else {
            return false;
        }
    }
}
