<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('contact');
            $table->string('description')->nullable();
            $table->foreignId('partner_id')->constrained('partners')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('partner_contacts');
    }
}
