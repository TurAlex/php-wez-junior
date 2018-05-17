<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
	protected $fillable = ['name', 'email' , 'content'];
	
	
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
	 * Set status of review while storing or updating.
	 *
	 */
	public function setStatus( $status ) {
		if ( $status == null ) {
			return $this->disallow();
		}
		return $this->allow();
	}
	
	/**
	 * Remove source from db.
	 *
	 */
	public function remove() {
		$this->delete();
	}
	
	
}
