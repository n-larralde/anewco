<?php
namespace Application;
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'users' =>  array(
                'type'  =>  'Segment',
                'options'   =>  array(
                    'route' =>  '/users',
                    'defaults'  =>  array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'User',
                        'action'        => 'list',
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'add' => array(
                        'type'    => 'Literal',
                        'options' => array(
                            'route'    => '/add',
                            'defaults' => array(
                                'action'    =>  'add'
                            ),
                        ),
                    ),
                    'sort' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/sort/:field',
                            'defaults' => array(
                                'action'    =>  'sort'
                            ),
                        ),
                    ),
                    'remove' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/remove/:user_id',
                            'defaults' => array(
                                'action'    =>  'remove'
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/edit/:user_id',
                            'defaults' => array(
                                'action'    =>  'edit'
                            ),
                        ),
                    ),
                ),
            )
        ),
    ),
    'doctrine'        => array(
        'driver'       => array(
            'application_driver'        => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/' . __NAMESPACE__ . '/Entity',
                ),

            ),
            'orm_default'               => array(
                'drivers' => array(
                    'Application\Entity'        => 'application_driver'
                )
            )
        ),
        'eventmanager' => array(
            'orm_default' => array(
                'subscribers' => array(

                ),
            ),
        )

    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'fr_FR',
        'translation_file_patterns' => array(
            array(
                'type' => 'phparray',
                'base_dir' => __DIR__ . '/../../language',
                'pattern' => '%s.php'
            )
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\User' => 'Application\Controller\UserController'
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
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
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