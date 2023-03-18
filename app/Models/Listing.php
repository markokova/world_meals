<?php

namespace App\Models;

class Listing{
    public static function all() {
        return [
            [
                'id' => 1,
                'title' => 'Listing one',
                'description' => 'Pizza is a dish of Italian origin consisting
                 of a usually round, flat base of leavened wheat-based dough 
                 topped with tomatoes, cheese, and often various other
                  ingredients, which is then baked at a high temperature,
                   traditionally in a wood-fired oven.
                 A small pizza is sometimes called a pizzetta. Wikipedia'
            ],
            [
                'id' => 2,
                'title' => 'Listing two',
                'description' => 'Pizza is a dish of Italian origin consisting
                 of a usually round, flat base of leavened wheat-based dough 
                 topped with tomatoes, cheese, and often various other
                  ingredients, which is then baked at a high temperature,
                   traditionally in a wood-fired oven.
                 A small pizza is sometimes called a pizzetta. Wikipedia'
            ]
            ];
    }

    public static function find($id) {
        $listings = self::all();
        foreach($listings as $listing){
            if($listing['id'] == $id){
                return $listing;
            }
        }
    }
}