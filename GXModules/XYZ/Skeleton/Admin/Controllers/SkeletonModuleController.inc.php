<?php
/* --------------------------------------------------------------
   SkeletonModuleController.inc.php 2020-06-25
   Gambio GmbH
   http://www.gambio.de
   Copyright (c) 2020 Gambio GmbH
   Released under the GNU General Public License (Version 2)
   [http://www.gnu.org/licenses/gpl-2.0.html]
   --------------------------------------------------------------
*/

require_once __DIR__ . '/../Core/SkeletonTimeManager.php';

class SkeletonModuleController extends AdminHttpViewController
{
    private $timeManager;
    private $languageTextManager;

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
        $this->languageTextManager = new LanguageTextManager('skeleton_module', $_SESSION['languages_id']);

        parent::__construct($httpContextReader, $httpResponseProcessor, $defaultContentView);
    }
    
    
    /**
     * Gets navigation content.
     *
     * @param bool $mainPage
     *
     * @return bool|\ContentNavigationCollection
     */
    private function getContentNavigation($mainPage = false)
    {
        $contentNavigation = MainFactory::create('ContentNavigationCollection', []);
        $contentNavigation->add(new StringType($this->languageTextManager->get_text('HOME', 'skeleton_module')), new StringType('admin.php?do=SkeletonModule'), new BoolType($mainPage));
        $contentNavigation->add(new StringType($this->languageTextManager->get_text('CONFIGURATION', 'skeleton_module')), new StringType('admin.php?do=SkeletonModule/configuration'), new BoolType(!$mainPage));
        
        return $contentNavigation;
    }


    /**
     * Home page action.
     *
     * @return mixed
     */
    public function actionDefault()
    {
        $title             = new NonEmptyStringType($this->languageTextManager->get_text('PAGE_TITLE', 'skeleton_module'));
        $template          = new ExistingFile(new NonEmptyStringType(__DIR__ . '/../Html/skeleton_module.html'));

        $assets            = new AssetCollection([
            new Asset('../GXModules/XYZ/Skeleton/Admin/Javascript/timer.js'),
            new Asset('../GXModules/XYZ/Skeleton/Admin/Styles/skeleton_module.css'),
        ]);

        $data              = new KeyValueCollection([
            'remained' => $this->timeManager->getRemainedTime(),
            'timer_value' => $this->timeManager->getTimerInSeconds()
        ]);

        return new AdminLayoutHttpControllerResponse($title, $template, $data, $assets, $this->getContentNavigation(true));
    }
    
    
    /**
     * Configuration page.
     *
     * @return \AdminLayoutHttpControllerResponse
     */
    public function actionConfiguration()
    {
        if (isset($_POST['skeleton_timer'])) {
            $timer = $this->timeManager->sanitize($_POST['skeleton_timer']);
            $this->timeManager->setTimer($timer);
            $this->timeManager->resetTimer();
        } else {
            $timer = $this->timeManager->getTimer() ?: '00:00:00';
        }

        $title = new NonEmptyStringType($this->languageTextManager->get_text('PAGE_TITLE', 'skeleton_module'));
        $data = new KeyValueCollection([
            'timer_value' => $timer
        ]);

        $template = new ExistingFile(new NonEmptyStringType(__DIR__ . '/../Html/skeleton_configuration.html'));
        return new AdminLayoutHttpControllerResponse($title, $template, $data, null, $this->getContentNavigation());
    }
}
