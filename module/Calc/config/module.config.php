<?php
return array(
    'router' => array(
        'routes' => array(            
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'calc' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/calc',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Calc\Controller',
                        'controller'    => 'Calculadora',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:tecla]',
                            'constraints' => array(
                                'tecla' => '[0-9-+=*]',                                
                            ),
                            'defaults' => array(     
                                '__NAMESPACE__' => 'Calc\Controller',
                                'controller'    => 'Calculadora',
                                'action'        => 'tecla',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Calc\Controller\Calculadora' => 'Calc\Controller\CalculadoraController'            
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/calc/calculadora/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);