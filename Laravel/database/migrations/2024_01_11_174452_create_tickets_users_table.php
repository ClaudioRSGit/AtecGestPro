<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('contact')->unique();
            $table->string('password')->nullable();
            $table->string('notes')->nullable();
            $table->boolean('isActive')->default(false);
            $table->boolean('isStudent')->default(false);
            $table->foreignId('course_class_id')->nullable()->constrained('course_classes')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('tickets_users');
    }
}
