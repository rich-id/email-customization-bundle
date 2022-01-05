<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Domain\UseCase;

use RichId\EmailCustomizationBundle\Domain\Port\TemplatingInterface;

class GetEmailFooter
{
    /** @var TemplatingInterface */
    protected $templating;

    public function __construct(TemplatingInterface $templating)
    {
        $this->templating = $templating;
    }

    public function __invoke(): string
    {
        return \htmlspecialchars_decode(
            \trim(
                $this->templating->render('@RichIdEmailCustomization/email-footer.html.twig')
            )
        );
    }
}
