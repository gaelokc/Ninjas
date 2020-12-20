<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->date('mission_date');
            $table->text('description');
            $table->UnsignedInteger('minimun_ninjas_required');
            $table->enum('priority', ['casual', 'urgent']);
            $table->String('payment', 100);
            $table->enum('status', ['pendent', 'active', 'completed', 'failed']);
            $table->date('mission_end_date');
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
        Schema::dropIfExists('missions');
    }
}