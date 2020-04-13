<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200413174954 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C748C0F37');
        $this->addSql('DROP INDEX com_id ON comment');
        $this->addSql('DROP INDEX IDX_9474526C748C0F37 ON comment');
        $this->addSql('ALTER TABLE comment DROP com_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment ADD com_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C748C0F37 FOREIGN KEY (com_id) REFERENCES post (id)');
        $this->addSql('CREATE INDEX com_id ON comment (com_id)');
        $this->addSql('CREATE INDEX IDX_9474526C748C0F37 ON comment (com_id)');
    }
}
