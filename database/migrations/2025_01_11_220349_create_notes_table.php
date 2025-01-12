<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('title');  // Note title
            $table->enum('type', ['text', 'pdf']);  // Type of note: text or pdf
            $table->text('body')->nullable();  // Body for text notes
            $table->string('pdf_url')->nullable();  // URL to PDF file (for pdf notes)
            $table->boolean('is_shared')->default(false);  // Whether the note is shared or private
            $table->foreignId('folder_id')->constrained('folders');  // Foreign key to the folders table
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
        Schema::dropIfExists('notes');
    }
}
