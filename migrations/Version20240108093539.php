<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240108093539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project ADD cover_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE922726E9 FOREIGN KEY (cover_id) REFERENCES media (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2FB3D0EE922726E9 ON project (cover_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE922726E9');
        $this->addSql('DROP INDEX UNIQ_2FB3D0EE922726E9 ON project');
        $this->addSql('ALTER TABLE project DROP cover_id');
    }
}