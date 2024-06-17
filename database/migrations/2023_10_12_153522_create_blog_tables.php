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
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('count_posts')->default(0);
            $table->timestamps();
        });

        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('date');
            $table->text('description');
            $table->text('content');
            $table->string('author');
            $table->string('slugurl');
            $table->string('image')->nullable();
            $table->string('thumb')->nullable();
            $table->integer('visits')->default(0);
            $table->boolean('publish')->default(1);
            $table->text('tags')->nullable();

            $table->unsignedBigInteger('id_category');
            $table->foreign('id_category')->references('id')->on('blog_categories')->onDelete('cascade');

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
        Schema::dropIfExists('blog_posts');
        Schema::dropIfExists('blog_categories');
    }
};
