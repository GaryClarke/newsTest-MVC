<?php
namespace Model;

use \OCFram\Manager;

abstract class NewsManager extends Manager
{

    /**
     * Méthode retournant une liste de news demandée
     * @param int $offset
     * @param int $limit
     * @return array La liste des news. Chaque entrée est une instance de News.
     * @internal param int $debut La première news à sélectionner
     * @internal param int $limite Le nombre de news à sélectionner
     */
    abstract public function getList($limit = -1, $offset = -1);
}