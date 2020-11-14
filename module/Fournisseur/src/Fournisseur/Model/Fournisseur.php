<?php

namespace Fournisseur\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Fournisseur implements InputFilterAwareInterface
{
    public $id;
    public $intitule;
    public $mobile;
    public $compte;
    protected $inputFilter;                       // <-- Add this variable

    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id']))     ? $data['id']     : null;
        $this->intitule = (isset($data['intitule'])) ? $data['intitule'] : null;
        $this->mobile  = (isset($data['mobile']))  ? $data['mobile']  : null;
        $this->compte  = (isset($data['compte']))  ? $data['compte']  : null;
        $this->email  = (isset($data['email']))  ? $data['email']  : null;

    }

    // Add content to these methods:
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name'     => 'id',
                'required' => true,

                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'intitule',
                'required' => true,


                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'mobile',
                //'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'compte',
                //'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'email',
                //'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
//****************************edit form st
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}