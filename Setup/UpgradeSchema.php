<?php
namespace Magenest\Study\Setup;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Quote\Setup\QuoteSetupFactory;
use Magento\Sales\Setup\SalesSetupFactory;
use Magento\Framework\DB\Ddl\Table;


class UpgradeSchema implements UpgradeSchemaInterface
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '2.0.1') < 0)
        {
            $installer = $setup;
            $installer->startSetup();
            $sql = "alter table magenest_movie add constraint magenest_movie_magenest_director_director_id_fk1 foreign key (director_id) references magenest_director (director_id)";
            $setup->getConnection()->query($sql);
            $sql2 = "alter table magenest_movie_actor add constraint magenest_movie_actor_magenest_movie_movie_id_fk foreign key (movie_id) references magenest_movie (movie_id)";
            $setup->getConnection()->query($sql2);
            $sql3 = "alter table magenest_movie_actor add constraint magenest_movie_actor_magenest_actor_actor_id_fk foreign key (actor_id) references magenest_actor (actor_id)";
            $setup->getConnection()->query($sql3);

            $installer->endSetup();
        }
    }
}