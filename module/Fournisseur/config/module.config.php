<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Fournisseur\Controller\Fournisseur' => 'Fournisseur\Controller\FournisseurController',
        ),
    ),
    //route
    'router' => array(
        'routes' => array(
            //********
            'fournisseur' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/fournisseur[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Fournisseur\Controller\Fournisseur',
                        'action'     => 'index',
                    ),
                ),
            ),

            // route add ***********
        ),
    ),
    //view**************************

    'view_manager' => array(
        'template_path_stack' => array(
            'fournisseur' => __DIR__ . '/../view',
        ),
    ),
);