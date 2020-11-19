<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id('id');
            $table->decimal('price', 10, 3);
            $table->timestamps();
        });

        Schema::create('collection_translations', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('collection_id');
            $table->string('name')->nullable();
            $table->string('locale')->index();
            $table->unique(['collection_id', 'locale']);
            $table->foreign('collection_id')->references('id')->on('collections')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collection_translations');
        Schema::dropIfExists('collections');
    }
}
