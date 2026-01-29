<?php

namespace App\Console\Commands\Api;

use App\Models\ApiToken;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateServiceToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'npr:api:create-service-token {name} {--expires=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera um token de acesso para serviços externos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $expiresInDays = $this->option('expires');

        $plainToken = Str::random(40);

        if (ApiToken::where('name', $name)->exists()) {
            $this->error("Já existe um token com o nome '{$name}'");
            return Command::FAILURE;
        }

        ApiToken::create([
            'name' => $name,
            'token' => hash('sha256', $plainToken),
            'active' => true,
            'expires_at' => $expiresInDays ? now()->addDays((int) $expiresInDays) : now()->addDays(30)
        ]);

        $this->info('Token gerado com sucesso!');
        $this->warn('Guarde este token, ele não será exibido novamente:');
        $this->line($plainToken);

        return Command::SUCCESS;
    }
}
