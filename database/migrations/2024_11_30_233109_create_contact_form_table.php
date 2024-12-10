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
        Schema::create('contact_form', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('telephone_number')->unique();
            $table->enum('country', [
                'Albania',
                'Andorra',
                'Armenia',
                'Austria',
                'Azerbaijan',
                'Belarus',
                'Belgium',
                'Bosnia and Herzegovina',
                'Bulgaria',
                'Croatia',
                'Cyprus',
                'Czech Republic',
                'Denmark',
                'Estonia',
                'Finland',
                'France',
                'Georgia',
                'Germany',
                'Greece',
                'Hungary',
                'Iceland',
                'Ireland',
                'Italy',
                'Kazakhstan',
                'Kosovo',
                'Latvia',
                'Liechtenstein',
                'Lithuania',
                'Luxembourg',
                'Malta',
                'Moldova',
                'Monaco',
                'Montenegro',
                'Netherlands',
                'North Macedonia',
                'Norway',
                'Poland',
                'Portugal',
                'Romania',
                'Russia',
                'San Marino',
                'Serbia',
                'Slovakia',
                'Slovenia',
                'Spain',
                'Sweden',
                'Switzerland',
                'Turkey',
                'Ukraine',
                'United Kingdom',
                'Vatican City',
                'Antigua and Barbuda',
                'Bahamas',
                'Barbados',
                'Belize',
                'Canada',
                'Costa Rica',
                'Cuba',
                'Dominica',
                'Dominican Republic',
                'El Salvador',
                'Grenada',
                'Guatemala',
                'Haiti',
                'Honduras',
                'Jamaica',
                'Mexico',
                'Nicaragua',
                'Panama',
                'Saint Kitts and Nevis',
                'Saint Lucia',
                'Saint Vincent and the Grenadines',
                'Trinidad and Tobago',
                'United States'
            ]);
            $table->text('subject');
            $table->text('message');
            $table->boolean('is_read')->default(false); // Mark as unread by default
            $table->softDeletes(); // For soft delete functionality
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_form');
    }
};
