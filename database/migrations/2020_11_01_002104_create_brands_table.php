<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id('id');
            $table->timestamps();
        });

        Schema::create('brand_translations', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('brand_id');
            $table->string('name')->nullable();
            $table->string('locale')->index();
            $table->unique(['brand_id', 'locale']);
            $table->foreign('brand_id')->references('id')->on('brands')->cascadeOnDelete();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brand_translations');
        Schema::dropIfExists('brands');
    }
}
