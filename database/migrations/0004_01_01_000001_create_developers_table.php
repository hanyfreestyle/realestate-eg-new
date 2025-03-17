<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('developers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("slug");
            $table->integer("slug_count")->nullable();
            $table->string("photo")->nullable();
            $table->string("photo_thum_1")->nullable();
            $table->integer("projects_count")->default(0);
            $table->integer("units_count")->default(0);
            $table->boolean("is_active")->default(true);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('developer_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('developer_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->longText('des')->nullable();
            $table->string('g_title')->nullable();
            $table->text('g_des')->nullable();
            $table->unique(['developer_id', 'locale']);
            $table->foreign('developer_id')->references('id')->on('developers')->onDelete('cascade');
        });

//        Schema::create('developer_photos', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->bigInteger('developer_id')->unsigned();
//            $table->string("photo")->nullable();
//            $table->string("photo_thum_1")->nullable();
//            $table->string("photo_thum_2")->nullable();
//            $table->string("file_extension")->nullable();
//            $table->integer("file_size")->nullable();
//            $table->integer("file_h")->nullable();
//            $table->integer("file_w")->nullable();
//            $table->integer("position")->default(0);
//            $table->integer("is_default")->default(0);
//            $table->softDeletes();
//            $table->timestamps();
//            $table->foreign('developer_id')->references('id')->on('developers')->onDelete('cascade');
//        });

    }

    public function down(): void {
//        Schema::dropIfExists('developer_photos');
        Schema::dropIfExists('developer_translations');
        Schema::dropIfExists('developers');
    }
};
