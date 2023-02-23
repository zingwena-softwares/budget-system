<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description')->nullable();
            $table->string('category_id')->nullable();
            $table->string('program_id')->nullable();
            $table->string('unit_measure')->nullable();
            $table->string('period')->nullable();
            $table->string('quantity')->nullable();
            $table->decimal('amount', 15, 2);
            $table->decimal('total_exclusive', 15, 2);
            $table->decimal('vat', 15, 2);
            $table->decimal('total_inclusive', 15, 2);
            $table->timestamps();

            $table->softDeletes();
        });
    }
}
