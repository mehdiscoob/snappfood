<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false); // Not null
            $table->string('family')->nullable(false); // Not null
            $table->char('national_code', 11)->nullable(false)->unique(); // Not null and unique
            $table->date('birthday')->nullable(false); // Not null
            $table->string('mobile_number', 11)->nullable(false)->unique(); // Not null and unique
            // ... other columns if needed

            $table->softDeletes();
            $table->timestamps();

            // Indexes
            $table->index(['name', 'family']);
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
        Schema::dropIfExists('agents');
    }
}

