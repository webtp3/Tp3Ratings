<?php

/*
 * This file is part of the web-tp3/tp3ratings.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Tp3\Tp3ratings\View;

/*
 * This file is part of the Ajax example TYPO3 extension.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read
 * LICENSE file that was distributed with this source code.
 */
use TYPO3\CMS\Extbase\Mvc\View\AbstractView;

/**
 * Class HelloJsonView
 */
class Rating extends AbstractView
{
    /**
     * Renders the view
     *
     * @return string The rendered view
     *
     * @api
     */
    public function render()
    {
        return json_encode(['Hello World', $this->variables['time']]);
    }
}
