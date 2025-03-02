<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250302220020 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercise ADD created_by_id INT DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51CB03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_AEDAD51CB03A8386 ON exercise (created_by_id)');
        $this->addSql('ALTER TABLE muscle_group ADD created_by_id INT DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE muscle_group ADD CONSTRAINT FK_323D098EB03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_323D098EB03A8386 ON muscle_group (created_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercise DROP FOREIGN KEY FK_AEDAD51CB03A8386');
        $this->addSql('DROP INDEX IDX_AEDAD51CB03A8386 ON exercise');
        $this->addSql('ALTER TABLE exercise DROP created_by_id, DROP created_at');
        $this->addSql('ALTER TABLE muscle_group DROP FOREIGN KEY FK_323D098EB03A8386');
        $this->addSql('DROP INDEX IDX_323D098EB03A8386 ON muscle_group');
        $this->addSql('ALTER TABLE muscle_group DROP created_by_id, DROP created_at');
    }
}
