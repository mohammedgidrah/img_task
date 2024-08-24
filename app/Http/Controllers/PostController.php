<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\PostTagPivot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

        public function index()
        {
            $posts = Post::with('tags')->get(); // Ensure to eager load tags
            return view('post.index', compact('posts'));
        }
          

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $posts = Post::all();
        $tags = Tag::all();
        return view('post.create', compact('posts', 'tags'));
        
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:255|string',
            'content'=>'required|max:255|string',
            'image'=>'nullable|mimes:png,jpg,jpeg,webp',
        ]);
        if($request->has('image')){
            $file= $request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $path='uploads/posts/';
            $file->move($path,$filename);
        }
          Post::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'image'=>$path.$filename,
        
        ]);
return to_route('post.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id  )
    {
        $post = Post::find($id);
        
        
            return view('post.edit', compact('post'));
        
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
    $post = Post::findOrFail($id);

    // Initialize variables
    $filename = $post->image;  // Use existing image if no new image is provided
    $path = 'uploads/posts/';  // Default path for image storage

    if ($request->has('image')) {
        // Handle the image upload
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move(public_path($path), $filename);

        // Delete the old image if it exists
        if (File::exists(public_path($post->image))) {
            File::delete(public_path($post->image));
        }
    }

    // Update the post
    $post->update([
        'title' => $request->title,
        'content' => $request->content,
        'image' => $path . $filename,  // Use the new or existing image path
    ]);
    $post->save();

    return redirect()->route('post.index')->with('success', 'Post updated successfully!');
}

    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
    
        return redirect()->route('post.index')->with('success', 'Post deleted successfully.');
    }
    
}
