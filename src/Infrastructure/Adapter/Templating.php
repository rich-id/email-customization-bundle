<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Infrastructure\Adapter;

use RichId\EmailCustomizationBundle\Domain\Port\TemplatingInterface;
use Twig\Environment;

class Templating implements TemplatingInterface
{
    /** @var Environment */
    protected $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /** @param string[] $context */
    public function render(string $name, array $context = []): string
    {
        return $this->twig->render($name, $context);
    }
}
