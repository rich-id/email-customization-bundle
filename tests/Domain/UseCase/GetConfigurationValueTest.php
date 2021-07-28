<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Tests\Domain\UseCase;

use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichCongress\TestSuite\TestCase\TestCase;
use RichId\EmailCustomizationBundle\Domain\Exception\NotFoundEmailConfigurationException;
use RichId\EmailCustomizationBundle\Domain\UseCase\GetConfigurationValue;

/**
 * @covers \RichId\EmailCustomizationBundle\Domain\UseCase\GetConfigurationValue
 * @TestConfig("fixtures")
 */
final class GetConfigurationValueTest extends TestCase
{
    /** @var GetConfigurationValue */
    public $useCase;

    public function testUseCaseConfigurationNotFound(): void
    {
        $this->expectException(NotFoundEmailConfigurationException::class);
        $this->expectExceptionMessage('Not found configuration with slug my_slug.');

        ($this->useCase)('my_slug');
    }

    public function testUseCase(): void
    {
        $value = ($this->useCase)('email-footer-acknowledgement');
        $this->assertSame('With kindest regards', $value);
    }
}
