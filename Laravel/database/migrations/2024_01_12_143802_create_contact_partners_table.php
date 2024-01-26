<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_partners', function (Blueprint $table) {
            $table->id();
            $table->string('contact')->nullable()->unique();
            $table->string('description')->nullable();
            $table->foreignId('partner_id')->constrained('partners')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_partners');
    }
}
