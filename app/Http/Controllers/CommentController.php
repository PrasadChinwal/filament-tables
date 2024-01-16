<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Session;
use Helper;
use Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
        $this->middleware('impersonate:web');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::where('netid', Auth::user()->name)->orderBy('id', 'desc')->paginate(10);
        return view('comments.index')->withComments($comments);
    }

    public function indexall()
    {
        $this->authorize('is-admin');
        $comments = Comment::orderBy('id', 'desc')->paginate(10);
        return view('comments.index')->withComments($comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required|max:2000'
        ]);
        $comment = new Comment;
        $comment->description = $request->description;
        $comment->netid = Auth::user()->name;
        $comment->save();

        $from = 'no-reply@uis.edu';
        $to = 'appssupport@uis.edu';
        $subject = env('APP_NAME') . ' Feedback';
        $html = '<html><head><title>' . env('APP_NAME') . " Feedback</title></head><body><span style='color: #333399;'>A feedback form request submitted by " . $comment->netid . " requires your attention. Please visit <a href='http://apps.uis.edu/" . env('DB_DATABASE') . "'>http://apps.uis.edu/" . env('DB_DATABASE') . '</a></span><br></body></html>';

        Helper::sendEmail($from, $to, $subject, $html);

        Session::flash('success', 'The feedback was successfully saved.');

        return redirect()->route('comments.show', $comment->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::find($id);
        return view('comments.show')->withComment($comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('comments.edit')->withComment($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        $this->validate($request, [
            'description' => 'required|max:2000'
        ]);

        $comment->description = $request->description;
        $comment->save();

        $from = 'no-reply@uis.edu';
        $to = 'appssupport@uis.edu';
        $subject = env('APP_NAME') . ' Feedback';
        $html = '<html><head><title>' . env('APP_NAME') . " Feedback</title></head><body><span style='color: #333399;'><strong>A feedback form request updated by " . $comment->netid . " requires your attention. Please visit <a href='http://apps.uis.edu/" . env('DB_DATABASE') . "'>http://apps.uis.edu/" . env('DB_DATABASE') . '</a> </strong></span><br></body></html>';

        Helper::sendEmail($from, $to, $subject, $html);

        Session::flash('success', 'The feedback was successfully updated.');

        return redirect()->route('comments.show', $comment->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        Session::flash('success', 'The feedback was successfully deleted.');
        return redirect()->route('comments.index');
    }
}
