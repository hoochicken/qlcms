<h1><?php echo $strHeadline ?? ''; ?></h1>

<div class="row">
    <div class="col-md-4">
        <h2>Rätsel-Lösung</h2>
        <div>
            <ul>
                <li>Rätsel: <strong><?php echo $strRiddleOld; ?></strong></li>
                <li>Deine Lösung: <?php echo !empty($strUserInput) ? $strUserInput : '-'; ?></li>
                <?php if (0 < count($arrDiff)) : ?>
                    <li>Weitere korrekte Lösungen: <?php echo implode(' ', $arrDiff2); ?></li>
                <?php endif; ?>
                <?php if (0 !== count($arrDiff)) : ?>
                    <li>Vollständige Lösung: <strong style="color:darkslateblue;"><?php echo $strSolution; ?></strong></li>
                <?php else :  ?>
                    <li><?php echo $strMsg; ?></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="col-md-4">
        <h2>Neues Rätsel</h2>
        <form method="post" action="<?php echo $strFormAction ?? ''; ?>"> Form action: '<?php echo $strFormAction ?? ''; ?>'
            <div>Was bedeutet: <strong><?php echo $strRiddleNew ?? 'strRiddleNew'; ?>?</strong></div>
            <input id="solution" name="solution" autofocus />
            <input id="submit" type="submit" value="Antworten" class="checkSubmit"/>
        </form>
    </div>
    <div class="col-md-4">
        <h2>Punktestand</h2>
        <ul>
            <li>richtig <strong style="color:greenyellow;"><?php echo $numCountCorrect; ?></strong></li>
            <!--li>false <strong style="color:darkred;"><?php echo $numCountFalse; ?></strong></li-->
        </ul>
    </div>
</div>