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
        Schema::create('uploaded_data', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->longText('file_data');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('organization_batch_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by')->references('id')->on('organization_users');
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->foreign('organization_batch_id')->references('id')->on('organization_batches');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploaded_data');
    }
};
