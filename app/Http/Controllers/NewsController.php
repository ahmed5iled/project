<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\News;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * NewsController constructor.
     */
    function __construct()
    {
        if (\Illuminate\Support\Facades\Request::is('api/*')) {
            $this->middleware('auth:api')->except(['news']);
        }
        $this->middleware(['auth'])->except(['news']);
        $this->middleware('permission:list', ['only' => ['index']]);
        $this->middleware('permission:edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete', ['only' => ['destroy']]);
    }

    /**
     *
     * Handel the request for fetch news
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index()
    {
        $news = News::all();
        if (\Illuminate\Support\Facades\Request::is('api/*')) {

            return response()->json($news);
        }
        return view('admin.news.index', compact('news'));
    }

    /**
     *
     * Handel the request for return add news view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        return view('admin.news.add');
    }


    /**
     *
     * Handel the request for add news
     *
     * @param CreateNewsRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(CreateNewsRequest $request)
    {

        News::create([
            'title' => $request->title,
            'description' => $request->description,
            'approval' => $request->approval,
            'user_id' => Auth::user()->id,


        ]);
        if (\Illuminate\Support\Facades\Request::is('api/*')) {

            return response()->json(['success' => true, 'message' => 'Success'], 200);
        }
        if (Auth::user()->hasRole('user')) {
            return redirect()->route('frontHome')->with(['success' => 'Thanks for send news ,please wait for approval ']);
        }
        return redirect()->route('listNews')->with(['success' => 'News Added successfully']);

    }

    /**
     *
     * Handel the request for return edit news view
     *
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     *
     * Handel the request for update news
     *
     * @param News $news
     * @param UpdateNewsRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(News $news, UpdateNewsRequest $request)
    {

        $news->update([
            'title' => $request->title,
            'description' => $request->description,
            'approval' => $request->approval

        ]);
        if (\Illuminate\Support\Facades\Request::is('api/*')) {

            return response()->json(['success' => true, 'message' => 'Success'], 200);
        }
        return redirect()->route('listNews')->with(['success' => 'News updated successfully']);

    }


    /**
     *
     * Handel the request for delete news
     *
     * @param News $news
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(News $news)
    {
        $news->delete();
        return response()->json(['success' => true, 'message' => 'User Deleted Successfully.'], 200);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function news()
    {
        $news = News::all();

        return view('front.main', compact('news', 'comments'));
    }
}
