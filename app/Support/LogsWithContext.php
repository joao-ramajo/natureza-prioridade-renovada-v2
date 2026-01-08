<?php

namespace App\Support;

use Illuminate\Support\Str;
use Psr\Log\LoggerInterface;

trait LogsWithContext
{
    protected readonly LoggerInterface $logger;

    protected function info(string $message, array $context = []): void
    {
        $this->logger->info(
            $this->formatMessage($message),
            $context
        );
    }

    protected function warning(string $message, array $context = []): void
    {
        $this->logger->warning(
            $this->formatMessage($message),
            $context
        );
    }

    protected function error(string $message, array $context = []): void
    {
        $this->logger->error(
            $this->formatMessage($message),
            $context
        );
    }

    private function formatMessage(string $message): string
    {
        $message = trim($message);

        $message = preg_replace('/\s+/', ' ', $message);

        return sprintf(
            '[%s] %s',
            $this->classNameForLog(),
            $message
        );
    }

    private function classNameForLog(): string
    {
        return Str::snake(
            class_basename($this)
        );
    }
}
