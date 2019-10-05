<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('tag');
            $table->text('summery');
            $table->text('detail');
            $table->string('image');
            $table->unsignedBigInteger('cat_id');
            $table->string('viewed',20)->default(0);
            $table->string('like',20)->default(0);
            $table->string('video_num',10)->default(0);
            $table->string('price')->nullable();
            $table->enum('end',['0','1'])->default(0);
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
        Schema::dropIfExists('courses');
    }
}
