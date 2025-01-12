<?php

namespace App\Interface;

use App\Models\Product;

interface CartInterface
{
    public function get();
    public function add(Product $product , $quantity=1);
    public function update($id , $quantity);
    public function delete($id);
    public function empty();
    public function total();
}
