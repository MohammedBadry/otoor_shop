<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->boolean('is_default')->unique()->nullable();
            $table->timestamps();
        });
        Schema::create('currency_translations', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('currency_id');
            $table->string('name')->nullable();
            $table->string('symbol')->nullable();
            $table->string('locale')->index();
            $table->unique(['currency_id', 'locale']);
            $table->foreign('currency_id')->references('id')->on('currencies')->cascadeOnDelete();
        });
        Schema::create('currency_exchange_rates', function (Blueprint $table) {
            $table->id('id');
            $table->date('day');
            $table->foreignId('currency_from');
            $table->foreign('currency_from')->references('id')->on('currencies')->cascadeOnDelete();
            $table->foreignId('currency_to');
            $table->foreign('currency_to')->references('id')->on('currencies')->cascadeOnDelete();
            $table->float('rate');
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
        Schema::dropIfExists('currency_exchange_rates');
        Schema::dropIfExists('currency_translations');
        Schema::dropIfExists('currencies');
    }
}
