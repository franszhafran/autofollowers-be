<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_history', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreignId("package_id")->references("id")->on("package")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_history');
    }
}
