<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181206220923 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE business_unit (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deal (id INT AUTO_INCREMENT NOT NULL, deal_invoice_id INT NOT NULL, deal_status_id INT NOT NULL, total_usd INT NOT NULL, is_confirmed TINYINT(1) NOT NULL, end_date DATETIME DEFAULT NULL, is_close_to_expired_notified TINYINT(1) NOT NULL, INDEX IDX_E3FEC116C8975018 (deal_invoice_id), INDEX IDX_E3FEC1167BCEFDF6 (deal_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deal_company (id INT AUTO_INCREMENT NOT NULL, deal_company_type_id INT NOT NULL, deal_status_id INT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, zip_code VARCHAR(100) DEFAULT NULL, web_site VARCHAR(100) DEFAULT NULL, INDEX IDX_ABA581C7A120EC5C (deal_company_type_id), INDEX IDX_ABA581C77BCEFDF6 (deal_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deal_company_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, visible TINYINT(1) NOT NULL, company_type_group INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deal_invoice (id INT AUTO_INCREMENT NOT NULL, business_unit_id INT NOT NULL, deal_company_id INT NOT NULL, invoice_number VARCHAR(255) NOT NULL, correlative VARCHAR(50) DEFAULT NULL, purchase_invoice_date DATETIME DEFAULT NULL, computo VARCHAR(50) DEFAULT NULL, computo_win_pro VARCHAR(2) DEFAULT NULL, total_units INT NOT NULL, total_quantity INT DEFAULT NULL, INDEX IDX_747F9FCCA58ECB40 (business_unit_id), INDEX IDX_747F9FCC7685BB33 (deal_company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deal_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE deal ADD CONSTRAINT FK_E3FEC116C8975018 FOREIGN KEY (deal_invoice_id) REFERENCES deal_invoice (id)');
        $this->addSql('ALTER TABLE deal ADD CONSTRAINT FK_E3FEC1167BCEFDF6 FOREIGN KEY (deal_status_id) REFERENCES deal_status (id)');
        $this->addSql('ALTER TABLE deal_company ADD CONSTRAINT FK_ABA581C7A120EC5C FOREIGN KEY (deal_company_type_id) REFERENCES deal_company_type (id)');
        $this->addSql('ALTER TABLE deal_company ADD CONSTRAINT FK_ABA581C77BCEFDF6 FOREIGN KEY (deal_status_id) REFERENCES deal_status (id)');
        $this->addSql('ALTER TABLE deal_invoice ADD CONSTRAINT FK_747F9FCCA58ECB40 FOREIGN KEY (business_unit_id) REFERENCES business_unit (id)');
        $this->addSql('ALTER TABLE deal_invoice ADD CONSTRAINT FK_747F9FCC7685BB33 FOREIGN KEY (deal_company_id) REFERENCES deal_company (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE deal_invoice DROP FOREIGN KEY FK_747F9FCCA58ECB40');
        $this->addSql('ALTER TABLE deal_invoice DROP FOREIGN KEY FK_747F9FCC7685BB33');
        $this->addSql('ALTER TABLE deal_company DROP FOREIGN KEY FK_ABA581C7A120EC5C');
        $this->addSql('ALTER TABLE deal DROP FOREIGN KEY FK_E3FEC116C8975018');
        $this->addSql('ALTER TABLE deal DROP FOREIGN KEY FK_E3FEC1167BCEFDF6');
        $this->addSql('ALTER TABLE deal_company DROP FOREIGN KEY FK_ABA581C77BCEFDF6');
        $this->addSql('DROP TABLE business_unit');
        $this->addSql('DROP TABLE deal');
        $this->addSql('DROP TABLE deal_company');
        $this->addSql('DROP TABLE deal_company_type');
        $this->addSql('DROP TABLE deal_invoice');
        $this->addSql('DROP TABLE deal_status');
    }
}
