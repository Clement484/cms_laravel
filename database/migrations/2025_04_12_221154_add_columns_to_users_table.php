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
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_photo')->nullable()->after('email');
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->text('bio')->nullable();
            $table->string('role')->default('user');
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('joined_at')->nullable();
            $table->json('social_links')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_photo');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('gender');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('bio');
            $table->dropColumn('role');
            $table->dropColumn('is_active');
            $table->dropColumn('last_login_at');
            $table->dropColumn('joined_at');
            $table->dropColumn('social_links');
        });
    }
};
