<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForcastingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forcastings', function (Blueprint $table) {
            $table->id();
            $table->string('periode');
            $table->integer('aktual')->nullable(0);
            $table->double('s1')->nullable()->default(0);
            $table->double('s2')->nullable()->default(0);
            $table->double('a')->nullable()->default(0);
            $table->double('b')->nullable()->default(0);
            $table->double('f')->nullable()->default(0);
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
        Schema::dropIfExists('forcastings');
    }
}
