<?php
/**
 * Created by PhpStorm.
 * User: gamalan
 * Date: 07/10/16
 * Time: 10:24
 */

namespace Application\Router;

use Phalcon\Mvc\Router\Group;

class MainRouter extends Group
{
    public function initialize()
    {
        $this->setPaths([
            'namespaces' => 'Application\\Controllers',
            'controller'=>'barang'
        ]);

        $this->add(
            '/',
            [
                'action' => 'index'
            ]
        );

        $this->add(
            '/barang/index',
            [
                'action' => 'index'
            ]
        );

        $this->add(
            '/barang/show',
            [
                'action' => 'show'
            ]
        );

        $this->add(
            '/barang/add',
            [
                'action' => 'add'
            ]
        );

        $this->add(
            '/barang/create',
            [
                'action' => 'create'
            ]
        );

        $this->add(
            '/barang/save',
            [
                'action' => 'save'
            ]
        );

        $this->add(
            '/barang/delete/:params',
            [
                'action' => 'delete',
                'params' => 1,
            ]
        );

        $this->add(
            '/barang/edit/:params',
            [
                'action' => 'edit',
                'params' => 1,
            ]
        );


        
    }
}