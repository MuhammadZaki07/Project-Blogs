<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if ($comment->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini.');
        }
        $comment->delete();
        return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
    }
}
        