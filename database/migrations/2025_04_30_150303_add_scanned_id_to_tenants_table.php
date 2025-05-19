<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tenants', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->string('scanned_id')->nullable()->after('tenancy_agreement');
        });
    }
    
    public function down()
    {
        Schema::table('tenants', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->dropColumn('scanned_id');
        });
    }
    
};
