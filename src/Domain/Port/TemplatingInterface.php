<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Domain\Port;

interface TemplatingInterface
{
    /** @param string[] $context */
    public function render(string $name, array $context = []): string;
}
