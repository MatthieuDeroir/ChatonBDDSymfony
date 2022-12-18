<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221218130121 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(50) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chaton (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, nom VARCHAR(50) NOT NULL, sterilise TINYINT(1) NOT NULL, photo VARCHAR(255) DEFAULT NULL, INDEX IDX_EED8B06BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chaton_owners (chaton_id INT NOT NULL, owner_id INT NOT NULL, INDEX IDX_9C7DD005640066C9 (chaton_id), INDEX IDX_9C7DD0057E3C61F9 (owner_id), PRIMARY KEY(chaton_id, owner_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE owner (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE owner_chaton (owner_id INT NOT NULL, chaton_id INT NOT NULL, INDEX IDX_AB17A7587E3C61F9 (owner_id), INDEX IDX_AB17A758640066C9 (chaton_id), PRIMARY KEY(owner_id, chaton_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chaton ADD CONSTRAINT FK_EED8B06BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE chaton_owners ADD CONSTRAINT FK_9C7DD005640066C9 FOREIGN KEY (chaton_id) REFERENCES chaton (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chaton_owners ADD CONSTRAINT FK_9C7DD0057E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE owner_chaton ADD CONSTRAINT FK_AB17A7587E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE owner_chaton ADD CONSTRAINT FK_AB17A758640066C9 FOREIGN KEY (chaton_id) REFERENCES chaton (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chaton DROP FOREIGN KEY FK_EED8B06BCF5E72D');
        $this->addSql('ALTER TABLE chaton_owners DROP FOREIGN KEY FK_9C7DD005640066C9');
        $this->addSql('ALTER TABLE chaton_owners DROP FOREIGN KEY FK_9C7DD0057E3C61F9');
        $this->addSql('ALTER TABLE owner_chaton DROP FOREIGN KEY FK_AB17A7587E3C61F9');
        $this->addSql('ALTER TABLE owner_chaton DROP FOREIGN KEY FK_AB17A758640066C9');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE chaton');
        $this->addSql('DROP TABLE chaton_owners');
        $this->addSql('DROP TABLE owner');
        $this->addSql('DROP TABLE owner_chaton');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
