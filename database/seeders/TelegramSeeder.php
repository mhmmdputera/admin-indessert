<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Telegram;

class TelegramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Telegram::create([
            'token'      => '7389251395:AAEgjJ-wYNxxjr2waDN0-nSG-fBhUo08If8',
            'user'     => 'Indessert_store',
            'id_chat'  => '1237057255'
        ]);
    }
}
