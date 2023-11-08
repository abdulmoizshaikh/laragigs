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
        // dd($request->file('logo'));
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            "website" => 'required',
            "email" => ['required', 'email'],
            "tags" => 'required',
            "description" => 'required',
        ]);

        if ($request->hasFile('logo')) {

            // we can set it to the path and upload at the same time using below code
            // here logos is folder name where to store file
            $formFields['logo'] = $request->file('logo')->store(
                'logos',
                'public'
            );
        }

        $formFields['user_id'] = auth()->id();


        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }


    // Show Edit Form
    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    // Update Listing Data
    public function update(Request $request, Listing $listing)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            "website" => 'required',
            "email" => ['required', 'email'],
            "tags" => 'required',
            "description" => 'required',
        ]);

        if ($request->hasFile('logo')) {
            // we can set it to the path and upload at the same time using below code
            // here logos is folder name where to store file
            $formFields['logo'] = $request->file('logo')->store(
                'logos',
                'public'
            );
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully!');
    }


    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully!');
    }

    // Manage Listings
    public function manage()
    {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
