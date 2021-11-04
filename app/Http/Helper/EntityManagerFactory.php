<?php

namespace App\Http\Helper;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;

class EntityManagerFactory
{
    public function getEntityManager(): EntityManagerInterface
    {

        $config = Setup::createAnnotationMetadataConfiguration([
            __DIR__ . "/../Entity/"
        ]);

        $params = [
            'url' => "mysql://root:Sandisk266@localhost/banco_imoveis"
        ];

        $em = EntityManager::create($params, $config);

        return $em;
    }
}
