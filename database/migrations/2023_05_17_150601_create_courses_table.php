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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('titre');
            $table->string('url');
            $table->longText('description');
            $table->enum('nivaeu', ['Débutant', 'Intermédiaire',  'avancée']);
            $table->double('price');
            $table->foreignId('instructor_id')->constrained('users');
            $table->foreignId('discipline_id')->constrained('disciplines');
            $table->foreignId('classe_id')->constrained('classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
