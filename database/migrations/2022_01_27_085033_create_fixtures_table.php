<?php

use App\Models\Team;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixtures', function (Blueprint $table) {
            $table->id();            
            $table->foreignId('home_id')->references('id')->on('teams')->nullable();
            $table->foreignId('away_id')->references('id')->on('teams')->nullable();     
            $table->integer('homeGoal')->nullable();
            $table->integer('awayGoal')->nullable();      
            $table->integer('week')->nullable();
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
        Schema::dropIfExists('fixtures');
    }
}
