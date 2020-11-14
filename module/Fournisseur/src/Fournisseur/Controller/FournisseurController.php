<?php

namespace Fournisseur\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Fournisseur\Model\Fournisseur;          // <-- Add this import
use Fournisseur\Form\FournisseurForm;
class FournisseurController extends AbstractActionController
{
    protected $fournisseurTable;

    public function getFournisseurTable()
    {
        if (!$this->fournisseurTable) {
            $sm = $this->getServiceLocator();
            $this->fournisseurTable = $sm->get('Fournisseur\Model\FournisseurTable');
        }
        return $this->fournisseurTable;
    }
    //****************************


    public function indexAction()
    {
        return new ViewModel(array(
            'fournisseurs' => $this->getFournisseurTable()->fetchAll(),
        ));
    }



    //***************FORM
    // Add content to this method:
    public function addAction()
    {
        $form = new FournisseurForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $fournisseur = new Fournisseur();
            $form->setInputFilter($fournisseur->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $fournisseur->exchangeArray($form->getData());
                $this->getFournisseurTable()->saveFournisseur($fournisseur);

                // Redirect to list of

                return $this->redirect()->toRoute('fournisseur');
            }
        }
        return array('form' => $form);
    }
    //*************************************edit action

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('fournisseur', array(
                'action' => 'add'
            ));
        }


        try {
            $fournisseur = $this->getFournisseurTable()->getFournisseur($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('fournisseur', array(
                'action' => 'index'
            ));
        }

        $form  = new FournisseurForm();
        $form->bind($fournisseur);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($fournisseur->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getFournisseurTable()->saveFournisseur($fournisseur);

                //
                return $this->redirect()->toRoute('fournisseur');

            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    //************************************delete action

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('fournisseur');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getFournisseurTable()->deleteFournisseur($id);
            }

            // Redirect to list of
            return $this->redirect()->toRoute('fournisseur');
        }

        return array(
            'id'    => $id,
            'fournisseur' => $this->getFournisseurTable()->getFournisseur($id)
        );
    }
    //...
    /**/
}
