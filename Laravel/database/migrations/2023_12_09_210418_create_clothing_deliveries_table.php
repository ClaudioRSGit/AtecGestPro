<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClothingDeliveriesTable extends Migration
{
    public function up()
    {
        Schema::create('clothing_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('delivered')->default(false);
            $table->string('additionalNotes')->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('clothing_deliveries');
    }
}
