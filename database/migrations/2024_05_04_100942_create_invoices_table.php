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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->text('invoice');
            $table->unsignedBigInteger('customer_id');
            $table->bigInteger('cost_ongkir');
            $table->integer('weight');
            $table->string('name');
            $table->bigInteger('phone');
            $table->integer('kabupaten');
            $table->integer('kecamatan');
            $table->text('address');
            $table->enum('status', array('pending', 'success', 'failed', 'expired'));
            $table->string('snap_token')->nullable();
            $table->bigInteger('grand_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
