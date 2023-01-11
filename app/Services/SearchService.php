<?php

namespace App\Services;

use App\Models\Card;
use App\Models\Category;
use Illuminate\Support\Str;

class SearchService
{
    
    /**
     * handleSearchCards
     *
     * @param mixed $input
     * @param mixed $category
     */
    public static function handleSearchCards($input, $category)
    {
        if ($category == 'none') {
            $cards = Card::where('cards.name', 'ilike', '%' . $input . '%')
                ->get()
                ->paginate();
            return $cards;
        } else {
            $category = Category::find($category);
            $cards = Card::join('card__categories', 'cards.id', '=', 'card__categories.card_id')
                ->join('categories', 'categories.id', '=', 'card__categories.category_id')
                ->where('card__categories.category_id', '=', $category->id)
                ->where('cards.name', 'ilike', '%' . $input . '%')
                ->select('cards.*')
                ->get()
                ->paginate();
            return $cards;
        }
    }

    /**
     * handleOrderedSearchCards
     *
     * @param mixed $input user input
     * @param mixed $category category of cards to search
     * @param mixed $order cards sort order
     */
    public static function handleOrderedSearchCards($input, $category,  $order)
    {
        return Str::is($category, 'none')
            ? SearchService::baseCategory($input,  $order)
            : SearchService::customCategory($input, $category, $order);
    }

    /**
     * baseCategory
     *
     * @param mixed $input
     * @param mixed $order
     */
    private static function baseCategory($input, $order)
    {
        $cards = null;
        if (Str::contains($order, 'asc')) {
            $filter = current(explode('-', $order));
            switch ($filter) {
                case 'age':
                    $cards = Card::where('cards.name', 'ilike', '%' . $input . '%')
                        ->orderBy('created_at', 'asc')
                        ->get()
                        ->paginate();
                    break;
                case 'price':
                    $cards = Card::where('cards.name', 'ilike', '%' . $input . '%')
                        ->orderBy('price', 'asc')
                        ->get()
                        ->paginate();
                    break;
                case 'discount':
                    $cards = Card::where('cards.name', 'ilike', '%' . $input . '%')
                        ->orderBy('discount_amount', 'asc')
                        ->get()
                        ->paginate();
                    break;
            }
        }

        if (Str::contains($order, 'desc')) {
            $filter = current(explode('-', $order));
            switch ($filter) {
                case 'age':
                    $cards = Card::where('cards.name', 'ilike', '%' . $input . '%')
                        ->orderBy('created_at', 'desc')
                        ->get()
                        ->paginate();
                    break;
                case 'price':
                    $cards = Card::where('cards.name', 'ilike', '%' . $input . '%')
                        ->orderBy('price', 'desc')
                        ->get()
                        ->paginate();
                    break;
                case 'discount':
                    $cards = Card::where('cards.name', 'ilike', '%' . $input . '%')
                        ->orderBy('discount_amount', 'desc')
                        ->get()
                        ->paginate();
                    break;
            }
        }
        return $cards;
    }
    

    /**
     * customCategory
     *
     * @param mixed $input
     * @param mixed $category
     * @param mixed $order
     */
    private static function customCategory($input, $category, $order)
    {
        $category = Category::find($category);
        $cards = null;

        if (Str::contains($order, 'asc')) {
            $filter = current(explode('-', $order));
            switch ($filter) {
                case 'age':
                    $cards = Card::join('card__categories', 'cards.id', '=', 'card__categories.card_id')
                        ->join('categories', 'categories.id', '=', 'card__categories.category_id')
                        ->where('card__categories.category_id', '=', $category->id)
                        ->where('cards.name', 'ilike', '%' . $input . '%')
                        ->select('cards.*')
                        ->orderBy('created_at', 'asc')
                        ->get()
                        ->paginate();
                    break;
                case 'price':
                    $cards = Card::join('card__categories', 'cards.id', '=', 'card__categories.card_id')
                        ->join('categories', 'categories.id', '=', 'card__categories.category_id')
                        ->where('card__categories.category_id', '=', $category->id)
                        ->where('cards.name', 'ilike', '%' . $input . '%')
                        ->select('cards.*')
                        ->orderBy('price', 'asc')
                        ->get()
                        ->paginate();
                    break;
                case 'discount':
                    $cards = Card::join('card__categories', 'cards.id', '=', 'card__categories.card_id')
                        ->join('categories', 'categories.id', '=', 'card__categories.category_id')
                        ->where('card__categories.category_id', '=', $category->id)
                        ->where('cards.name', 'ilike', '%' . $input . '%')
                        ->select('cards.*')
                        ->orderBy('discount_amount', 'asc')
                        ->get()
                        ->paginate();
                    break;
            }
        }

        if (Str::contains($order, 'desc')) {
            $filter = current(explode('-', $order));
            switch ($filter) {
                case 'age':
                    $cards = Card::join('card__categories', 'cards.id', '=', 'card__categories.card_id')
                        ->join('categories', 'categories.id', '=', 'card__categories.category_id')
                        ->where('card__categories.category_id', '=', $category->id)
                        ->where('cards.name', 'ilike', '%' . $input . '%')
                        ->select('cards.*')
                        ->orderBy('created_at', 'desc')
                        ->get()
                        ->paginate();
                    break;
                case 'price':
                    $cards = Card::join('card__categories', 'cards.id', '=', 'card__categories.card_id')
                        ->join('categories', 'categories.id', '=', 'card__categories.category_id')
                        ->where('card__categories.category_id', '=', $category->id)
                        ->where('cards.name', 'ilike', '%' . $input . '%')
                        ->select('cards.*')
                        ->orderBy('price', 'desc')
                        ->get()
                        ->paginate();
                    break;
                case 'discount':
                    $cards = Card::join('card__categories', 'cards.id', '=', 'card__categories.card_id')
                        ->join('categories', 'categories.id', '=', 'card__categories.category_id')
                        ->where('card__categories.category_id', '=', $category->id)
                        ->where('cards.name', 'ilike', '%' . $input . '%')
                        ->select('cards.*')
                        ->orderBy('discount_amount', 'desc')
                        ->get()
                        ->paginate();
                    break;
            }

        }
        return $cards;
    }

}
