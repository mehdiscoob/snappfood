<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false); // Not null
            $table->string('family')->nullable(false); // Not null
            $table->char('national_code', 11)->nullable(false)->unique(); // Not null and unique
            $table->date('birthday')->nullable(false); // Not null
            $table->string('mobile_number',11)->nullable(false)->unique(); // Not null
            $table->softDeletes();
            $table->timestamps();
            $table->index(['family', 'name']);
            $table->index('mobile_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drivers');
    }
}
