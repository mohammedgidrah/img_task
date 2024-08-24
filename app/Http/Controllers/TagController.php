<?php

namespace App\Http\Controllers;
use App\Models\Tag;


use Illuminate\Http\Request;

class TagController extends Controller
{
  /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('tags.create', compact('tags'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255|string',
            'image'=>'nullable|mimes:png,jpg,jpeg,webp',
        ]);
        if($request->has('image')){
            $file= $request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $path='uploads/tags/';
            $file->move($path,$filename);
        }
          Tag::create([
            'name'=>$request->name,
            'image'=>$path.$filename,
        
        ]);
return to_route('tags.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tags)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id  )
    {
        $tags = Tag::find($id);
        
        
            return view('tags.edit', compact('tags'));
        
                }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
{
    // Validate the request
    // $request->validate([
    //     'title' => 'required|max:255|string',
    //     'content' => 'required|max:255|string',
    //     'image' => 'nullable|mimes:png,jpg,jpeg,webp',
    // ]); 

    // Find the post
    $tags = Tag::findOrFail($id);

    // Initialize variables
    $filename = $tags->image;  // Use existing image if no new image is provided
    $path = 'uploads/tags/';  // Default path for image storage

    if ($request->has('image')) {
        // Handle the image upload
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move(public_path($path), $filename);

        // Delete the old image if it exists
        if (File::exists(public_path($tags->image))) {
            File::delete(public_path($tags->image));
        }
    }

    // Update the post
    $post->update([
        'name' => $request->name,
        'image' => $path . $filename,  // Use the new or existing image path
    ]);
    $post->save();

    return redirect()->route('tags.index')->with('success', 'Post updated successfully!');
}

    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        
        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
    }

}    
