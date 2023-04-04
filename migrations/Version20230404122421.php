<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230404122421 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE word (id INT AUTO_INCREMENT NOT NULL, content VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE word_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE word_category_word (word_category_id INT NOT NULL, word_id INT NOT NULL, INDEX IDX_5C3FB5FF2AF7A814 (word_category_id), INDEX IDX_5C3FB5FFE357438D (word_id), PRIMARY KEY(word_category_id, word_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE word_category_word ADD CONSTRAINT FK_5C3FB5FF2AF7A814 FOREIGN KEY (word_category_id) REFERENCES word_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE word_category_word ADD CONSTRAINT FK_5C3FB5FFE357438D FOREIGN KEY (word_id) REFERENCES word (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE word_category_word DROP FOREIGN KEY FK_5C3FB5FF2AF7A814');
        $this->addSql('ALTER TABLE word_category_word DROP FOREIGN KEY FK_5C3FB5FFE357438D');
        $this->addSql('DROP TABLE word');
        $this->addSql('DROP TABLE word_category');
        $this->addSql('DROP TABLE word_category_word');
    }
}
