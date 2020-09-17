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

/**
 * ViewHelper to render the votelinks
 *

 *
 */
class CountVotelinkViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper
{

    /**
     * @param string $arguments

     */
    public static function render(
        string $arguments
    ) {
        $content = '<div class="ratingsbar">';

        for ($i=0;$i < intval($arguments); $i++) {
            $content .= '<a href="javascript:void(0)" rel="nofollow" title="' . $i . 'stars" class="tx-ratings-star-' . $i . '"><span class="texticon-inner-icon glyphicon glyphicon-star"></span></a>';
        }
        $content .= ' </div>';
        return $content;
    }
}
