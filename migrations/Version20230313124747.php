<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230313124747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE job_tag (job_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_C75C2412BE04EA9 (job_id), INDEX IDX_C75C2412BAD26311 (tag_id), PRIMARY KEY(job_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, color VARCHAR(7) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job_tag ADD CONSTRAINT FK_C75C2412BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_tag ADD CONSTRAINT FK_C75C2412BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job_tag DROP FOREIGN KEY FK_C75C2412BE04EA9');
        $this->addSql('ALTER TABLE job_tag DROP FOREIGN KEY FK_C75C2412BAD26311');
        $this->addSql('DROP TABLE job_tag');
        $this->addSql('DROP TABLE tag');
    }
}
