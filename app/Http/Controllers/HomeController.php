<?php

namespace App\Http\Controllers;

use App\Review;
use App\News;
use Illuminate\Http\Request;


class HomeController extends Controller
{
	
	/**
	 * Display news list .
	 *
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function news_index() {
		$newses = News::orderBy('created_at', 'desc')->where('status', 1)->paginate(2);
		return view('www.news.index', compact('newses'));
	}
	
	public function news_show( $slag) {
		$news = News::where('slug', $slag)->firstOrFail();
		return view('www.news.show', compact('news'));
	}
	
	public function review_index() {
		$reviews = Review::orderBy('created_at', 'desc')->where('status', 1)->paginate(5);
		return view('www.reviews.index', compact('reviews'));
	}
	
	public function add_review( Request $request ) {
		$this->validate( $request, [
			'name'                      => 'required|regex:/[а-яА-ЯёЁa-zA-Z0-9\s]+/',
			'email'                     => 'required|email',
			'content'                   => 'required',
			'g-recaptcha-response'      => 'required'
		] );
		$review = new Review;
		$review->name = $request->get('name');
		$review->email = $request->get('email');
		$review->content = $request->get('content');
		$review->save();
		return redirect()->back()->with('status', 'Ваш отзыв будет скоро добавлен');
	}
	
	
	public function index () {
		return view('welcome');
    }
	
	
	

}
