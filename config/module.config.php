<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'SanRestful\Controller\SampleRestful' => 'SanRestful\Controller\SampleRestfulController',
            'SanRestful\Controller\SampleClient' => 'SanRestful\Controller\SampleClientController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'SanRestful' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/san-restful',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'SanRestful\Controller',
                        'controller'    => 'SampleRestful',
                    ),
                ),
                
                'may_terminate' => true,
                'child_routes' => array(

                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:id]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                    
                    'client' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/client[/:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'SampleClient',
                                'action'     => 'index'
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
