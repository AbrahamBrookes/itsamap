<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapPointersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_pointers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
			$table->string('title', 255);
			$table->text('content')->nullable;
			$table->decimal('lng', 10, 7);
			$table->decimal('lat', 10, 7);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('map_pointers');
    }
}
