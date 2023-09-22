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
            $table->Enum('user_type',['admin','user'])->default('user')->after('password');
            $table->foreignId(column:'state_id')->constrained('states')->after('password');
            $table->foreignId(column:'city_id')->constrained('cities')->after('password');
            $table->string('address')->nullable()->after('password');
            $table->string('phone')->nullable()->after('password');
            $table->string('username')->after('password');
            $table->string('avatar')->nullable()->after('password');
            $table->softDeletes();
        });

        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
