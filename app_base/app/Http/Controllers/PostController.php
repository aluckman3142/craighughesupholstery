<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::whereHas('images')->get();

        return View::make('dashboard.posts.view')->with(compact('posts'));
    }

    public function create()
    {
        return View::make('dashboard.posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'intro_text'=> $request->intro_text,
            'main_text' => $request->main_text,
            'published_date' => $request->published_date,
            'published_by' => $request->published_by,
            'link' => $request->link,
            'enabled' => 1,
        ]);

        foreach ($request->file('photos') as $imagefile) {
            $image = new PostImage;

            $input['upload'] = time().'.'.$imagefile->extension();

            $basePath = base_path();

            $basePath = str_replace("app_base", "", $basePath);

            $destinationPath = $basePath.'htdocs/img/posts';

            $imgFile = Image::make($imagefile->getRealPath());

            $imgFile->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['upload']);

            $image->src = 'img/posts/'.$input['upload'];
            $image->post_id = $post->id;
            $image->save();
            sleep(1);
        }

        Session::flash('message', 'Successfully created post!');
        return Redirect::to('dashboard/posts');
    }

    public function show(Post $post)
    {
        $items = $post->images()->pluck('src')->toArray();

        $items = preg_filter('/^/', '/', $items);

        $items = array_values($items);

        return View::make('posts.show')->with(compact('post', 'items'));
    }

    public function edit(Post $post)
    {
        return View::make('dashboard.posts.edit')->with(compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'intro_text'=> $request->intro_text,
            'main_text' => $request->main_text,
            'published_date' => $request->published_date,
            'published_by' => $request->published_by,
            'link' => $request->link,
        ]);

        if($request->file('photos')){

            foreach ($post->images as $image){

                $path = public_path("/").$image->src;

                $basePath = base_path();

                $basePath = str_replace("app_base", "", $basePath);

                $deletePath = $basePath.$image->src;

                if(File::exists($deletePath)){

                    File::delete($deletePath);
                }

                $image->delete();
            }

            foreach ($request->file('photos') as $imagefile) {
                $image = new PostImage;

                $input['upload'] = time().'.'.$imagefile->extension();

                $basePath = base_path();

                $basePath = str_replace("app_base", "", $basePath);

                $destinationPath = $basePath.'htdocs/img/posts';

                $imgFile = Image::make($imagefile->getRealPath());

                $imgFile->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$input['upload']);

                $image->src = 'img/posts/'.$input['upload'];
                $image->post_id = $post->id;
                $image->save();
                sleep(1);
            }
        }

        Session::flash('message', 'Successfully updated post!');
        return Redirect::to('dashboard/posts');
    }

    public function destroy(Post $post)
    {
        $post->images
            ->each(function (PostImage $postImage) {
                $path = public_path("/").$postImage->src;

                if(File::exists($path)){
                    File::delete($path);
                }
                $postImage->delete();
            });

        $post->delete();

        Session::flash('message', 'Successfully deleted post!');
        return Redirect::to('dashboard/posts');
    }

    public function enable(Post $post){
        $post->update([
            'enabled' => 1
        ]);

        Session::flash('message', 'Successfully enabled post!');
        return Redirect::to('dashboard/posts');
    }

    public function disable(Post $post){
        $post->update([
            'enabled' => 0
        ]);

        Session::flash('message', 'Successfully disabled post!');
        return Redirect::to('dashboard/posts');
    }
}
