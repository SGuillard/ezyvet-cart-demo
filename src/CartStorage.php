<?php

/**
 * Handle CRUD functions of the cart
 * 
 * @author Sylvain Guillard
 */
class CartStorage
{

    private $utils;
    private $cartItems;

    public function __construct()
    {
        $this->utils = new Utils();
        $this->cartItems = $_SESSION['cartItems'] ?? [];
    }

    /**
     * Add a new product
     *
     * @param string $productName
     * @return void
     */
    public function addNewProduct(string $productName): void
    {
        $productId = $this->utils->getProductInList($productName, ProductStorage::LIST);
        $this->cartItems[] = array_merge(ProductStorage::LIST[$productId], ["quantity" => 1]);
    }

    /**
     * Get quantity of a product in the cart
     *
     * @param string $productName
     * @return integer
     */
    public function getProductQuantity(string $productName): int
    {
        // check if the product is already in the cart
        $productCartId = $this->utils->getProductInList($productName, $this->cartItems);

        if (false === $productCartId) {
            return 0;
        } else {
            return $this->cartItems[$productCartId]["quantity"];
        }
    }

    /**
     * Update product quantity in cart
     *
     * @param string $productName
     * @param integer $quantity
     * @return void
     */
    public function updateQuantity(string $productName, int $quantity): void
    {
        $productCartId = $this->utils->getProductInList($productName, $this->cartItems);
        $this->cartItems[$productCartId]["quantity"] = $quantity;
    }

    /**
     * Get the product total price
     *
     * @param string $productName
     * @return float
     */
    public function getProductPrice(string $productName): float
    {
        $productCartId = $this->utils->getProductInList($productName, $this->cartItems);
        $quantity = $this->cartItems[$productCartId]["quantity"];
        $price = $this->cartItems[$productCartId]["price"];
        return $quantity * $price;
    }

    /**
     * Remove a product from the cart
     *
     * @param string $productName
     * @return void
     */
    public function removeProduct(string $productName): void
    {
        $productCartId = $this->utils->getProductInList($productName, $this->cartItems);
        array_splice($this->cartItems, $productCartId, 1);
    }

    /**
     * Get all the products in the cart
     *
     * @return array
     */
    public function getItems(): array
    {
        return $this->cartItems;
    }

    /**
     * Get total price of the cart
     *
     * @return float
     */
    public function getTotal(): float
    {
        $total = 0;
        foreach ($this->getItems() as $product) {
            $total += $this->getProductPrice($product["name"]);
        }
        return $total;
    }

    /**
     * Store cart Items
     *
     * @return void
     */
    public function storeCartItems(): void
    {
        $_SESSION["cartItems"] = $this->cartItems;
    }
}
