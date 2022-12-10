<?php

namespace App\Services;

use App\Models\Inventory;

class InventoryService {

    private function __construct()
    {
        
    }
    
    public static function update(Inventory $inventory, $quantity): void
    {
        $inventory->quantity = $quantity;
        $inventory->save();
    }


}
