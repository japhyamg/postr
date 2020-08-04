<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'coverimage' => ['required','image','max:1014']
            // 'coverimage' => ['required','mimes:jpeg,jpg,png|max:1014']
        ]);
        $extension = $request->coverimage->extension();
        $filename = Str::random(40);
        $request->coverimage->storeAs('/public', $filename.'.'.$extension);
        $coverimageurl = Storage::url($filename.'.'.$extension);

        Post::create([
            'user_id' => auth()->user()->id,
            'slug' => date('Y-m').'-'. Str::slug($validatedData['title'], '-'),
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'coverimage' => $coverimageurl
        ]);

        return redirect()->route('home')->with('success','Post Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if($post->user_id !== auth()->user()->id){
            return redirect()->route('home')->with('error','Unauthorized Action');
        }

        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if($post->user_id !== auth()->user()->id){
            return redirect()->route('home')->with('error','Unauthorized Action');
        }

        $validatedData = $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required']
        ]);

        if ($request->hasFile('coverimage')) {
            if ($request->file('coverimage')->isValid()) {
                $request->validate([
                    'coverimage' => ['image','max:1014']
                ]);
                File::delete($post->coverimage);
                $extension = $request->coverimage->extension();
                $filename = Str::random(40);
                $request->coverimage->storeAs('/public', $filename.'.'.$extension);
                $coverimageurl = Storage::url($filename.'.'.$extension);
                $post->coverimage = $coverimageurl;
            }
        }


        $post->slug = date('Y-m').'-'. Str::slug($validatedData['title'], '-');
        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];
        $post->save();

        return redirect()->route('home')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if($post->user_id !== auth()->user()->id){
            return redirect()->route('home')->with('error','Unauthorized Action');
        }
        $post->delete();
        return redirect()->route('home')->with('success','Post Deleted');
    }
}
