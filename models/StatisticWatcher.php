<?php

/**
 * Class StatisticWatcher
 * Watches ModelFight object
 */
Class StatisticWatcher implements SplObserver
{
    private $result_statistic_text = '</br>Battle begins!  ';
    private $result_file_text;

    function update(SplSubject $subject)
    {
        $this->result_statistic_text .= $subject->getStatisticStory();
    }
    /**
     * Make all battle log
     * @return string
     */
    public function getResultStatisticText()
    {
        return $this->result_statistic_text;
    }

    public function makeStatisticFile ()
    {
        $this->result_file_text =
            preg_replace('~</br>~', "\r\n", $this->result_statistic_text);
        $files_name_array = glob(ROOT . '/Statistic/*.txt');
        foreach ($files_name_array as $file){
            $file_list[filemtime($file)] = $file;
        }
        if (count($files_name_array)==0){
            $file = fopen(ROOT . '/Statistic/BattleStats1.txt', 'w+');
            if ($file == false){
                throw new BattleException ();
            }
            fwrite($file, $this->result_file_text);
            fclose($file);
            return true;
        }
        krsort($file_list);
        $digital_str = substr(array_shift($file_list),0);
        $str_enter = strpos($digital_str,'BattleStats');
        $digital_str = substr($digital_str, $str_enter+11);
        $digit = intval(preg_replace('/.txt/',"",$digital_str));
        if ($file == false){
            throw new BattleException ();
        }$file = fopen(ROOT . '/Statistic/BattleStats'.++$digit.'.txt', 'w+');
        fwrite($file, $this->result_file_text);
        fclose($file);
        return true;
    }
}
