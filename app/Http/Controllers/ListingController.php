<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //  Show all listings
    public function index()
    {
        // dd(request());
        return view('listings.index', [
            // 'listings' => Listing::all()
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6) //here 6 is per page records count
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

    // Show Create Form
    public function create()
    {
        return view('listings.create');
    }


    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            "website" => 'required',
            "email" => ['required', 'email'],
            "tags" => 'required',
            "description" => 'required',
        ]);

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }
}
