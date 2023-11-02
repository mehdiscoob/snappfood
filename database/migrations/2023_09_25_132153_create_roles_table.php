<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->index("name");
            $table->timestamps();
            $table->softDeletes();

        });

        // Insert data for roles
        DB::table('roles')->insert([
            ['name' => 'admin'],
            ['name' => 'normal'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
