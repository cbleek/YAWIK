<?php
/**
 * YAWIK
 *
 * @filesource
 * @copyright (c) 2013 - 2016 Cross Solution (http://cross-solution.de)
 * @license   MIT
 */

/** Rating.php */
namespace Core\Form\Element;

use Laminas\Form\Element;
use Laminas\Form\Element\Date;
use Core\Entity\RatingInterface;

/**
 * Star rating element.
 *
 * @author Mathias Gelhausen <gelhausen@cross-solution.de>
 */
class DatePicker extends Date implements ViewHelperProviderInterface
{

    /**
     * @var string
     */
    protected $helper = 'formDatePicker';

    /**
     * @param string|\Laminas\View\Helper\HelperInterface $helper
     * @return $this|ViewHelperProviderInterface
     */
    public function setViewHelper($helper)
    {
        $this->helper = $helper;
        return $this;
    }

    /**
     * @return string|\Laminas\View\Helper\HelperInterface
     */
    public function getViewHelper()
    {
        return $this->helper;
    }
}
