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
        Schema::table('invoices', function (Blueprint $table) {
            if (!Schema::hasColumn('invoices', 'phone_number')) {
                $table->string('phone_number')->nullable()->after('tenant_id');
            }
            if (!Schema::hasColumn('invoices', 'apartment')) {
                $table->string('apartment')->nullable();
            }
            if (!Schema::hasColumn('invoices', 'house_unit')) {
                $table->string('house_unit')->nullable();
            }
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    Schema::table('invoices', function (Blueprint $table) {
        $table->dropColumn(['phone_number', 'apartment', 'house_unit']);
    });
}

};
