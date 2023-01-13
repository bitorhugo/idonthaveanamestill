<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AutoCompleteController extends Controller
{
    
    /**
     * autoComplete
     * Autocompletion for Cards
     * @param Request $request
     */
    public function autoCompleteCards(Request $request)
    {
        $data = Card::select("name")
        ->where("name", "LIKE", "%{$request->str}%")
        ->get('query');
        return response()->json($data);
    }

    /**
     * autoCompleteUsers
     * Autocompletion for Users
     * @param Request $request
     */
    public function autoCompleteUsers(Request $request)
    {
        $data = User::select("name")
        ->where("name", "LIKE", "%{$request->str}%")
        ->get('query');
        return response()->json($data);
    }

    /**
     * autoCompleteCategories
     * Autocompletion for Categories
     * @param Request $request
     */
    public function autoCompleteCategories(Request $request)
    {
        $data = Category::select("name")
        ->where("name", "LIKE", "%{$request->str}%")
        ->get('query');
        return response()->json($data);
    }
    
}
