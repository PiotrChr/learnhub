<?php
namespace LearnHub\BackendBundle\Services;

use Symfony\Component\Form\Form;

class GetFormErrors {

    public function getErrors(Form $form) {
        $errors = array();

        foreach ($form->getErrors() as $key => $error) {
            if ($form->isRoot()) {
                $errors['#'][] = $error->getMessage();
            } else {
                $errors[] = $error->getMessage();
            }
        }

        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = $this->getErrors($child);
            }
        }

        return $errors;
    }
}