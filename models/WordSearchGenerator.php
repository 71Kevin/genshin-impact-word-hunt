<?php
class WordSearchGenerator
{
    private $words;
    private $width;
    private $height;

    public function __construct($words, $width, $height)
    {
        $this->words = $words;
        $this->width = $width;
        $this->height = $height;
    }

    public function generate()
    {
        $board = $this->initializeBoard();
        foreach ($this->words as $word) {
            $this->placeWord($board, $word);
        }
        $this->fillEmptySpaces($board);
        return $board;
    }

    private function initializeBoard()
    {
        return array_fill(0, $this->height, array_fill(0, $this->width, " "));
    }

    private function placeWord(&$board, $word)
    {
        $wordChars = str_split($word);
        $placed = false;
        $tryCount = 0;

        while (!$placed && $tryCount < 100) {
            $tryCount++;
            $direction = rand(0, 7);
            $col = rand(0, $this->width - 1);
            $row = rand(0, $this->height - 1);
            $colIncrement = $rowIncrement = 0;

            switch ($direction) {
                case 0:
                    if ($col + count($wordChars) <= $this->width) {
                        $colIncrement = 1;
                        $placed = true;
                    }
                    break;
                case 1:
                    if ($col - count($wordChars) >= 0) {
                        $colIncrement = -1;
                        $placed = true;
                    }
                    break;
                case 2:
                    if ($row + count($wordChars) <= $this->height) {
                        $rowIncrement = 1;
                        $placed = true;
                    }
                    break;
                case 3:
                    if ($row - count($wordChars) >= 0) {
                        $rowIncrement = -1;
                        $placed = true;
                    }
                    break;
                case 4:
                    if ($col + count($wordChars) <= $this->width && $row + count($wordChars) <= $this->height) {
                        $colIncrement = $rowIncrement = 1;
                        $placed = true;
                    }
                    break;
                case 5:
                    if ($col + count($wordChars) <= $this->width && $row - count($wordChars) + 1 >= 0) {
                        $colIncrement = 1;
                        $rowIncrement = -1;
                        $placed = true;
                    }
                    break;
                case 6:
                    if ($col - count($wordChars) + 1 >= 0 && $row + count($wordChars) <= $this->height) {
                        $colIncrement = -1;
                        $rowIncrement = 1;
                        $placed = true;
                    }
                    break;
                case 7:
                    if ($col - count($wordChars) + 1 >= 0 && $row - count($wordChars) + 1 >= 0) {
                        $colIncrement = $rowIncrement = -1;
                        $placed = true;
                    }
                    break;
            }

            if ($placed) {
                for ($i = 0, $r = $row, $c = $col; $i < count($wordChars); $i++, $r += $rowIncrement, $c += $colIncrement) {
                    if ($board[$r][$c] !== " " && $board[$r][$c] !== $wordChars[$i]) {
                        $placed = false;
                        break;
                    }
                }
            }
        }

        if ($placed) {
            for ($i = 0, $r = $row, $c = $col; $i < count($wordChars); $i++, $r += $rowIncrement, $c += $colIncrement) {
                $board[$r][$c] = $wordChars[$i];
            }
        }
    }

    private function fillEmptySpaces(&$board)
    {
        $letters = range("A", "Z");
        for ($i = 0; $i < $this->height; $i++) {
            for ($j = 0; $j < $this->width; $j++) {
                if ($board[$i][$j] === " ") {
                    $board[$i][$j] = $letters[array_rand($letters)];
                }
            }
        }
    }
}
?>
