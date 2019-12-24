<?php
namespace Magenest\Study\Controller\Adminhtml\MagenestActor;
class Save extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;
    protected $actorFactory;
    protected $actor;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magenest\Study\Model\MagenestActorFactory $actorFactory,
        \Magenest\Study\Model\MagenestActor $actor
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->actorFactory = $actorFactory;
        $this->actor = $actor;
        parent::__construct($context);
    }
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $request = $this->getRequest()->getParams();
        $actor = $this->actorFactory->create();
        if (!empty($request['actor_id'])) {
            $actor->setid($request['actor_id']);
        }
        try{
            $name = $request['name'];
            $actor->setname($name);
            $actor->save();
            $this->messageManager->addSuccessMessage(__('Record saved successfully'));
            $this->resultPageFactory->create();
            return $resultRedirect->setPath('study/magenestactor/index');

        }catch (\Exception $e){
            $this->messageManager->addExceptionMessage($e, __('We can\'t submit your request, Please try again.'));
            $this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);
            return $resultRedirect->setPath('study/magenestactor/error');
        }
    }
}
