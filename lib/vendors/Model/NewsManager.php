<?php



namespace Model;


use OCFram\Manager;

abstract class NewsManager extends Manager {

    /**
     * Returns a list of required news items
     *
     * @param int $offset - the first selected news item
     * @param int $limit - the number of news items
     * @return mixed - returns an array of News Objects
     */
    abstract public function getList($limit = -1, $offset = -1);

}