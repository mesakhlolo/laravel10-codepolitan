<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Mail\BlogPosted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect('logout');
        }

        $posts = Post::active()->get();
        // $posts = DB::table('posts')
        //     ->select('id', 'title', 'content', 'created_at')
        //     ->where('active', true)
        //     ->get();

        $view_data = [
            'posts' => $posts
        ];

        return view('posts.index', $view_data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect('logout');
        }

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect('logout');
        }

        $title = $request->input('title');
        $content = $request->input('content');

        $post = Post::create([
            'title' => $title,
            'content' => $content,
        ]);

        $this->notify_telegram($post);

        Mail::to(Auth::user()->email)->send(new BlogPosted($post));

        return redirect('posts');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!Auth::check()) {
            return redirect('logout');
        }

        $selected_post = Post::where('id', $id)->first();
        $comments = $selected_post->comments()->get();
        $total_comments = $selected_post->total_comments();

        $view_data = [
            'post' => $selected_post,
            'comments' => $comments,
            'total_comments' => $total_comments,
        ];

        return view('posts.show', $view_data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Auth::check()) {
            return redirect('logout');
        }

        $post = Post::where('id', $id)->first();

        $view_data = [
            'post' => $post
        ];

        return view('posts.edit', $view_data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Auth::check()) {
            return redirect('logout');
        }

        $title = $request->input('title');
        $content = $request->input('content');

        Post::where('id', $id)
            ->update([
                'title' => $title,
                'content' => $content,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect("posts/{$id}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Auth::check()) {
            return redirect('logout');
        }

        Post::where('id', $id)
            ->delete();

        return redirect('posts');
    }

    private function notify_telegram($post)
    {
        $api_token = "6999785729:AAFKPYaCIPFdrZND4yAoQF1T9PEnajuKdXY";
        $url = "https://api.telegram.org/bot{$api_token}/sendMessage";
        $chat_id = -1001716168333;
        $content = "Ada postingan baru di blog lu cuy, judulnya :  <strong>\"{$post->title}\"</strong>";

        $data = [
            'chat_id' => $chat_id,
            'text' => $content,
            'parse_mode' => "HTML"
        ];

        Http::post($url, $data);
    }
}
