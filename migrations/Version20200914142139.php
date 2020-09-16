<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200914142139 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commandes ADD id_client_id INT NOT NULL');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C99DED506 FOREIGN KEY (id_client_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_35D4282C99DED506 ON commandes (id_client_id)');
        $this->addSql('ALTER TABLE lignesdecommandes ADD id_commande_id INT NOT NULL');
        $this->addSql('ALTER TABLE lignesdecommandes ADD CONSTRAINT FK_1147F1AE9AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commandes (id)');
        $this->addSql('CREATE INDEX IDX_1147F1AE9AF8E3A3 ON lignesdecommandes (id_commande_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C99DED506');
        $this->addSql('DROP INDEX IDX_35D4282C99DED506 ON commandes');
        $this->addSql('ALTER TABLE commandes DROP id_client_id');
        $this->addSql('ALTER TABLE lignesdecommandes DROP FOREIGN KEY FK_1147F1AE9AF8E3A3');
        $this->addSql('DROP INDEX IDX_1147F1AE9AF8E3A3 ON lignesdecommandes');
        $this->addSql('ALTER TABLE lignesdecommandes DROP id_commande_id');
    }
}
