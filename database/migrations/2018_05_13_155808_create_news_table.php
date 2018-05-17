<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'news', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->string( 'title' );
			$table->string( 'slug' );
			$table->text( 'intro' );
			$table->text( 'content' );
			$table->string( 'image' )->default('no-image-available.png');
			$table->boolean( 'status' )->default( 0 );
			$table->timestamps();
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'news' );
	}
}
