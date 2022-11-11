<?php


class Cart
{
    /**
     * @var CartItem[]
     */
    private array $items = [];

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array $items
     */
    public function setItems(array $items): void
    {
        $this->items = $items;
    }



    /**
     * Add Product $product into cart. If product already exists inside cart
     * it must update quantity.
     * This must create CartItem and return CartItem from method
     * Bonus: $quantity must not become more than whatever
     * is $availableQuantity of the Product
     *
     * @param Product $product
     * @param int $quantity
     * @return CartItem
     */
    public function addProduct(Product $product, int $quantity): CartItem
    {
        $cartItem = new CartItem($product, $quantity);
        if (in_array($cartItem,$this->items)){

            $originalQuantity =  $this->items[$product->getId()]->getQuantity();

            if($originalQuantity + $quantity <= $product->getAvailableQuantity()){
                $this->items[$product->getId()]->setQuantity($originalQuantity + $quantity);
            }
        }else{
            $this->items[$product->getId()] = $cartItem;
        }
        return $cartItem;


    }

    /**
     * Remove product from cart
     *
     * @param Product $product
     */
    public function removeProduct(Product $product)
    {
        $this->items[$product->getId()]->decreaseQuantity();
        if ($this->items[$product->getId()]->getQuantity() <= 0){
            unset($this->items[$product->getId()]);
        }


    }

    /**
     * This returns total number of products added in cart
     *
     * @return int
     */
    public function getTotalQuantity(): int
    {
        $osszMennyiseg = 0;
        foreach ($this->items as $product){
            $osszMennyiseg += $product->getQuantity();
        }
        return $osszMennyiseg;
    }

    /**
     * This returns total price of products added in cart
     *
     * @return float
     */
    public function getTotalSum(): float
    {

        $sum = 0;
        foreach ($this->items as $item) {
            $sum  += ($item->getQuantity() * $item->getProduct()->getPrice());
        }
        return $sum;
    }

}
