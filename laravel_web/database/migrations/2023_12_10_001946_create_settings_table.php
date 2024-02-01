<?php

use App\Models\Setting;
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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('label');
            $table->string('value')->nullable();
            $table->string('type');
            $table->timestamps();
        });

        //Default Set
        Setting::create([
            'key' => '_site_name',
            'label' => 'Judul Situs',
            'value' => 'AppLoam Studio',
            'type' => 'text',
        ]);
        Setting::create([
            'key' => '_location',
            'label' => 'Location',
            'value' => 'Jakarta, Indonesia',
            'type' => 'text',
        ]);
        Setting::create([
            'key' => '_youtube',
            'label' => 'Youtube',
            'value' => 'https://www.youtube.com/@litovlr',
            'type' => 'text',
        ]);
        Setting::create([
            'key' => '_instagram',
            'label' => 'Instagram',
            'value' => 'https://www.instagram.com/ferdyrenn',
            'type' => 'text',
        ]);
        Setting::create([
            'key' => '_upwork',
            'label' => 'UpWork',
            'value' => 'https://www.upwork.com/agencies/1732910819461906432/',
            'type' => 'text',
        ]);
        Setting::create([
            'key' => '_site_description',
            'label' => 'Site Description',
            'value' => 'Official Website of AppLoom Studio',
            'type' => 'text',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
