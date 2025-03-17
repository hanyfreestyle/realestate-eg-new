<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('developer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("slug");
            $table->string("photo")->nullable();
            $table->string("photo_thumbnail")->nullable();
            $table->boolean("is_active")->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('developer_lang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('developer_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->longText('des')->nullable();
            $table->string('g_title')->nullable();
            $table->text('g_des')->nullable();
            $table->unique(['developer_id', 'locale']);
            $table->foreign('developer_id')->references('id')->on('developer')->onDelete('cascade');
        });

    }

    public function down(): void {
        Schema::dropIfExists('developer_lang');
        Schema::dropIfExists('developer');
    }
};
