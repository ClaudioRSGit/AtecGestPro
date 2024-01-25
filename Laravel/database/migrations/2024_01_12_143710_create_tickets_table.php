<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->string('description');
            $table->dateTime('dueByDate');
            $table->string('attachment')->nullable();
            $table->foreignId('ticket_status_id')->constrained('ticket_statuses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('ticket_priority_id')->constrained('ticket_priorities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('ticket_category_id')->constrained('ticket_categories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('tickets');
    }
}
