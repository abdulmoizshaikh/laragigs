<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    //  Show all listings
    public function index()
    {
        // dd(request());
        return view('listings.index', [
            // 'listings' => Listing::all()
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()
            // get() // it will render latest record first on the list (DESC order)
        ]);
    }

    // Show single listing
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }
}
