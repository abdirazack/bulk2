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
        Schema::create('organization_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_user_id')->constrained()->onDelete('cascade')->comment('The user who uploaded the batch');
            $table->string('batch_number');
            $table->integer('total_records');
            $table->float('total_amount');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['organization_user_id', 'batch_number']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_batches');
    }
};
