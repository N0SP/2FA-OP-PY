<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCodesTable extends Migration
{
    public function up()
    {
        Schema::create('user_codes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('code');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_codes');
    }
}
