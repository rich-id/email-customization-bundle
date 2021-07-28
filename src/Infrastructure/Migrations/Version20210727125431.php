<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20210727125431 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE module_email_customization_configuration (id INT UNSIGNED AUTO_INCREMENT NOT NULL, slug VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, type ENUM(\'footer\') NOT NULL COMMENT \'(DC2Type:EmailConfigurationType)\', position INT UNSIGNED NOT NULL, default_value VARCHAR(600) NOT NULL, value VARCHAR(600) DEFAULT NULL, date_update DATETIME NOT NULL, UNIQUE INDEX UNIQ_3C53275F989D9B62 (slug), UNIQUE INDEX UNIQ_3C53275F5E237E06 (name), UNIQUE INDEX email_configuration_type_position_UNIQUE (type, position), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE module_email_customization_configuration');
    }
}
