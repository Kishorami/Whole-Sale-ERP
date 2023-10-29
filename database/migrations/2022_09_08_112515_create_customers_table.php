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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('firm_name');
            $table->string('trade_license');
            $table->string('income_tax_no');
            $table->string('bin_no');
            $table->string('contact_person');
            $table->string('nid_no');
            $table->string('present_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('land_phone')->nullable();
            $table->string('email')->nullable();
            $table->float('credit_limit')->default(0);
            $table->float('balance')->default(0);
            $table->float('point')->default(0);
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
        Schema::dropIfExists('customers');
    }
};
