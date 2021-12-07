<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211108162213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE public.adress (id UUID NOT NULL, country VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, house_number VARCHAR(255) NOT NULL, zipcode VARCHAR(255) DEFAULT NULL, state VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN public.adress.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE public."order" (id UUID NOT NULL, recipient_id UUID NOT NULL, delivery_adress_id UUID NOT NULL, price INT NOT NULL, delivery_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, order_placement_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C4F8F2FCE92F8F78 ON public."order" (recipient_id)');
        $this->addSql('CREATE INDEX IDX_C4F8F2FCC0E3B53E ON public."order" (delivery_adress_id)');
        $this->addSql('COMMENT ON COLUMN public."order".id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN public."order".recipient_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN public."order".delivery_adress_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN public."order".delivery_time IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN public."order".order_placement_time IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE public."user" (id UUID NOT NULL, home_adress_id UUID NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, date_of_birth TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_327C5DE7FA5280E8 ON public."user" (home_adress_id)');
        $this->addSql('COMMENT ON COLUMN public."user".id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN public."user".home_adress_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN public."user".date_of_birth IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE public."order" ADD CONSTRAINT FK_C4F8F2FCE92F8F78 FOREIGN KEY (recipient_id) REFERENCES public."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE public."order" ADD CONSTRAINT FK_C4F8F2FCC0E3B53E FOREIGN KEY (delivery_adress_id) REFERENCES public.adress (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE public."user" ADD CONSTRAINT FK_327C5DE7FA5280E8 FOREIGN KEY (home_adress_id) REFERENCES public.adress (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE public."order" DROP CONSTRAINT FK_C4F8F2FCC0E3B53E');
        $this->addSql('ALTER TABLE public."user" DROP CONSTRAINT FK_327C5DE7FA5280E8');
        $this->addSql('ALTER TABLE public."order" DROP CONSTRAINT FK_C4F8F2FCE92F8F78');
        $this->addSql('DROP TABLE public.adress');
        $this->addSql('DROP TABLE public."order"');
        $this->addSql('DROP TABLE public."user"');
    }
}
