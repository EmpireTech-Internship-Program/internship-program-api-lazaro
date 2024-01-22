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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade');
            $table->bigInteger('person_cpf');
            $table->string('agency_name');
            $table->string('type');
            $table->integer('number')->unique();
            $table->string('holder');
            $table->integer('opening_balance');
            $table->date('opening_date');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('person_cpf')->references('cpf')->on('people')->onUpdate('cascade');
            $table->foreign('agency_name')->references('name')->on('agencies')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
