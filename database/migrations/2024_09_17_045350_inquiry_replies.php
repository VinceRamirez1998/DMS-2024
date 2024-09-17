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
        Schema::create('inquiry_comments', function (Blueprint $table) {
            $table->id(); // Primary key for 'inquiry_comments'
            $table->unsignedBigInteger('inquiry_id'); // Foreign key column
            $table->string('reply')->nullable(); // Column for replies
            $table->timestamps(); // Timestamps

            // Foreign key constraint
            $table->foreign('inquiry_id')
                  ->references('id')
                  ->on('inquiry') // Ensure this matches the actual table name
                  ->onDelete('cascade'); // Optional: action on deletion of the referenced record
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inquiry_comments', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['inquiry_id']);
        });

        Schema::dropIfExists('inquiry_comments');
    }
};
