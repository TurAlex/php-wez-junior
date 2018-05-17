<?php

namespace App\Http\Controllers\Admin;

use App\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$reviews = Review::paginate(10);
		return view( 'admin.reviews.index', [ 'reviews' => $reviews ] );
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view( 'admin.reviews.create');
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
			'name'      => 'required',
			'email'     => 'required|email',
			'content'   => 'required'
		] );
		$review =  Review::create( $request->all() );
		$review->setStatus($request->get('status'));
		return redirect()->route( 'reviews.index' );
	}
	
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id property of object
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		$review = Review::find( $id );
		return view( 'admin.reviews.edit', [ 'review' => $review] );
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
			'name'      => 'required',
			'email'     => 'required|email',
			'content'   => 'required'
		] );
		$review = Review::find( $id );
		$review->update( $request->all() );
		$review->setStatus($request->get('status'));
		return redirect()->route( 'reviews.index' );
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id property of object
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		Review::find( $id )->delete();
		return redirect()->route( 'reviews.index' );
	}
	
	/**
	 * Toggle status of review active/disactive .
	 *
	 * @param  int $id property of comment object
	 *
	 * @return \Illuminate\Http\Response  // back to reviews listing
	 */

	public function toggle($id){
		$review = Review::find($id);
		$review->toggleStatus();
		return redirect()->back();
	}
}
