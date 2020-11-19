<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id('id');
            $table->string('code');
            $table->unsignedInteger('value')->default(0);
            $table->decimal('min_total', 10, 3);
            $table->unsignedInteger('usage_count');
            $table->unsignedInteger('usage_per_user');
            $table->timestamps();
        });

        Schema::create('coupon_translations', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('coupon_id');
            $table->string('name')->nullable();
            $table->string('locale')->index();
            $table->unique(['coupon_id', 'locale']);
            $table->foreign('coupon_id')->references('id')->on('coupons')->cascadeOnDelete();
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('coupon_id')->nullable();
            $table->foreign('coupon_id')->references('id')->on('coupons')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon_translations');
        Schema::dropIfExists('coupons');
    }
}
