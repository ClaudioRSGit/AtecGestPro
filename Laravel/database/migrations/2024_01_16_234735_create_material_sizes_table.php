<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_sizes', function (Blueprint $table) {
            $table->id();
            $table->integer('stock')->default(0);
            $table->foreignId('material_id')->constrained('materials')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('size_id')->constrained('sizes')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_sizes');
    }
}
