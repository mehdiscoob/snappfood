<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->nullable()->unique();
            $table->string('verification_code')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('password');
            $table->string('api_token')->nullable();
            $table->boolean('verified')->default(false);
            $table->rememberToken();
            $table->index("email");
            $table->timestamps();
            $table->softDeletes();
        });
        // Insert data for roles
        DB::table('users')->insert([
            ['name' => 'super_admin',"email"=>"admin@gmail.com","password"=>"1234","api_token"=>\Illuminate\Support\Str::random(60)],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
