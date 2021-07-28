<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Tests\Domain\UseCase;

use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichCongress\TestSuite\TestCase\TestCase;
use RichId\EmailCustomizationBundle\Domain\Entity\EmailConfiguration;
use RichId\EmailCustomizationBundle\Domain\Exception\NotFoundEmailConfigurationException;
use RichId\EmailCustomizationBundle\Domain\UseCase\GetConfiguration;

/**
 * @covers \RichId\EmailCustomizationBundle\Domain\UseCase\GetConfiguration
 * @TestConfig("fixtures")
 */
final class GetConfigurationTest extends TestCase
{
    /** @var GetConfiguration */
    public $useCase;

    public function testUseCaseConfigurationNotFound(): void
    {
        $this->expectException(NotFoundEmailConfigurationException::class);
        $this->expectExceptionMessage('Not found configuration with slug my_slug.');

        ($this->useCase)('my_slug');
    }

    public function testUseCase(): void
    {
        $configuration = ($this->useCase)('email-footer-acknowledgement');

        $this->assertInstanceOf(EmailConfiguration::class, $configuration);
        $this->assertSame('email-footer-acknowledgement', $configuration->getSlug());
    }
}
