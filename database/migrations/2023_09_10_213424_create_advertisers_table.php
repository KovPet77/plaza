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
        Schema::create('advertisers', function (Blueprint $table) {
            
            $table->id();
            $table->string('name');
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();


            // Az enum() metódus a Laravelben a migrációkban használható, és lehetővé teszi,
            //  hogy az adatbázisban egy oszlop értékei csak egy előre meghatározott listából 
            //  választhatók ki.
            //  Ez azt jelenti, hogy a role oszlop értéke csak 'user' vagy 'admin' lehet. 
            //  Ha az adatbázisba más érték kerülne beillesztésre, akkor hibaüzenet jelenik meg.

            // Az enum() metódus hasznos lehet, ha bizonyos oszlopok csak korlátozott értékeket vehetnek fel, 
            // például ha csak néhány különböző szerepkör lehetséges a felhasználók számára. 
            // Ezzel megakadályozható, hogy rossz adatok kerüljenek az adatbázisba, és az adatok
            //  konzisztenciájának fenntartása is biztosított. 
            // Az enum() metódus használata segít meghatározni a valid értékeket az adott oszlop számára, 
            // és megkönnyíti a fejlesztők munkáját.
            $table->enum('role', ['admin', 'vendor', 'user'])->default('user');
            $table->enum('status', ['active', 'inactive',])->default('active');


            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisers');
    }
};
