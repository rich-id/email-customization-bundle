<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Tests\Domain\Entity;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichCongress\TestSuite\TestCase\TestCase;
use RichCongress\TestTools\Helper\ForceExecutionHelper;
use RichId\EmailCustomizationBundle\Domain\Entity\EmailConfiguration;

/**
 * @covers \RichId\EmailCustomizationBundle\Domain\Entity\EmailConfiguration
 * @TestConfig("fixtures")
 */
final class EmailConfigurationTest extends TestCase
{
    public function testSlugUnique(): void
    {
        $entity = $this->getReference(EmailConfiguration::class, 'email-footer-acknowledgement');
        ForceExecutionHelper::update($entity, ['slug' => 'email-footer-signature']);

        $this->expectException(UniqueConstraintViolationException::class);

        $this->getManager()->persist($entity);
        $this->getManager()->flush();
    }

    public function testPositionUniqueForType(): void
    {
        $entity = $this->getReference(EmailConfiguration::class, 'email-footer-acknowledgement');
        ForceExecutionHelper::update($entity, ['position' => 2]);

        $this->expectException(UniqueConstraintViolationException::class);

        $this->getManager()->persist($entity);
        $this->getManager()->flush();
    }

    public function testEntity(): void
    {
        $entity = $this->getReference(EmailConfiguration::class, 'email-footer-acknowledgement');
        $entity->setValue('Custom message');

        $this->assertSame(1, $entity->getId());
        $this->assertSame(1, $entity->getPosition());
        $this->assertSame('email-footer-acknowledgement', $entity->getSlug());
        $this->assertSame('Acknowledgement', $entity->getName());
        $this->assertSame('footer', $entity->getType());
        $this->assertSame('Custom message', $entity->getValue());
        $this->assertSame('With kindest regards', $entity->getDefaultValue());
        $this->assertInstanceOf(\DateTime::class, $entity->getDateUpdate());
    }

    public function testGetValueToUser(): void
    {
        $entity = $this->getReference(EmailConfiguration::class, 'email-footer-acknowledgement');
        $this->assertSame('With kindest regards', $entity->getValueToUse());

        $entity->setValue('Custom message');
        $this->assertSame('Custom message', $entity->getValueToUse());
    }
}
