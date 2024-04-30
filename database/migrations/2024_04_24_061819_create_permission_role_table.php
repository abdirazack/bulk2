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
        Schema::create('org_permission_org_role', function (Blueprint $table) {
            $table->foreignId('org_permission_id')->constrained()->onDelete('cascade');
            $table->foreignId('org_role_id')->constrained()->onDelete('cascade');
            $table->primary(['org_permission_id', 'org_role_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_role');
    }
};
