<?php

return array(
    'doctrine' => array(
        'driver' => array(
            'forum_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Forum/Model/Entidade')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Forum\Model\Entidade' => 'forum_entities'
                )
            ),
        )
    ),
    'controllers' => array(
        'factories' => array(
            'Forum\Controller\Forum' => 'Forum\Factory\ForumControllerFactory'
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Forum\Service\ForumService' => 'Forum\Factory\ForumServiceFactory'
        ),
        'invokables' => array(
            'Forum\Service\TimeService' => 'Forum\Service\TimeService'
        )
    ),
    'router' => array(
        'routes' => array(
            'default' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/forum',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Forum\Controller',
                        'controller' => 'Forum',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'forum' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/:forumId',
                            'constraints' => array(
                                'forumId' => '[0-9]+',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Forum\Controller',
                                'controller' => 'Forum',
                                'action' => 'topicos',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'novo-topico' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/novo-topico',                                    
                                    'defaults' => array(
                                        '__NAMESPACE__' => 'Forum\Controller',
                                        'controller' => 'Forum',
                                        'action' => 'novoTopico',
                                    ),
                                ),
                                'may_terminate' => true
                            ),
                        )
                    ),
                )
            ),
        )
    ),
    'view_manager' => array(
        'template_map' => array(
            'forum/forum/index' => __DIR__ . '/../view/forum/forum/index.phtml',
            'forum/forum/topicos' => __DIR__ . '/../view/forum/forum/topicos.phtml',
        )
    )
);
