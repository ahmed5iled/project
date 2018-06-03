<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\News;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * CommentsController constructor.
     */
    function __construct()
    {
        if (\Illuminate\Support\Facades\Request::is('api/*')) {
            $this->middleware('auth:api')->except(['news']);
        }
        $this->middleware('auth')->except(['comment']);
        $this->middleware('permission:list', ['only' => ['index']]);
        $this->middleware('permission:create', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete', ['only' => ['destroy']]);
    }


    /**
     *
     * Handel the request for list comments

     *
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(News $news)
    {
        $comments = $news->comments;
        if (\Illuminate\Support\Facades\Request::is('api/*')) {

            return response()->json($comments);
        }
        return view('admin.comment.index', compact('comments', 'news'));
    }


    /**
     *
     * Handel the request for return add form view
     *
     * @param News $news
     * @param Comment $comment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(News $news, Comment $comment)
    {
        return view('admin.comment.add', compact('news', 'comment'));
    }


    /**
     *
     * Handel the request for add comments
     *
     *
     * @param News $news
     * @param CreateCommentRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(News $news, CreateCommentRequest $request)
    {
        Auth::user()->comments()->create([
            'user_id' => Auth::user()->id,
            'news_id' => $news->id,
            'comment' => $request->comment,
            'approval' => $request->approval
        ]);
        if (\Illuminate\Support\Facades\Request::is('api/*')) {

            return response()->json(['success' => true, 'message' => 'Success'], 200);
        }
        return redirect()->route('listComments', ['news' => $news->id])->with(['success' => 'Add Comment Successfully', compact('news')]);
    }


    /**
     *
     *
     * Handel the request for return edit view
     *
     * @param News $news
     * @param Comment $comment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(News $news, Comment $comment)
    {
        return view('admin.comment.edit', compact('comment'));
    }


    /**
     *
     *
     *
     * Handel the request for update comments
     *
     *
     * @param News $news
     * @param Comment $comment
     * @param UpdateCommentRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(News $news, Comment $comment, UpdateCommentRequest $request)
    {
        $comment->update($request->only(['comment', 'approval']));
        if (\Illuminate\Support\Facades\Request::is('api/*')) {

            return response()->json(['success' => true, 'message' => 'Success'], 200);
        }
        return redirect()->route('listComments', ['news' => $news->id])->with(['success' => 'Updated Comment Successfully', compact('news')]);
    }


    /**
     *
     *
     * Handel the request for delete comments
     *
     * @param News $news
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(News $news, Comment $comment)
    {
        $comment->delete();
        if (\Illuminate\Support\Facades\Request::is('api/*')) {

            return response()->json(['success' => true, 'message' => 'Success'], 200);
        }
        return response()->json(['success' => true, 'message' => 'Comment Deleted Successfully.'], 200);
    }

    /**
     *
     *
     *
     *
     * @param CreateCommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function comment(CreateCommentRequest $request)
    {
         Comment::create([
            'user_id' => Auth::user()->id,
            'news_id' => $request->news_id,
            'comment' => $request->comment,
            'approval' => '0'
        ]);
        return response()->json(['success' => true, 'message' => 'Success'], 200);
    }

}
