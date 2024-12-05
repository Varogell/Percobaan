<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStimulusTable extends Migration
{
    public function up()
    {
        Schema::create('stimulus', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('path'); // Lokasi file video
            $table->boolean('is_published')->default(false); // Status publikasi
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stimulus');
    }
}

