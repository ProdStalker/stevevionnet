<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230404130927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE word_word_category (word_id INT NOT NULL, word_category_id INT NOT NULL, INDEX IDX_36A772B9E357438D (word_id), INDEX IDX_36A772B92AF7A814 (word_category_id), PRIMARY KEY(word_id, word_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE word_word_category ADD CONSTRAINT FK_36A772B9E357438D FOREIGN KEY (word_id) REFERENCES word (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE word_word_category ADD CONSTRAINT FK_36A772B92AF7A814 FOREIGN KEY (word_category_id) REFERENCES word_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE word_category_word DROP FOREIGN KEY FK_5C3FB5FF2AF7A814');
        $this->addSql('ALTER TABLE word_category_word DROP FOREIGN KEY FK_5C3FB5FFE357438D');
        $this->addSql('DROP TABLE word_category_word');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE word_category_word (word_category_id INT NOT NULL, word_id INT NOT NULL, INDEX IDX_5C3FB5FFE357438D (word_id), INDEX IDX_5C3FB5FF2AF7A814 (word_category_id), PRIMARY KEY(word_category_id, word_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE word_category_word ADD CONSTRAINT FK_5C3FB5FF2AF7A814 FOREIGN KEY (word_category_id) REFERENCES word_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE word_category_word ADD CONSTRAINT FK_5C3FB5FFE357438D FOREIGN KEY (word_id) REFERENCES word (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE word_word_category DROP FOREIGN KEY FK_36A772B9E357438D');
        $this->addSql('ALTER TABLE word_word_category DROP FOREIGN KEY FK_36A772B92AF7A814');
        $this->addSql('DROP TABLE word_word_category');
    }
}
