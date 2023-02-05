<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230205172138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'The initial locomotive and the wagon table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE locomotive (id INT AUTO_INCREMENT NOT NULL, pulling_power INT NOT NULL, type VARCHAR(255) NOT NULL, weight DOUBLE PRECISION NOT NULL, length DOUBLE PRECISION NOT NULL, max_passenger INT NOT NULL, max_payload INT NOT NULL, manufacturer VARCHAR(255) NOT NULL, year_of_manufacture DATE NOT NULL, serial_no VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C0FF297277119FDA (serial_no), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wagon (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, weight DOUBLE PRECISION NOT NULL, length DOUBLE PRECISION NOT NULL, max_passenger INT NOT NULL, max_payload INT NOT NULL, manufacturer VARCHAR(255) NOT NULL, year_of_manufacture DATE NOT NULL, serial_no VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_BBDBD3677119FDA (serial_no), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE locomotive');
        $this->addSql('DROP TABLE wagon');
    }
}
