<?php
namespace Magenest\Study\Observer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
class SaveMovie implements ObserverInterface
{
    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $rating = $observer->getData('rating');
        $rating = 0;
        return $rating;
    }
}