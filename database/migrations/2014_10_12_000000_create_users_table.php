<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('permission')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        User::create(['name' => 'store', 'email' => 'store@gmail.com', 'password' => Hash::make('St123456'), 'permission' => 0]);
        User::create(['name' => 'Marcsi', 'email' => 'student1@gmail.com', 'password' => Hash::make('Aa123456'), 'permission' => 2]);
        User::create(['name' => 'Iván', 'email' => 'student2@gmail.com', 'password' => Hash::make('Aa123456')]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
