<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Tests\Domain\Exception;

use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichCongress\TestSuite\TestCase\TestCase;
use RichId\EmailCustomizationBundle\Domain\Exception\EmailCustomizationException;
use RichId\EmailCustomizationBundle\Domain\Exception\NotFoundEmailConfigurationException;

/**
 * @covers \RichId\EmailCustomizationBundle\Domain\Exception\NotFoundEmailConfigurationException
 * @TestConfig("kernel")
 */
final class NotFoundEmailConfigurationExceptionTest extends TestCase
{
    public function testException(): void
    {
        $exception = new NotFoundEmailConfigurationException('slug');

        $this->assertInstanceOf(EmailCustomizationException::class, $exception);
        $this->assertSame('slug', $exception->getConfigurationSlug());
        $this->assertSame('Not found configuration with slug slug.', $exception->getMessage());
    }
}
