<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Test;
use Exception;
use Illuminate\Http\Request;
use Nette\Utils\Random;

class PostController extends Controller
{
    public function index()
    {
        return Post::all();

    }


    public function createOrUpdate(Request $request)
    {
        $post=new Post();
        $post->id=$request->id;
        $post->name=$request->name;
        $post->email=$request->email;

        try {
            return $post->save();
        } catch (Exception $th) {
            return $th->getMessage();
        }
    }

    public function read($id)
    {
        try {
            return Post::findOrFail($id);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function update(Request $request,$id)
    {
        $post=$this->read($id);
        try {
            $post->update($request->all());
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function delete($id)
    {
        $post=$this->read($id);
        try {
            $post->delete();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }
}
