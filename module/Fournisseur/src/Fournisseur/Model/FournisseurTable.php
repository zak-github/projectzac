<?php

namespace Fournisseur\Model;

use Zend\Db\TableGateway\TableGateway;

class FournisseurTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()//paginate
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getFournisseur($id)//search id
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveFournisseur(Fournisseur $fournisseur)
    {
        $data = array(
            'intitule' => $fournisseur->intitule,
            'mobile'  => $fournisseur->mobile,
            'N_compte'  => $fournisseur->compte,
            'email'  => $fournisseur->email,
        );

        $id = (int) $fournisseur->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getFournisseur($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('fournisseur id does not exist');
            }
        }
    }

    public function deleteFournisseur($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}