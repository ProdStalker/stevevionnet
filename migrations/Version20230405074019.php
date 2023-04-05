<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230405074019 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project_media (project_id INT NOT NULL, media_id INT NOT NULL, INDEX IDX_7979A892166D1F9C (project_id), INDEX IDX_7979A892EA9FDD75 (media_id), PRIMARY KEY(project_id, media_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project_media ADD CONSTRAINT FK_7979A892166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_media ADD CONSTRAINT FK_7979A892EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_media DROP FOREIGN KEY FK_7979A892166D1F9C');
        $this->addSql('ALTER TABLE project_media DROP FOREIGN KEY FK_7979A892EA9FDD75');
        $this->addSql('DROP TABLE project_media');
    }
}
