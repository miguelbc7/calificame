<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            'id' => 1,
            'question' => '¿Te atendieron con una sonrisa?',
            'type' => 1,
            'user_id' => 1,
        ]);
        DB::table('questions')->insert([
            'id' => 2,
            'question' => '¿Cómo consideras la actitud de servicio del personal? ',
            'type' => 2,
            'user_id' => 1,
        ]);
        DB::table('questions')->insert([
            'id' => 3,
            'question' => '¿Cómo consideras la disposición del personal para ayudarte?',
            'type' => 2,
            'user_id' => 1,
        ]);
        DB::table('questions')->insert([
            'id' => 4,
            'question' => '¿El personal estuvo atento en todo momento?',
            'type' => 1,
            'user_id' => 1,
        ]);
        DB::table('questions')->insert([
            'id' => 5,
            'question' => '¿Cómo consideras el tiempo de espera de tu pedido?',
            'type' => 2,
            'user_id' => 1,
        ]);
        DB::table('questions')->insert([
            'id' => 6,
            'question' => '¿Cómo consideras la relación precio/calidad de tu consumo?',
            'type' => 2,
            'user_id' => 1,
        ]);
        DB::table('questions')->insert([
            'id' => 7,
            'question' => '¿Cómo consideras la calidad de nuestra comida?',
            'type' => 2,
            'user_id' => 1,
        ]);
        DB::table('questions')->insert([
            'id' => 8,
            'question' => '¿Qué te parecieron nuestras habitaciones?',
            'type' => 2,
            'user_id' => 1,
        ]);
        DB::table('questions')->insert([
            'id' => 9,
            'question' => '¿Qué te pareció el servicio a la habitación?',
            'type' => 2,
            'user_id' => 1,
        ]);
        DB::table('questions')->insert([
            'id' => 10,
            'question' => '¿Qué te parecieron nuestras instalaciones?',
            'type' => 2,
            'user_id' => 1,
        ]);
        DB::table('questions')->insert([
            'id' => 11,
            'question' => '¿Cómo consideras la limpieza de tu habitación?',
            'type' => 2,
            'user_id' => 1,
        ]);
        DB::table('questions')->insert([
            'id' => 12,
            'question' => '¿Cómo consideras la limpieza del restaurante?',
            'type' => 2,
            'user_id' => 1,
        ]);
        DB::table('questions')->insert([
            'id' => 13,
            'question' => '¿Obtuviste todo lo que necesitabas durante tu estadía?',
            'type' => 1,
            'user_id' => 1,
        ]);
        DB::table('questions')->insert([
            'id' => 14,
            'question' => '¿Cómo consideras la limpieza de nuestras instalaciones?',
            'type' => 2,
            'user_id' => 1,
        ]);
        DB::table('questions')->insert([
            'id' => 15,
            'question' => '¿Nos recomendarías con tus amigos?',
            'type' => 1,
            'user_id' => 1,
        ]);
    }
}
