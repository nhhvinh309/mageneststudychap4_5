<?php
namespace Magenest\Study\Controller\Adminhtml\MagenestMovie;
use Magento\Framework\EntityManager\EventManager;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;
    protected $movieFactory;
    protected $movie;
    protected $_eventManager;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magenest\Study\Model\MagenestMovieFactory $movieFactory,
        \Magenest\Study\Model\MagenestMovie $movie,
        EventManager $eventManager
    )
    {
        $this->_eventManager = $eventManager;
        $this->resultPageFactory = $resultPageFactory;
        $this->movieFactory = $movieFactory;
        $this->movie = $movie;
        parent::__construct($context);
    }
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $request = $this->getRequest()->getParams();
        $movie = $this->movieFactory->create();


        if (!empty($request['movie_id'])) {
            $movie->setid($request['movie_id']);
        }
        try{

            $name = $request['name'];
            $description = $request['description'];
            $rating = $request['rating'];
            $this->_eventManager->dispatch('save_a_movie', ['rating' => $rating]);
            $director_id = $request['director_id'];
            $movie->setname($name);
            $movie->setdescription($description);
            $movie->setrating($rating);
            $movie->setdirector_id($director_id);
            $movie->save();
            $this->messageManager->addSuccessMessage(__('Record saved successfully'));
            $this->resultPageFactory->create();
            return $resultRedirect->setPath('study/magenestmovie/index');

        }catch (\Exception $e){
            $this->messageManager->addExceptionMessage($e, __('We can\'t submit your request, Please try again.'));
            $this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);
            return $resultRedirect->setPath('study/magenestmovie/error');
        }
    }
}
