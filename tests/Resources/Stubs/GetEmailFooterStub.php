<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Tests\Resources\Stubs;

use RichCongress\WebTestBundle\OverrideService\OverrideServiceInterface;
use RichCongress\WebTestBundle\OverrideService\OverrideServiceTrait;
use RichId\EmailCustomizationBundle\Domain\UseCase\GetEmailFooter;

final class GetEmailFooterStub extends GetEmailFooter implements OverrideServiceInterface
{
    use OverrideServiceTrait;

    /** @var string|array<string> */
    public static $overridenServices = GetEmailFooter::class;

    /** @var string */
    protected $footer;

    /** @var GetEmailFooter */
    protected $innerService;

    public function setFooter(string $footer): self
    {
        $this->footer = $footer;

        return $this;
    }

    public function __invoke(): string
    {
        if ($this->footer !== null) {
            return $this->footer;
        }

        return parent::__invoke();
    }
}
