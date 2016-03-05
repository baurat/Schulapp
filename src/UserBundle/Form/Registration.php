<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class Registration extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('vorname');
        $builder->add('name');
        $builder->add('gebdatum');
        $builder->add('geschlecht');
    }

    public function getParent() {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix() {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName() {
        return $this->getBlockPrefix();
    }

}
