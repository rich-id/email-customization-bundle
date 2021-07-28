<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Tests\Infrastructure\Adapter;

use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichCongress\TestSuite\TestCase\TestCase;
use RichId\EmailCustomizationBundle\Infrastructure\Adapter\Templating;

/**
 * @covers \RichId\EmailCustomizationBundle\Infrastructure\Adapter\Templating
 * @TestConfig("fixtures")
 */
final class TemplatingTest extends TestCase
{
    /** @var Templating */
    public $adapter;

    public function testRender(): void
    {
        $content = $this->adapter->render('test.html.twig');
        $this->assertSame('Test', \trim($content));
    }
}
