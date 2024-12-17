<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('pages.catgeory.index', compact('categories'));
    }

    public function show(string $id)
    {
        $blogs = Post::where('category_id', $id)->get();
        $recentBlogs = Post::latest()->take(5)->get();
        return view('pages.blog.categoryBlog', compact('blogs', 'recentBlogs'));
    }



    public function tableCategory()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('pages.catgeory.tableCategory', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|string|unique:categories,name|min:3"
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        if ($category) {
            return redirect()->route('table.category')->with('success', 'successfully created!!');
        } else {
            return redirect()->back()->with('failed', 'category gagal di tambahkan!!');
        }
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('table.category')->with('success', 'Category updated successfully!!');
    }


    public function delete($id)
    {
        $category = Category::findOrFail($id);
        if ($category->posts()->exists()) {
            return redirect()->route('table.category')
                ->with('error', "Kategori tidak dapat dihapus karena sedang digunakan oleh blog.");
        }

        $category->delete();
        return redirect()->route('table.category')
            ->with('success', "Kategori berhasil dihapus!");
    }


    public function search(Request $request)
    {
        $category = $request->input('category');
        $categories = Post::when($category, function ($query, $category) {
            return $query->whereHas('category', function ($q) use ($category) {
                $q->where('name', 'like', "%{$category}%");
            });
        })->get();
        return view('pages.catgeory.index', compact('categories'));
    }
}
