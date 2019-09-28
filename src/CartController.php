<?php

/**
 * Handle all the functions related to the cart
 * 
 * @author Sylvain Guillard
 */
class CartController
{

    private $cartStorage;

    public function __construct()
    {
        $this->cartStorage = new CartStorage();
    }

    /**
     * Add a product
     *
     * @param string $productName
     * @return void
     */
    public function addProduct(string $productName): void
    {
        $quantity = $this->cartStorage->getProductQuantity($productName);

        if (0 === $quantity) {
            $this->cartStorage->addNewProduct($productName);
        } else {
            $this->cartStorage->updateQuantity($productName, $quantity + 1);
        }

        $this->cartStorage->storeCartItems();
    }

    /**
     * Remove a product
     *
     * @param string $productName
     * @return void
     */
    public function removeProduct(string $productName): void
    {
        $quantity = $this->cartStorage->getProductQuantity($productName);

        if ($quantity > 1) {
            $this->cartStorage->updateQuantity($productName, $quantity - 1);
        } else {
            $this->cartStorage->removeProduct($productName);
        }
        $this->cartStorage->storeCartItems();
    }

    /**
     * Get total price of cart
     *
     * @return float
     */
    public function getTotal(): float
    {
        return $this->cartStorage->getTotal();
    }

    /**
     * Get the price of a product
     *
     * @param string $productName
     * @return float
     */
    public function getProductPrice(string $productName): float
    {
        return $this->cartStorage->getProductPrice($productName);
    }

    /**
     * Get the list of the product in the cart
     *
     * @return array
     */
    public function getCartItems(): array
    {
        return $this->cartStorage->getItems();
    }
}
