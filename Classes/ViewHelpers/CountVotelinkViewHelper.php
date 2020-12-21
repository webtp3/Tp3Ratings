<?php

/*
 * This file is part of the web-tp3/tp3ratings.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Tp3\Tp3ratings\ViewHelpers;

/**
 * This file is part of the "tp3ratings" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use Tp3\Tp3ratings\Domain\Model\Ratingsdata;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;
/**
 * ViewHelper to render the votelinks
 *

 *
 */
class CountVotelinkViewHelper extends AbstractTagBasedViewHelper
{

    public function initializeArguments()
    {
        parent::initializeArguments();

        $this->registerArgument('ratingdata', Ratingsdata::class, 'Ratingsdata', true);
        $this->registerArgument('eIDTp3', 'string', 'eIDTp3: rating | review', false, '');
        $this->registerArgument('check', 'string', 'check: base64_decode', true, '');
        $this->registerArgument('stars', 'integer', 'count starts', false, '5');

    }


    /**
     * @param

     */
    public function render() {
        $content = '<div class="ratingsbar">';

        for ($i=0;$i < intval($this->arguments['stars']); $i++) {
            $content .= '<a href="javascript:void(0)" rel="nofollow" title="' . $i . 'stars" class="tx-ratings-star-' . $i . '"><span class="texticon-inner-icon glyphicon glyphicon-star"></span></a>';
        }
        $content .= ' </div>';
        return $content;
    }
}
