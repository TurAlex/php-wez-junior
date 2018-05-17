<?php

namespace App\Http\Controllers\Admin;

use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class NewsesController extends Controller {
	/**
	 * Display a listing of the news on admin page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$newses = News::paginate(10);
		return view( 'admin.news.index',  [ 'newses' => $newses ]  );
	}
	
	/**
	 * Show the form for creating a new news.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view( 'admin.news.create');
	}
	
	/**
	 * Store a newly created news in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return redirect to news list
	 */
	public function store( Request $request ) {
		$this->validate($request,
			[
				'title' => 'required|unique:news',
				'content' => 'required',
				'intro' => 'required',
				'image' => 'nullable|image',
			]);
		$news = News::add($request->all());
		$news ->uploadImage($request->file('image'));
		$news->setStatus($request->get('status'));
		return redirect()->route('news.index');
	}
	
		/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  integer $id of the news
	 *
	 * @return \Illuminate\Http\Response // to edit page
	 */
	public function edit($id) {
		$news = News::find($id);
		return view( 'admin.news.edit', compact( 'news')  );
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  integer news $id
	 *
	 * @return \Illuminate\Http\Response // back to edit page
	 */
	public function update( Request $request, $id) {
		$news = News::find($id);
		$this->validate($request,
			[
				'title' => [
					'required',
					Rule::unique('news')->ignore($news->id),
				],
				'content' => 'required',
				'intro' => 'required',
				'slug'    => [
					'required',
					Rule::unique('news')->ignore($news->id),
				],
				'image' => 'nullable|image',
			]);
		$news->edit($request->all());
		$news ->uploadImage($request->file('image'));
		$news->setStatus($request->get('status'));
		return redirect()->back();
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  integer news $id property
	 *
	 * @return \Illuminate\Http\Response //  to news listing
	 */
	public function destroy( $id) {
		$news = News::find($id);
		$this->destroyRelatedComments($news);
		$news->remove();
		return redirect()->route('news.index');
	}
	
	/**
	 * Remove all comments related to this news .
	 *
	 * @param  object $news
	 *
	 */
	public function destroyRelatedComments($news) {
		$comments = $news->comments()->get();
		foreach ($comments as $comment)
			$comment->delete();
	}
	
	/**
	 * Toggle news status.
	 *
	 * @param  int news $id property
	 *
	 * @return \Illuminate\Http\Response //  to news listing
	 */
	public function toggle($id){
		$news = News::find($id);
		$news->toggleStatus();
		return redirect()->back();
	}
}
