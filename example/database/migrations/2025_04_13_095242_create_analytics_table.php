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
        Schema::create('analytics', function (Blueprint $table) {
            $table->id();
            $table->integer('seed_input')->default(0);
            $table->integer('seed_response')->default(0);
            $table->integer('facebook_visitor')->default(0);
            $table->integer('instagram_visitor')->default(0);
            $table->integer('snapshort_visitor')->default(0);
            $table->integer('session_adjustment')->default(0);
            $table->integer('engagement_adjustment')->default(0);
            $table->integer('iphone_adjustment')->default(0);
            $table->integer('android_adjustment')->default(0);
            $table->integer('pc_adjustment')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analytics');
    }
};
