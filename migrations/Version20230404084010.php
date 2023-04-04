<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230404084010 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE job_tag (job_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_C75C2412BE04EA9 (job_id), INDEX IDX_C75C2412BAD26311 (tag_id), PRIMARY KEY(job_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_media (job_id INT NOT NULL, media_id INT NOT NULL, INDEX IDX_6B701C7CBE04EA9 (job_id), INDEX IDX_6B701C7CEA9FDD75 (media_id), PRIMARY KEY(job_id, media_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job_tag ADD CONSTRAINT FK_C75C2412BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_tag ADD CONSTRAINT FK_C75C2412BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_media ADD CONSTRAINT FK_6B701C7CBE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_media ADD CONSTRAINT FK_6B701C7CEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FBD8E0F8989D9B62 ON job (slug)');
        $this->addSql('ALTER TABLE media ADD slug VARCHAR(150) NOT NULL, ADD path VARCHAR(255) NOT NULL, CHANGE name name VARCHAR(100) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6A2CA10C989D9B62 ON media (slug)');
        $this->addSql('ALTER TABLE project ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2FB3D0EE989D9B62 ON project (slug)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job_tag DROP FOREIGN KEY FK_C75C2412BE04EA9');
        $this->addSql('ALTER TABLE job_tag DROP FOREIGN KEY FK_C75C2412BAD26311');
        $this->addSql('ALTER TABLE job_media DROP FOREIGN KEY FK_6B701C7CBE04EA9');
        $this->addSql('ALTER TABLE job_media DROP FOREIGN KEY FK_6B701C7CEA9FDD75');
        $this->addSql('DROP TABLE job_tag');
        $this->addSql('DROP TABLE job_media');
        $this->addSql('DROP INDEX UNIQ_FBD8E0F8989D9B62 ON job');
        $this->addSql('ALTER TABLE job DROP slug');
        $this->addSql('DROP INDEX UNIQ_6A2CA10C989D9B62 ON media');
        $this->addSql('ALTER TABLE media DROP slug, DROP path, CHANGE name name VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_2FB3D0EE989D9B62 ON project');
        $this->addSql('ALTER TABLE project DROP slug');
    }
}
