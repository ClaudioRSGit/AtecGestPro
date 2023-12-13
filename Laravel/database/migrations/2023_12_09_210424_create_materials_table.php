<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->boolean('isInternal');
            $table->integer('quantity');
            $table->dateTime('aquisition_date')->nullable();
            $table->string('supplier')->nullable();
            $table->boolean('isClothing')->default(false);
            $table->boolean('gender')->nullable();
            $table->string('size')->nullable();
            $table->string('role')->nullable();
            $table->boolean('isDeleted')->default(false);
            $table->timestamps();
            $table->softDeletes('DeletedAt', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials');
    }
}
