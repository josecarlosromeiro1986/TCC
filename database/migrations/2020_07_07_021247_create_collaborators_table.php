<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollaboratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collaborators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('office_id')->constrained('offices');
            $table->string('name');
            $table->string('rg', 9);
            $table->string('cpf', 14);
            $table->date('birth');
            $table->string('cep', 9);
            $table->string('address');
            $table->integer('number');
            $table->string('complement');
            $table->string('city');
            $table->string('neighborhood');
            $table->string('email');
            $table->string('user');
            $table->string('password', 10);
            $table->mediumText('note')->nullable();
            $table->enum('active', ['Y', 'N'])->default('Y');
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
        Schema::dropIfExists('collaborators');
    }
}
