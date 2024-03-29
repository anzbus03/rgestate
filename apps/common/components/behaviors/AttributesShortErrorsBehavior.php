<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * AttributesShortErrorsBehavior
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class AttributesShortErrorsBehavior extends CBehavior
{
    /**
     * AttributesShortErrorsBehavior::getAll()
     * 
     * @return array
     */
    public function getAll()
    {
        $_errors = array();
        foreach ($this->owner->getErrors() as $attribute => $errors) {
            if (empty($errors)) {
                continue;
            }
            $_errors[$attribute] = is_array($errors) ? reset($errors) : $errors;
        }
        return $_errors;
    }
    
    /**
     * AttributesShortErrorsBehavior::getAllAsString()
     * 
     * @param string $separator
     * @return string
     */
    public function getAllAsString($separator = '<br />')
    {
        return implode($separator, array_values($this->getAll()));
    }
}