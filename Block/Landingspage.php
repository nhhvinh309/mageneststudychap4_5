<?php

namespace Magenest\Study\Block;
use Magenest\Study\Model\ResourceModel\Movie\CollectionFactory;
class Landingspage extends \Magento\Framework\View\Element\Template {

    protected $_movieFactory;
    protected $_resourceConnection;
    protected $_collectionFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magenest\Study\Model\MovieFactory $movieFactory,
        \Magento\Framework\App\ResourceConnection $resourceConnection,
        CollectionFactory $collectionFactory
    ) {
        $this->_movieFactory = $movieFactory;
        $this->_resourceConnection = $resourceConnection;
        $this->_collectionFactory = $collectionFactory;

        parent::__construct($context);
    }

    public function getMovie(){
        $collection = $this->_collectionFactory->create();
        $collection->getSelect()
            ->joinLeft( array('movie'=> 'magenest_movie'),
                'movie.movie_id = main_table.movie_id')
            ->joinLeft( array('director'=> 'magenest_director'),
                'director.director_id = movie.director_id', 'director.name as director_name')
            ->joinLeft( array('actor'=> 'magenest_actor'),
            'actor.actor_id = main_table.actor_id', 'actor.name as actor_name')
            ->columns('GROUP_CONCAT(actor.name) as actor_name')
            ->group('name');
        return $collection->getData();
    }
}
