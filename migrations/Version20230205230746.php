<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230205230746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Change the name for payload of wagon';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE wagon ADD max_goods_weight DOUBLE PRECISION NOT NULL, DROP max_payload');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, pease modify it to your needs
        $this->addSql('ALTER TABLE wagon ADD max_payload INT NOT NULL, DROP max_goods_weight');
    }
}
