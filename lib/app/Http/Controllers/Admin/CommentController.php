<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VpComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function getComment()
    {
        $comments = VpComment::paginate(3);

        return view('backend.comment', compact('comments'));
    }
    public function getDeleteComment($id)
    {
        $comment = VpComment::find($id);
        $comment->delete();

        return redirect()->intended('admin/comment');
    }
    public function confirmComment($id)
    {
        $comment = VpComment::find($id);
        $comment->com_status = 1;
        $comment->save();

        return redirect()->intended('admin/comment');
    }
}
