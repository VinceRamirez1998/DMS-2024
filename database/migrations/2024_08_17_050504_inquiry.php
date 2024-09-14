<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inquiry', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('title');
            $table->string('position');
            $table->string('location');
            $table->string('file')->nullable();
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->string('access')->nullable();
            $table->string('department')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
