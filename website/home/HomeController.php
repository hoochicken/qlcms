<?php


class HomeController
{
    private $objView;
    private $objRouter;
    private $arrContent = [];

    public function __construct(View $objView, AltoRouter $objRouter)
    {
        $this->objView = $objView;
        $this->objRouter = $objRouter;
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
        $strCsv = file_get_contents('data/latin.csv');
        $objCsv = new Csv($strCsv);
        $arrVoc = $objCsv->getRowRandom();

        // prepare data to display, and to store in session later on
        $objRiddle = new Riddle($arrVoc);
        $strRiddleNew = $objRiddle->getRiddle();

        $strTranslationNew = $objRiddle->getTranslation();
        $strSolutionNew = $objRiddle->getSolution();
        $arrRiddleNew = [
            'Riddle' => $strRiddleNew,
            'solution' => $objRiddle->getSolution(),
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

        $arrCorrect = array_intersect($arrUserInput, $arrSolution);
        $strMsg = '';

        $strRiddleOld = $arrSolutionRaw['Riddle'] ?? '';

        $_SESSION['Riddle'] = $arrRiddleNew;
        $_SESSION['countCorrect'] = $numCountCorrect;
        $_SESSION['countFalse'] = $numCountFalse;

        $strFormAction = $this->objRouter->generate('riddle_up', []);
        //$strFormAction = $this->objRouter->generate('riddle_up', array('id' => 10, 'action' => 'update'));
        $arrParams = [
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
        $this->arrContent['strMain'] = $this->objView->render(__DIR__ . '/html/index.php', $arrParams);



        //$this->arrContent['strRiddleNew'] = $this->objModel->getRiddleRand();
    }

    /**
     * @return array
     */
    public function getContent(): array
    {
        return $this->arrContent;
    }
}