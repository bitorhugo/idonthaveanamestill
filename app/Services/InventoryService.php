<?php

namespace App\Services;

use App\Models\Inventory;

class InventoryService {

    private function __construct(){}
    
    /**
     * update
     * Updates inventory
     * @param Inventory $inventory
     * @param mixed $quantity
     * @return void
     */
    public static function update(Inventory $inventory, $quantity): void
    {
        $inventory->quantity = $quantity;
        $inventory->save();
    }


}
