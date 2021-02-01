<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EntrustSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create('roles', function (Blueprint $table) {
            $table->id('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->string('allowed_route')->nullable();
            $table->timestamps();
        });


        // Create table for storing permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->id('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->string('route')->nullable();
            $table->string('module')->nullable();
            $table->string('as')->nullable();
            $table->string('icon')->nullable();
            $table->unsignedTinyInteger('parent')->default(0);
            $table->unsignedTinyInteger('parent_show')->default(0);
            $table->unsignedTinyInteger('parent_original')->default(0);
            $table->unsignedTinyInteger('sidebar_link')->default(1);
            $table->unsignedTinyInteger('appear')->default(0);
            $table->unsignedBigInteger('ordering')->default(0);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('permissions');
        Schema::drop('roles');
    }
}
