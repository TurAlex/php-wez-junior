<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class News extends Model {
	protected $fillable = [ 'title', 'content', 'intro', 'slug', 'image' ];
	
	use Sluggable;
	
	/**
	 * Return the sluggable configuration array for this model.
	 *
	 * @return array
	 */
	public function sluggable() {
		return [
			'slug' => [
				'source' => 'title'
			]
		];
	}
	
	/**
	 * Return comments related to news.
	 *
	 * @return object
	 */
	public function comments() {
		return $this->hasMany( Comment::class );
	}
	
	/**
	 * Return all active comments related to news.
	 *
	 * @return Collection
	 */
	public function getComments() {
		return $this->comments()->where( 'status', 1 )->get();
	}
	
	/**
	 * Save all protected fields to base of new news.
	 *
	 * @return object
	 */
	public static function add( $fields ) {
		$news = new static;
		$news->fill( $fields );
		$news->save();
		return $news;
	}
	
	/**
	 * Fill and Save all protected fields to db.
	 *
	 */
	public function edit( $fields ) {
		$this->fill( $fields );
		$this->save();
	}
	
	/**
	 * Remove data from db and image from storage.
	 *
	 */
	public function remove() {
		$this->removeImage();
		$this->delete();
	}
	
	/**
	 * Upload image to public/uploads with random name.
	 *
	 */
	public function uploadImage( $image ) {
		if ( $image == null ) {
			return;
		}
		$this->removeImage();
		$imagename = str_random( 10 ) . '.' . $image->extension();
		$image->storeAs( 'uploads/', $imagename );
		$this->image = $imagename;
		$this->save();
	}
	
	/**
	 * Remove image form public/uploads while removing news data.
	 *
	 */
	public function removeImage() {
		if ( $this->image != null ) {
			Storage::delete( 'uploads/' . $this->image );
		}
	}
	
	/**
	 * Set to draft news item.
	 *
	 */
	public function setDraft() {
		$this->status = 0;
		$this->save();
	}
	
	/**
	 * Set to public news item.
	 *
	 */
	public function setPublic() {
		$this->status = 1;
		$this->save();
	}
	
	/**
	 * Toggle draft/public news item.
	 *
	 */
	public function toggleStatus() {
		if ( $this->status == null ) {
			return $this->setPublic();
		}
		
		return $this->setDraft();
	}
	
	/**
	 * Set status of news while storing or updating.
	 *
	 */
	public function setStatus( $status ) {
		if ( $status == null ) {
			return $this->setDraft();
		}
		
		return $this->setPublic();
	}
	
	/**
	 * Get image name.
	 *
	 * @return string
	 */
	public function getImage() {
		if ( $this->image == null ) {
			return '/uploads/no-image-available.png';
		}
		
		return '/uploads/' . $this->image;
	}
	
	/**
	 * Get news date created in format May 7, 2018.
	 *
	 * @return string
	 */
	public function getDate() {
		return $this->created_at->format( 'F d, Y' );
	}
	
	
}
