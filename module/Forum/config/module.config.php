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
        'invokables' => array(
            'Forum\Controller\Forum' => 'Forum\Controller\ForumController'
        ),
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
                            'topicos' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/topicos',
                                    'defaults' => array(
                                        '__NAMESPACE__' => 'Forum\Controller',
                                        'controller' => 'Forum',
                                        'action' => 'topicos',
                                    ),
                                )
                            ),
                            'topico' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/topico/:topicoId[/:action]',
                                    'constraints' => array(
                                        'topicoId' => '[0-9]+',
                                        'action' => '[0-9a-zA-Z_-]+',
                                    ),
                                    'defaults' => array(
                                        '__NAMESPACE__' => 'Forum\Controller',
                                        'controller' => 'Forum',
                                        'action' => 'topico',
                                    ),
                                )
                            )
                        )
                    ),
                )
            ),
        )
    ),
    'view_manager' => array(
        'template_map' => array(
            'forum/forum/index' => __DIR__ . '/../view/forum/forum/index.phtml',
            'forum/forum/topico' => __DIR__ . '/../view/forum/forum/topico.phtml',
            'forum/forum/topicos' => __DIR__ . '/../view/forum/forum/topicos.phtml',
        )
    )
);
