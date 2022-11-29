<?php

use App\Models\Copy;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('copies', function (Blueprint $table) {
            $table->id('copy_id');
            $table->foreignId('book_id')->references('book_id')->on('books');
            $table->boolean('hardcovered')->default(0);
            $table->year('publication')->default(2000);
            $table->integer('status')->default(0);
            $table->timestamps();
        });

        Copy::create(['book_id'=>2, 'publication' =>1996, 'status'=>1]);
        Copy::create(['book_id'=>3, 'status'=>1]);
        Copy::create(['book_id'=>3, 'publication' =>2011]);
        Copy::create(['book_id'=>3, 'hardcovered'=> 1]);
        Copy::create(['book_id'=>3, 'status'=>2]);
        Copy::create(['book_id'=>1, 'status'=>1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('copies');
    }
};
