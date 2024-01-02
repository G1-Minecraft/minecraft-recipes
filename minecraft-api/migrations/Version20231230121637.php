<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231230121637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE craft (id INT AUTO_INCREMENT NOT NULL, result_id INT NOT NULL, result_amount INT NOT NULL, INDEX IDX_F45C4A847A7B643 (result_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE craft_slot (id INT AUTO_INCREMENT NOT NULL, craft_id INT NOT NULL, item_id INT NOT NULL, position INT NOT NULL, INDEX IDX_54920D1AE836CCC8 (craft_id), INDEX IDX_54920D1A126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, texture_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE craft ADD CONSTRAINT FK_F45C4A847A7B643 FOREIGN KEY (result_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE craft_slot ADD CONSTRAINT FK_54920D1AE836CCC8 FOREIGN KEY (craft_id) REFERENCES craft (id)');
        $this->addSql('ALTER TABLE craft_slot ADD CONSTRAINT FK_54920D1A126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE craft DROP FOREIGN KEY FK_F45C4A847A7B643');
        $this->addSql('ALTER TABLE craft_slot DROP FOREIGN KEY FK_54920D1AE836CCC8');
        $this->addSql('ALTER TABLE craft_slot DROP FOREIGN KEY FK_54920D1A126F525E');
        $this->addSql('DROP TABLE craft');
        $this->addSql('DROP TABLE craft_slot');
        $this->addSql('DROP TABLE item');
    }
}
