<?php
/* --------------------------------------------------------------
   SkeletonModuleAjaxController.inc.php 2020-06-26
   Gambio GmbH
   http://www.gambio.de
   Copyright (c) 2020 Gambio GmbH
   Released under the GNU General Public License (Version 2)
   [http://www.gnu.org/licenses/gpl-2.0.html]
   --------------------------------------------------------------
*/

class SkeletonModuleAjaxController extends AdminHttpViewController
{
    private $timeManager;
    
    /**
     * SkeletonModuleController constructor.
     *
     * @param \HttpContextReaderInterface     $httpContextReader
     * @param \HttpResponseProcessorInterface $httpResponseProcessor
     * @param \ContentViewInterface           $defaultContentView
     */
    public function __construct(
        HttpContextReaderInterface $httpContextReader,
        HttpResponseProcessorInterface $httpResponseProcessor,
        ContentViewInterface $defaultContentView
    ) {
        $this->timeManager = SkeletonTimeManager::getInstance();
        
        parent::__construct($httpContextReader, $httpResponseProcessor, $defaultContentView);
    }
    
    public function actionStartTimer()
    {
        $this->timeManager->setTimerStarted();

        $responseData = ['success' => true];
        return new JsonHttpControllerResponse($responseData);
    }
    
    public function actionResetTimer()
    {
        $this->timeManager->resetTimer();
        
        $responseData = ['success' => true];
        return new JsonHttpControllerResponse($responseData);
    }
    
    
}
