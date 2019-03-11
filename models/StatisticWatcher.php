<?php

/**
 * Class StatisticWatcher
 * Watches ModelFight object
 */
Class StatisticWatcher implements SplObserver
{
    public $result_statistic_text = '</br>Battle begins!  ';

    function update(SplSubject $subject)
    {
        $this->result_statistic_text .= $subject->getStatisticStory();
    }

    public function getResultStatisticText()
    {
        return $this->result_statistic_text;
    }
}
