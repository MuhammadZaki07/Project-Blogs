<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogsController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $blogs = Post::where('user_id', $userId)->orderByDesc('id')->get();
        return view('pages.blog.tableBlogs', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.blog.createBlog', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => 'required|string|min:10',
            "slug" => "required|string|unique:posts,slug",
            "category_id" => 'required|exists:categories,id',
            "image" => "required|file|image|mimes:png,jpg,jpeg,gif|max:5120",
            "content" => "required|string",
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        $post = new Post();
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->category_id = $request->input('category_id');
        $post->user_id = Auth::user()->id;
        $post->content = $request->input('content');
        $post->image = $imagePath;
        $post->save();

        return redirect()->route('table.blog')->with('success', 'Blog berhasil disimpan.');
    }

    public function edit(string $id)
    {
        $blogs = Post::findOrFail($id);
        // $selectedCategory = Category::findOrFail($id);
        $categories = Category::all();
        return view('pages.blog.editBlog', compact('blogs', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:posts,slug,' . $id,
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($path = $request->file('image')?->storePublicly('images', 'public')) {
            Storage::disk('public')->delete($post->image);
            $post->image = $path;
        }

        $post->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'content' => $request->content,
        ]);

        return redirect()->route('table.blog')->with('success', 'Blog updated successfully');
    }

    public function delete($id)
    {
        $Post = Post::findOrFail($id);
        Storage::disk('public')->delete($Post->image);
        $Post->delete();

        return redirect()->route('table.blog')->with('success', "Blogs berhasil di hapus!!");
    }

    public function show($slug)
    {
        $blog = Post::with(['comments.user'])->where('slug', $slug)->firstOrFail();
        $recentBlogs = Post::latest()->take(5)->get();
        return view('pages.blog.blogView', compact('blog','recentBlogs'));
    }


    public function showByUser(string $userId)
    {
        $blogs = Post::where('user_id', $userId)->get();
        $recentBlogs = Post::latest()->take(5)->get();
        return view('pages.blog.index', compact('blogs', 'recentBlogs'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $blogs = Post::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
        })->get();
        $recentBlogs = Post::latest()->take(5)->get();

        return view('pages.blog.index', compact('blogs', 'recentBlogs'));
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|min:3|max:1000',
        ]);

        Comment::create([
            'isi' => $request->input('comment'),
            'tanggal' => Carbon::now()->toDateString(),
            'post_id' => $id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}
