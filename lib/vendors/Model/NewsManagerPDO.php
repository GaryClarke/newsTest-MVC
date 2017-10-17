<?php



namespace Model;


class NewsManagerPDO extends NewsManager {

    public function getList($limit = -1, $offset = -1)
    {
        // create the sql query as normal
        $sql = "SELECT id, author, title, content, dateAdded, dateModified FROM news ORDER BY id";

        // Check that neither of $offset / $limit are set to -1 then add the LIMIT and OFFSET to the query, type hint
        // ints
        if ($limit != -1 || $offset != -1)
        {
            $sql .= " LIMIT ". (int) $limit . " OFFSET ". (int) $offset;
        }

        // Make the query - query takes the form of PDO::query(sql). The PDO comes from the
        // Manager __construct($dao). Returns a PDOStatement object
        $query = $this->dao->query($sql);

        // set the fetch mode
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');

        // fetch all into $newsList
        $newsList = $query->fetchAll();

        // loop through newsList, set the dateAdded / Modified to instances of DateTime
        foreach ($newsList as $news)
        {
            $news->setDateAdded(new \DateTime($news->dateAdded()));
            $news->setDateModified(new \DateTime($news->dateModified()));
        }

        // close the cursor
        $query->closeCursor();

        // return the $newsList (this should be an array of News objects)
        return $newsList;

    }

}