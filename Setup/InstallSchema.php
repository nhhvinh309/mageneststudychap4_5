<?php
namespace Magenest\Study\Setup;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;
class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface{
    public function install(SchemaSetupInterface $setup,ModuleContextInterface $context){
        $setup->startSetup();
        $conn = $setup->getConnection();
        $tableMovie = $setup->getTable('magenest_movie');
        $tableDirector = $setup->getTable('magenest_director');
        $tableActor = $setup->getTable('magenest_actor');
        $tableMovieActor = $setup->getTable('magenest_movie_actor');
        if($conn->isTableExists($tableMovie) != true){
            $table = $conn->newTable($tableMovie)
                ->addColumn('movie_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,[
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'Movie ID'
                )->addColumn(
                    'name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    64,
                    ['nullable' => false],
                    'Movie name'
                )->addColumn(
                    'description',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,['nullable' => false],
                    'Description'
                )->addColumn(
                    'rating',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,['nullable' => false],
                    'Rating'
                )->addColumn(
                    'director_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,['nullable' => false, 'unsigned' => true],
                    'Director id'
                )->setOption('charset','utf8');
            $conn->createTable($table);
        }
        if($conn->isTableExists($tableDirector) != true){
            $table = $conn->newTable($tableDirector)
                ->addColumn('director_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,[
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'Director ID'
                )->addColumn(
                    'name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    64,
                    ['nullable' => false],
                    'Director name')
                ->setOption('charset','utf8');
            $conn->createTable($table);
        }
        if($conn->isTableExists($tableActor) != true){
            $table = $conn->newTable($tableActor)
                ->addColumn('actor_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,[
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'Actor ID'
                )->addColumn(
                    'name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    64,
                    ['nullable' => false],
                    'Actor name')
                ->setOption('charset','utf8');
            $conn->createTable($table);
        }
        if($conn->isTableExists($tableMovieActor) != true){
            $table = $conn->newTable($tableMovieActor)
                ->addColumn('movie_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,[
                        'unsigned' => true,
                        'nullable' => false,
                    ],
                    'Movie ID'
                )->addColumn('actor_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,[
                        'unsigned' => true,
                        'nullable' => false,
                    ],
                    'Actor ID'
                )
                ->setOption('charset','utf8');
            $conn->createTable($table);
        }
        $setup->endSetup();
    }
}