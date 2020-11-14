<?php

namespace Fournisseur\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class FournisseurForm extends Form
{
    public function __construct($name = null)
    {
        $this->element();

    }

    public function element()
    {

        // we want to ignore the name passed
        parent::__construct('fournisseur');


        $this->add(array(
            'name' => 'id',

            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'intitule',
            'type' => 'Text',
            'options' => array(
                'label' => 'intitule',
            ),
            'attributes' => array(
                'class' => 'form-control',

            ),
        ));
        $this->add(array(
            'name' => 'mobile',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'type' => 'Text',
            'options' => array(
                'label' => 'mobile',
            ),


        ));

        $this->add(array(
            'name' => 'compte',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'type' => 'Text',
            'options' => array(
                'label' => 'N° Compte',
            ),


        ));
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'type' => 'Text',
            'options' => array(
                'label' => 'Email',
            ),


        ));


        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
                'class'=>'btn btn-info',
            ),
            'options' => array(
                'label' => 'nouveau',
            ),
        ));


    }


}