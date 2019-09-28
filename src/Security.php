<?php

/**
 * Handle security checks before udpating cart
 * 
 * @author Sylvain Guillard
 */
class Security
{
    /**
     * Security check on the GET values
     *
     * @return boolean
     */
    public function checkSuperglobalGet(): bool
    {
        // Check if the GET keys are correct 
        if (!empty(array_diff(array_keys($_GET), ["action", "product"]))) {
            return false;
        }

        // Check if the GET action values are correct
        if (!in_array($_GET["action"], ["add", "remove"])) {
            return false;
        }

        // Check if the product exists in the list of product available
        $utils = new Utils();
        if (false === $utils->getProductInList($_GET["product"], ProductStorage::LIST)) {
            return false;
        }

        return true;
    }
}
