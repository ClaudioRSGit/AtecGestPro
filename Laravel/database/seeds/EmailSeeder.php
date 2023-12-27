<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 1
        DB::table('emails')->insert([
            'user_id' => 1,
            'recipient_email' => 'suporte@example.com',
            'subject' => 'Resolução de Problemas de Conectividade de Rede',
            'message' => 'Caro utilizador, o problema de conectividade de rede foi resolvido. Agradecemos pela sua paciência.',
            'ticket_history_id' => 1,
        ]);

        // Seed 2
        DB::table('emails')->insert([
            'user_id' => 2,
            'recipient_email' => 'desenvolvedor@example.com',
            'subject' => 'Atualização da Investigação do Relatório de Bug',
            'message' => 'Olá, estamos investigando ativamente o bug relatado. Forneceremos atualizações em breve.',
            'ticket_history_id' => 2,
        ]);

        // Seed 3
        DB::table('emails')->insert([
            'user_id' => 3,
            'recipient_email' => 'rh@example.com',
            'subject' => 'Estado do Pedido de Substituição de Hardware',
            'message' => 'Caro RH, o pedido de substituição de hardware foi concluído com sucesso.',
            'ticket_history_id' => 3,
        ]);

        // Seed 4
        DB::table('emails')->insert([
            'user_id' => 4,
            'recipient_email' => 'eventos@example.com',
            'subject' => 'Informações sobre Próximos Eventos',
            'message' => 'Olá, aqui estão as informações sobre os próximos eventos da empresa. Deixe-nos saber se tiver alguma dúvida.',
            'ticket_history_id' => 4,
        ]);

        // Seed 5
        DB::table('emails')->insert([
            'user_id' => 5,
            'recipient_email' => 'utilizador@example.com',
            'subject' => 'Instruções de Redefinição de Senha',
            'message' => 'Caro utilizador, encontre em anexo as instruções para redefinir sua senha.',
            'ticket_history_id' => 5,
        ]);
    }
}
