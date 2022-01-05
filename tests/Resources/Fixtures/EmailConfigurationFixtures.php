<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Tests\Resources\Fixtures;

use RichCongress\RecurrentFixturesTestBundle\DataFixture\AbstractFixture;
use RichId\EmailCustomizationBundle\Domain\Entity\EmailConfiguration;
use RichId\EmailCustomizationBundle\Domain\Entity\Type\EmailConfigurationType;

final class EmailConfigurationFixtures extends AbstractFixture
{
    protected function loadFixtures(): void
    {
        $this->createObject(
            EmailConfiguration::class,
            'email-footer-acknowledgement',
            [
                'slug'         => 'email-footer-acknowledgement',
                'name'         => 'Acknowledgement',
                'type'         => EmailConfigurationType::FOOTER,
                'position'     => 1,
                'defaultValue' => 'With kindest regards',
                'dateUpdate'   => new \DateTime(),
            ]
        );

        $this->createObject(
            EmailConfiguration::class,
            'email-footer-signature',
            [
                'slug'         => 'email-footer-signature',
                'name'         => 'Signature',
                'type'         => EmailConfigurationType::FOOTER,
                'position'     => 2,
                'defaultValue' => 'The test team',
                'dateUpdate'   => new \DateTime(),
            ]
        );

        $this->createObject(
            EmailConfiguration::class,
            'email-footer-noreply',
            [
                'slug'         => 'email-footer-noreply',
                'name'         => 'No reply',
                'type'         => EmailConfigurationType::FOOTER,
                'position'     => 3,
                'defaultValue' => '<small>Please do not reply to this email.</small>',
                'dateUpdate'   => new \DateTime(),
            ]
        );
    }
}
