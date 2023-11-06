<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // public static function find($id)
    // {
    //     $listings = self::all();

    //     foreach ($listings as $listing) {
    //         if ($listing['id'] == $id) {
    //             return $listing;
    //         }
    //     }
    // }


    public function scopeFilter($query, array $filters)
    {
        if ($filters['tag'] ?? false) {
            // Null Coalescing Operator
            // this $filters['tag'] not false than do this
            // dd($filters['tag']);
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }
        if ($filters['search'] ?? false) {
            // Null Coalescing Operator
            // this $filters['tag'] not false than do this
            // dd($filters['tag']);
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }
}
