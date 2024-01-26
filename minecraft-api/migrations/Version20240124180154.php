<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240124180154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649AA08CB10 (login), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE craft ADD creator_id INT NOT NULL');
        $this->addSql('ALTER TABLE craft ADD CONSTRAINT FK_F45C4A8461220EA6 FOREIGN KEY (creator_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_F45C4A8461220EA6 ON craft (creator_id)');
        $this->addSql('ALTER TABLE item ADD creator_id INT NOT NULL');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E61220EA6 FOREIGN KEY (creator_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_1F1B251E61220EA6 ON item (creator_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE craft DROP FOREIGN KEY FK_F45C4A8461220EA6');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E61220EA6');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_1F1B251E61220EA6 ON item');
        $this->addSql('ALTER TABLE item DROP creator_id');
        $this->addSql('DROP INDEX IDX_F45C4A8461220EA6 ON craft');
        $this->addSql('ALTER TABLE craft DROP creator_id');
    }
}
