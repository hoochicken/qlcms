<?php


class HomeController implements \php\ContentControllerInterface\ContentControllerInterface
{
    private $view;
    private $router;
    private array $content = [];
    private string $main;

    public function __construct(View $view, AltoRouter $router)
    {
        $this->view = $view;
        $this->router = $router;
    }

    /**
     *
     */
    public function displayAction()
    {
        // include stuff
        require_once __DIR__ . '/../../php/Csv.php';
        require_once __DIR__ . '/../../php/Riddle.php';

        // load riddles by csv
        $csv = file_get_contents('data/latin.csv');
        $csv = new Csv($csv);
        $arrVoc = $csv->getRowRandom();

        // prepare data to display, and to store in session later on
        $riddle = new Riddle($arrVoc);
        $strRiddleNew = $riddle->getRiddle();

        $strTranslationNew = $riddle->getTranslation();
        $strSolutionNew = $riddle->getSolution();
        $riddleNew = [
            'Riddle' => $strRiddleNew,
            'solution' => $riddle->getSolution(),
        ];


        // get correct solution from session
        session_start();
        $arrSolutionRaw = $_SESSION['Riddle'] ?? [];
        $strSolution = $arrSolutionRaw['solution'] ?? '';
        $arrSolution = explode(' ', str_replace(['.', ','], '', trim($strSolution)));

        $numCountCorrect = $_SESSION['countCorrect'] ?? 0;
        $numCountFalse = $_SESSION['countFalse'] ?? 0;

        // get insert from user
        $strUserInput = $_POST['solution'] ?? '';
        $arrUserInput = explode(' ', str_replace(['.', ','], '', strtolower(trim($strUserInput))));

        $arrDiff1 = array_diff($arrUserInput, $arrSolution);
        $arrDiff2 = array_diff($arrSolution, $arrUserInput);
        $arrDiff = array_unique(array_merge($arrDiff1, $arrDiff2));

        $correct = array_intersect($arrUserInput, $arrSolution);
        $strMsg = '';

        $strRiddleOld = $arrSolutionRaw['Riddle'] ?? '';

        $_SESSION['Riddle'] = $riddleNew;
        $_SESSION['countCorrect'] = $numCountCorrect;
        $_SESSION['countFalse'] = $numCountFalse;

        $strFormAction = $this->router->generate('riddle_up', []);
        //$strFormAction = $this->router->generate('riddle_up', array('id' => 10, 'action' => 'update'));
        $params = [
            'strRiddleOld' => $strRiddleOld,
            'strUserInput' => $strUserInput,
            'arrDiff' => $arrDiff,
            'arrDiff2' => $arrDiff2,
            'strSolution' => $strSolution,
            'strMsg' => $strMsg,
            'strRiddleNew' => $strRiddleNew,
            'numCountCorrect' => $numCountCorrect,
            'strFormAction' => $strFormAction,
        ];
        $this->content['main'] = $this->view->render(__DIR__ . '/html/index.php', $params);
        $this->main = $this->view->render(__DIR__ . '/html/index.php', $params);



        //$this->content['strRiddleNew'] = $this->objModel->getRiddleRand();
    }

    public function getContent(): array
    {
        return $this->content;
    }

    public function getMain(): string
    {
        return $this->main;
    }
}