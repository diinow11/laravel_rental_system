<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseUnitsTable extends Migration
{
    public function up()
    {
        Schema::create('house_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apartment_id')->constrained()->onDelete('cascade');
            $table->string('unit_label');
            $table->string('type');
            $table->unsignedInteger('rent');
            $table->unsignedInteger('deposit');
            $table->unsignedInteger('water_utility')->default(0);
            $table->unsignedInteger('electricity_utility')->default(0);
            $table->unsignedTinyInteger('bedrooms')->default(0);
            $table->unsignedTinyInteger('bathrooms')->default(0);
            $table->unsignedTinyInteger('kitchens')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('house_units');
    }
}
