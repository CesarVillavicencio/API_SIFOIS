<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('gallery_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('count_photos')->default(0);
            $table->timestamps();
        });

        Schema::create('gallery_photos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image');
            $table->string('thumb');

            $table->unsignedBigInteger('id_category');
            $table->foreign('id_category')->references('id')->on('gallery_categories')->onDelete('cascade');

            $table->unsignedBigInteger('id_admin_user');
            $table->foreign('id_admin_user')->references('id')->on('admin_users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('gallery_photos');
        Schema::dropIfExists('gallery_categories');
    }
};
