<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$comments = Comment::paginate(10);
		return view( 'admin.comments.index', [ 'comments' => $comments ] );
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$newses = News::pluck('title', 'id')->all();
		return view( 'admin.comments.create', ['newses' => $newses ]);
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		$this->validate( $request, [
			'news_id'   => 'required|numeric',
			'name'      => 'required',
			'email'     => 'required|email',
			'content'   => 'required'
		] );
		Comment::create( $request->all() );
		return redirect()->route( 'comments.index' );
	}
	
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id property of comment object
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		$comment = Comment::find( $id );
		$newses = News::pluck('title','id')->all();
		return view( 'admin.comments.edit', [ 'comment' => $comment, 'newses' => $newses  ] );
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id property of comment object
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {
		$this->validate( $request, [
			'news_id'   => 'required|numeric',
			'name'      => 'required',
			'email'     => 'required|email',
			'content'   => 'required'
		] );
		$comment = Comment::find( $id );
		$comment->update( $request->all() );
		return redirect()->route( 'comments.index' );
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id property of comment object
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		Comment::find( $id )->delete();
		return redirect()->route( 'comments.index' );
	}
	
	/**
	 * Toggle status of comment active/disactive .
	 *
	 * @param  int $id property of comment object
	 *
	 * @return \Illuminate\Http\Response  // back to comments listing
	 */

	public function toggle($id){
		$comment = Comment::find($id);
		$comment->toggleStatus();
		return redirect()->back();
	}
}
