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
        Schema::create('org_role_user', function (Blueprint $table) {
            $table->foreignId('org_role_id')->constrained()->onDelete('cascade');
            $table->foreignId('organization_user_id')->constrained()->onDelete('cascade');
            $table->primary(['org_role_id', 'organization_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
