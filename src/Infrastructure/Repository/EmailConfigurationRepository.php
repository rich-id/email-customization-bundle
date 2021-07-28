<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Infrastructure\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use RichId\EmailCustomizationBundle\Domain\Entity\EmailConfiguration;

/**
 * @extends ServiceEntityRepository<EmailConfiguration>
 *
 * @method EmailConfiguration findOneBySlug(string $slug)
 */
class EmailConfigurationRepository extends ServiceEntityRepository
{
    /** @codeCoverageIgnore  */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmailConfiguration::class);
    }
}
