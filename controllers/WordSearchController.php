<?php
require_once 'models/WordSearchGenerator.php';

class WordSearchController
{
    private $words = [
        "Albedo", "Alhaitham", "Aloy", "Amber", "Arlecchino", "Ayaka", "Ayato", "Baizhu", "Barbara", "Beidou",
        "Bennett", "Candace", "Charlotte", "Chevreuse", "Chiori", "Chongyun", "Collei", "Cyno", "Dehya", "Diluc",
        "Diona", "Dori", "Eula", "Faruzan", "Fischl", "Freminet", "Furina", "Gaming", "Ganyu", "Gorou", "Heizou",
        "Hu Tao", "Itto", "Jean", "Kaeya", "Kaveh", "Kazuha", "Keqing", "Kirara", "Klee", "Kokomi", "Layla", "Lisa",
        "Lynette", "Lyney", "Mika", "Mona", "Nahida", "Navia", "Neuvillette", "Nilou", "Ningguang", "Noelle", "Qiqi",
        "Raiden", "Razor", "Rosaria", "Sara", "Sayu", "Shenhe", "Shinobu", "Sucrose", "Tartaglia", "Thoma", "Tighnari",
        "Traveler", "Venti", "Wanderer", "Wriothesley", "Xiangling", "Xianyun", "Xiao", "Xingqiu", "Xinyan", "Yae Miko",
        "Yanfei", "Yaoyao", "Yelan", "Yoimiya", "Yun Jin", "Zhongli",
    ];
    private $width = 10;
    private $height = 10;

    public function handleRequest()
    {
        $generator = new WordSearchGenerator($this->words, $this->width, $this->height);
        $board = $generator->generate();
        $words = $this->words;
        require 'views/wordSearchView.php';
    }
}
?>
