<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210601100346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE data_center (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE distribution (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE server (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, location_id INT DEFAULT NULL, distribution_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, state INT NOT NULL, cpu INT NOT NULL, INDEX IDX_5A6DD5F6A76ED395 (user_id), INDEX IDX_5A6DD5F664D218E (location_id), INDEX IDX_5A6DD5F66EB6DDB5 (distribution_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE server ADD CONSTRAINT FK_5A6DD5F6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE server ADD CONSTRAINT FK_5A6DD5F664D218E FOREIGN KEY (location_id) REFERENCES data_center (id)');
        $this->addSql('ALTER TABLE server ADD CONSTRAINT FK_5A6DD5F66EB6DDB5 FOREIGN KEY (distribution_id) REFERENCES distribution (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE server DROP FOREIGN KEY FK_5A6DD5F664D218E');
        $this->addSql('ALTER TABLE server DROP FOREIGN KEY FK_5A6DD5F66EB6DDB5');
        $this->addSql('ALTER TABLE server DROP FOREIGN KEY FK_5A6DD5F6A76ED395');
        $this->addSql('DROP TABLE data_center');
        $this->addSql('DROP TABLE distribution');
        $this->addSql('DROP TABLE server');
        $this->addSql('DROP TABLE user');
    }
}
