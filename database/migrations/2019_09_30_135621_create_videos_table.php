<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->unsignedBigInteger('course_id');
            $table->string('url');
            $table->string('tag');
            $table->text('summery');
            $table->text('detail');
            $table->string('image')->nullable();
            $table->string('viewed',20)->default(0);
            $table->string('like',20)->default(0);
            $table->string('time',10)->nullable();
            $table->string('price')->nullable();
            $table->enum('status',['0','1'])->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
