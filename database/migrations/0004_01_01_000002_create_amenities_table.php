<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('amenity', function (Blueprint $table) {
            $table->increments('id');
            $table->string('icon')->nullable();
            $table->string('photo')->nullable();
            $table->boolean("is_active")->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('amenity_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amenity_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->unique(['amenity_id', 'locale']);
            $table->foreign('amenity_id')->references('id')->on('amenity')->onDelete('cascade');
        });

    }


    public function down(): void {
        Schema::dropIfExists('amenity_lang');
        Schema::dropIfExists('amenity');
    }
};
