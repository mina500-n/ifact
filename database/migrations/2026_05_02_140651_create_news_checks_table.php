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
    Schema::create('news_checks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->text('content');
        $table->string('source_url')->nullable();
        $table->string('result')->nullable();        // real / fake / uncertain
        $table->float('credibility_score')->nullable(); // 0 to 100
        $table->string('sentiment')->nullable();     // positive / negative / neutral
        $table->json('ai_details')->nullable();      // full AI response
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_checks');
    }
};
