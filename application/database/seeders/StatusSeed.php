<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            'Aberta',
            'Em Desenvolvimento',
            'Concluída',
            'Em Atraso'
        ];

        foreach ($status as $st) {
            $verificaStatus = Status::where('descricao', $st)->first();

            if(!$verificaStatus)
            {
                Status::create([
                    'descricao' => $st
                ]);
            }
        }
    }
}
