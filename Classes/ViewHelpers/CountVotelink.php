<?php

namespace Tp3\Tp3ratings\ViewHelpers;

/**
 * This file is part of the "tp3ratings" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * ViewHelper to render the votelinks
 *

 *
 */
class CountVotelink extends AbstractViewHelper implements CompilableInterface
{
    use CompileWithRenderStatic;

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $content = '<div class="ratingsbar">';

       for($i=1;$i < $arguments; $i++){
           $content .= '<a href="javascript:void(0)" rel="nofollow" title="'.$i.'stars" class="tx-ratings-star-'.$i.'"><span class="texticon-inner-icon glyphicon glyphicon-star"></span></a>';
       }
        $content .= ' </div>';
       return $content;
    }
}
