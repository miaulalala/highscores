<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateHighscoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('highscores', function (Blueprint $table) {
            $table->foreign('d_id')
            ->references('d_id')
            ->on('difficulties')
            ->onDelete('no action')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('highscores', function (Blueprint $table) {
            $table->dropForeign('highscores_d_id_foreign');
        });
    }
}
