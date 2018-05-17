<?php

namespace App\Http\Controllers;

use App\Comment;
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
	public function news_list() {
		$newses = News::orderBy('created_at', 'desc')->where('status', 1)->paginate(2);
		return view('www.news.list', compact('newses'));
	}
	
	public function single_news_show( $slag) {
		$news = News::where('slug', $slag)->firstOrFail();
		$comments = $news->comments()->where('status', 1)->paginate(5);
		return view('www.news.show', compact('news', 'comments'));
	}
	
	
	public function add_comment( Request $request ) {
		$this->validate( $request, [
			'name'                      => 'required|regex:/[а-яА-ЯёЁa-zA-Z0-9\s]+/',
			'email'                     => 'required|email',
			'content'                   => 'required',
			'g-recaptcha-response'      => 'required'
		] );
		$comment = new Comment;
		$comment->name = $request->get('name');
		$comment->email = $request->get('email');
		$comment->content = $request->get('content');
		$comment->news_id =  $request->get('news_id');
		$comment->save();
		return redirect()->back()->with('status', 'Ваш коментарий будет скоро добавлен');
	}
	
	
	public function index () {
		
	//	$posts = Post::orderBy('created_at', 'desc')->where('status', 1)->skip(3)->take(6)->get();
		
		//return view('pages.index', compact('posts'));
    }
	
	
	

}
