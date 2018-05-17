<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $fillable = ['author_id', 'name', 'email' , 'news_id', 'content'];
	
	/**
	 * Return news which contain this comment.
	 *
	 * @return object
	 */
	public function news() {
		return $this->belongsTo(News::class);
	}
	
	/**
	 * Allow publishing comment.
	 *
	 */
	public function allow() {
		$this->status = 1;
		$this->save();
	}
	
	/**
	 * Disallow publishing comment.
	 *
	 */
	public function disallow() {
		$this->status = 0;
		$this->save();
	}
	
	/**
	 * Toggle status of comment.
	 *
	 */
	public function toggleStatus() {
		if ($this->status == null)
			return $this->allow();
		return $this->disallow();
	}
	
	
	/**
	 * Remove source from db.
	 *
	 */
	public function remove() {
		$this->delete();
	}
	
	/**
	 * Return title of news which contain this comment.
	 * for comments listing page
	 *
	 * @return string
	 */
	public function getNewsTitle() {
		if ($this->news != null)
			return mb_substr($this->news->title, 0, 20);
		return 'Без новости';
	}
	
	/**
	 * Return ID of news which contain this comment.
	 * for edit comment page
	 *
	 * @return int
	 */
	public function getNewsID() {
		return $this->news != null ? $this->news->id : null;
	}
	
}
