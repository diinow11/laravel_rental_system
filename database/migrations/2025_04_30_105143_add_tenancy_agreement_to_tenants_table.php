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
        Schema::table('tenants', function (Blueprint $table) {
            $table->string('tenancy_agreement')->nullable()->after('id_number');
        });
    }
    
    public function down()
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn('tenancy_agreement');
        });
    }
};
