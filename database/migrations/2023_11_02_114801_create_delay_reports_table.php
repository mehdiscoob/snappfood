<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDelayReportsTable extends Migration
{
    /**
     * Run the migrations.
     * Type: '0' for setting a new time, '1' for indicating a delay.
     * @return void
     */
    public function up()
    {
        Schema::create('delay_reports', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['o', 'c'])->default('o');
            $table->enum('type', [0, 1])->default(0);
            $table->tinyInteger('delay_time')->default(0);
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index('order_id');
            $table->index('user_id');
            $table->index('delay_time');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delay_reports');
    }
}
