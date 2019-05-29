<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190529171516 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE authenticated_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(100) NOT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(150) NOT NULL, email VARCHAR(100) NOT NULL, contact VARCHAR(10) NOT NULL, passwd VARCHAR(100) NOT NULL, picture VARCHAR(100) NOT NULL, createdate DATETIME NOT NULL, updatedate DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE figures (id INT AUTO_INCREMENT NOT NULL, media_id INT DEFAULT NULL, group_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, createdate DATETIME NOT NULL, updatedate DATETIME NOT NULL, INDEX IDX_ABF1009AEA9FDD75 (media_id), INDEX IDX_ABF1009AFE54D947 (group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE group_figures (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, type VARCHAR(100) NOT NULL, state TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, authenticateduser_id INT DEFAULT NULL, figures_id INT DEFAULT NULL, content VARCHAR(100) NOT NULL, createdate DATETIME NOT NULL, updatedate DATETIME NOT NULL, INDEX IDX_DB021E968B5472C8 (authenticateduser_id), INDEX IDX_DB021E965C7F3A37 (figures_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE figures ADD CONSTRAINT FK_ABF1009AEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE figures ADD CONSTRAINT FK_ABF1009AFE54D947 FOREIGN KEY (group_id) REFERENCES group_figures (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E968B5472C8 FOREIGN KEY (authenticateduser_id) REFERENCES authenticated_user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E965C7F3A37 FOREIGN KEY (figures_id) REFERENCES figures (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E968B5472C8');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E965C7F3A37');
        $this->addSql('ALTER TABLE figures DROP FOREIGN KEY FK_ABF1009AFE54D947');
        $this->addSql('ALTER TABLE figures DROP FOREIGN KEY FK_ABF1009AEA9FDD75');
        $this->addSql('DROP TABLE authenticated_user');
        $this->addSql('DROP TABLE figures');
        $this->addSql('DROP TABLE group_figures');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE messages');
    }
}
