<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationInTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('assigned_to_user_id')->nullable();
            // $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('priority_id');

            $table->foreign('created_by')->references('id')->on('users');

            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('service_id')->references('id')->on('services');
            //$table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('assigned_to_user_id')->references('id')->on('users');
            $table->foreign('priority_id')->references('id')->on('priorities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            //
        });
    }
}
