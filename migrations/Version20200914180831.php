<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200914180831 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom_categorie VARCHAR(40) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles ADD id_categorie_id INT NOT NULL, ADD nom_article VARCHAR(20) DEFAULT NULL, ADD image_article VARCHAR(40) DEFAULT NULL, ADD prix_article DOUBLE PRECISION DEFAULT NULL, ADD description_article VARCHAR(200) DEFAULT NULL, ADD type VARCHAR(255) NOT NULL, ADD vid_article VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD31689F34925F FOREIGN KEY (id_categorie_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_BFDD31689F34925F ON articles (id_categorie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD31689F34925F');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP INDEX IDX_BFDD31689F34925F ON articles');
        $this->addSql('ALTER TABLE articles DROP id_categorie_id, DROP nom_article, DROP image_article, DROP prix_article, DROP description_article, DROP type, DROP vid_article');
    }
}
