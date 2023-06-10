<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_roles', function (Blueprint $table) {
            $table->id();
            $table->integer('applicationid')->nullable();
            $table->integer('roleid')->nullable();
            $table->integer('create')->default(0);
            $table->integer('read')->default(0);
            $table->integer('update')->default(0);
            $table->integer('delete')->default(0);
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
        Schema::dropIfExists('application_roles');
    }
};
