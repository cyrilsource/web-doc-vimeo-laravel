<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddHomepageOptions extends Migration
{
    public function up()
    {
        DB::table('options')->insert([
            [
                'name'       => 'homepage_title',
                'field'      => 'Terre Commune',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'homepage_description',
                'field'      => 'Découvrez des ressources vidéo sur l\'animation socioculturelle à Genève.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down()
    {
        DB::table('options')
            ->whereIn('name', ['homepage_title', 'homepage_description'])
            ->delete();
    }
}
