<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')->index();
            $table->foreignIdFor(\App\Models\TypeInvestiment::class, 'type_investiment_id')->index();
            $table->string('active_code')->nullable()->index();
            $table->float('price');
            $table->float('last_dividend');
            $table->integer('recommended_percentage')->nullable();
            $table->integer('magic_number');
            $table->integer('total_quotas_contributed');
            $table->integer('missing_for_magic_number');
            $table->string('type')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actions');
    }
};
