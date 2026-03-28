<?php

namespace App\Auth\Infrastructure\Console\Commands;

use App\Auth\Domain\Entity\ApiToken;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(
    name: 'npr:api:create-service-token',
    description: 'Gera um token de acesso para servicos externos',
)]
class CreateServiceToken extends Command
{
    protected function configure(): void
    {
        $this->addArgument('name', InputArgument::REQUIRED, 'Nome do servico');
        $this->addOption('expires', null, InputOption::VALUE_REQUIRED, 'Dias para expiracao do token');
    }

    public function handle(): int
    {
        $name = $this->argument('name');
        $expiresInDays = $this->option('expires');
        $expiresAt = now()->addDays($expiresInDays ? (int) $expiresInDays : 30);

        $plainToken = Str::random(40);
        $tokenHash = hash('sha256', $plainToken);
        $existingToken = ApiToken::query()->where('name', $name)->first();

        if ($existingToken) {
            $existingToken->update([
                'token' => $tokenHash,
                'active' => true,
                'expires_at' => $expiresAt,
            ]);

            $this->info('Token renovado com sucesso!');
            $this->warn('Guarde este token, ele nao sera exibido novamente:');
            $this->line($plainToken);

            return Command::SUCCESS;
        }

        ApiToken::create([
            'name' => $name,
            'token' => $tokenHash,
            'active' => true,
            'expires_at' => $expiresAt,
        ]);

        $this->info('Token gerado com sucesso!');
        $this->warn('Guarde este token, ele nao sera exibido novamente:');
        $this->line($plainToken);

        return Command::SUCCESS;
    }
}
