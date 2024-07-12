<?php

namespace App\Services;


use PhpOffice\PhpWord\TemplateProcessor;

class CustomTemplateProcessor extends TemplateProcessor
{
    /**
     * Replace a block.
     *
     * @param string $blockname
     * @param string $replacement
     */
    public function replaceBlock($blockname, $replacement): void
    {
        $escapedMacroOpeningChars = preg_quote(self::$macroOpeningChars);
        $escapedMacroClosingChars = preg_quote(self::$macroClosingChars);

        $this->tempDocumentMainPart = preg_replace(
            '#' . $escapedMacroOpeningChars . $blockname . $escapedMacroClosingChars .'.*' . $escapedMacroOpeningChars . '\/' .$blockname  . $escapedMacroClosingChars . '#isU',
            $replacement,
            $this->tempDocumentMainPart
        );
    }
}
