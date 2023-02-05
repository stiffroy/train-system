<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230205174958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'The main train table and the element connector table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE element_connector (id INT AUTO_INCREMENT NOT NULL, locomotive_id INT DEFAULT NULL, wagon_id INT DEFAULT NULL, train_id INT DEFAULT NULL, element_order INT NOT NULL, UNIQUE INDEX UNIQ_BC876B45587009A8 (locomotive_id), UNIQUE INDEX UNIQ_BC876B45A21C43DD (wagon_id), INDEX IDX_BC876B4523BCD4D0 (train_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE train (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE element_connector ADD CONSTRAINT FK_BC876B45587009A8 FOREIGN KEY (locomotive_id) REFERENCES locomotive (id)');
        $this->addSql('ALTER TABLE element_connector ADD CONSTRAINT FK_BC876B45A21C43DD FOREIGN KEY (wagon_id) REFERENCES wagon (id)');
        $this->addSql('ALTER TABLE element_connector ADD CONSTRAINT FK_BC876B4523BCD4D0 FOREIGN KEY (train_id) REFERENCES train (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE element_connector DROP FOREIGN KEY FK_BC876B45587009A8');
        $this->addSql('ALTER TABLE element_connector DROP FOREIGN KEY FK_BC876B45A21C43DD');
        $this->addSql('ALTER TABLE element_connector DROP FOREIGN KEY FK_BC876B4523BCD4D0');
        $this->addSql('DROP TABLE element_connector');
        $this->addSql('DROP TABLE train');
    }
}
