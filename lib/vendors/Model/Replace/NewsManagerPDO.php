<?php
namespace Model;

use \Entity\News;

class NewsManagerPDO extends NewsManager
{
    public function getList($limit = -1, $offset = -1)
    {
        $sql = 'SELECT id, author, title, content, DateAdded, DateModified FROM news ORDER BY id DESC';

        if ($offset != -1 || $limit != -1)
        {
            $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $offset;
        }

        $query = $this->dao->query($sql);
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');

        $newsList = $query->fetchAll();

        foreach ($newsList as $news)
        {
            $news->setDateAdded(new \DateTime($news->DateAdded()));
            $news->setDateModified(new \DateTime($news->DateModified()));
        }

        $query->closeCursor();

        return $newsList;
    }
}