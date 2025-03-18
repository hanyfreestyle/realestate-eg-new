<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('location', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string("slug")->unique();
            $table->string('projects_type')->nullable();
            $table->string("photo")->nullable();
            $table->string("photo_thumbnail")->nullable();
            $table->integer("sort_order")->nullable();
            $table->double("latitude")->nullable();
            $table->double('longitude')->nullable();
            $table->boolean("is_active")->default(true);
            $table->boolean("is_searchable")->default(false);
            $table->integer("is_home")->nullable();
            $table->integer("projects_count")->nullable();
            $table->integer("units_count")->nullable();
            $table->index("slug");
            $table->timestamps();
            $table->softDeletes();
//            $table->foreign('parent_id')->references('id')->on('location')->onDelete('restrict');
        });

        Schema::create('location_lang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('location_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->text('des')->nullable();
            $table->string('g_title')->nullable();
            $table->text('g_des')->nullable();
            $table->unique(['location_id','locale']);
            $table->foreign('location_id')->references('id')->on('location')->onDelete('cascade');
        });

    }


    public function down(): void {
        Schema::dropIfExists('location_lang');
        Schema::dropIfExists('location');
    }
};
