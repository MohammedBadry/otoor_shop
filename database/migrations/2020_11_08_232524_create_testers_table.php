<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testers', function (Blueprint $table) {
            $table->id('id');
            $table->decimal('price', 10, 3);
            $table->timestamps();
        });

        Schema::create('tester_translations', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('tester_id');
            $table->string('name')->nullable();
            $table->string('locale')->index();
            $table->unique(['tester_id', 'locale']);
            $table->foreign('tester_id')->references('id')->on('testers')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tester_translations');
        Schema::dropIfExists('testers');
    }
}
