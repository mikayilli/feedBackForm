<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Image;
class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $order = (!in_array(request('sort'), ['name', 'created_at', 'email'])) ? 'created_at' : request('sort');

        $statuses = ["New","Accepted", "Rejected"];
        $reviews = Review::orderBy($order, 'DESC')
            ->paginate(20);

        return view("reviews.index", compact('reviews', 'statuses'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "email" => "email|required|max:50",
            "name" => "required|max:50",
            "text" => "required",
            "photo" => "nullable|mimes:jpg,gif,png"
        ]);

        $name = null;
        if($request->hasFile('photo')) {
            $image = $request->file('photo');
            $name = time().'.'.$image->getClientOriginalExtension();

            $path = public_path('/photo');

            $imgFile = Image::make($image->getRealPath());

            $imgFile->resize(320, 240, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path.'/'. $name);
        }

        Review::create([
           "name" => $request->name,
           "email" => $request->email,
           "text" => $request->text,
           "photo" => $name
        ]);

        return back()->with("message", "created succesfully");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        $request->validate([
            "email" => "email|required|max:50",
            "name" => "required|max:50",
            "text" => "required",
            "status" => "in:0,1,2"
        ]);

        $review->update([
            "name" => $request->name,
            "email" => $request->email,
            "text" => $request->text,
            "edited_at" => now(),
            "status" => $request->input('status')
        ]);

        return back()->with("message", "updated succesfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
