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
        Schema::create('organization_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained();
            $table->foreignId('organization_batch_id')->constrained();
            $table->foreignId('organization_user_id')->constrained()->onDelete('cascade')->comment('The user who made the payment');
            $table->string('account_provider');
            $table->string('account_name');
            $table->string('account_number');
            $table->float('amount');
            $table->date('payment_date');
            $table->string('status');
            $table->boolean('is_recurring')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_payments');
    }
};
