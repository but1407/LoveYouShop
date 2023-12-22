<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('parent_id');
            $table->text('description')->nullable();
            $table->text('image_link')->nullable();
            $table->text('slug');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
    Illuminate\Database\Eloquent\Relations\Concerns\SupportsDefaultModels
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};