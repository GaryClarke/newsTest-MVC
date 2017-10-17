<?php



namespace Entity;


use OCFram\Entity;

/*
 * News Extends Entity which implements ArrayAccess. This means that you will be able to access values like so:
 * $news['title']. A hydrate method is used to set the var keys to methods then call the method using the var vals
 * as arguments. e.g. setTitle($title).
 * The constructor receives the vars as a $data array argument
 */
class News extends Entity {

    protected
        $author,
        $title,
        $content,
        $dateAdded,
        $dateModified;

    const INVALID_AUTHOR = 1;
    const INVALID_TITLE = 2;
    const INVALID_CONTENT = 3;

    // isValid. Check that author, title or content are not empty
    public function isValid()
    {
        return !(empty($this->author) || empty($this->title) || empty($this->content));
    }

    // setAuthor.
    public function setAuthor($author)
    {
        // Check IF author is an empty string. If so add INVALID_AUTHOR to the $errors[] array which is found
        // in the parent.
        if (empty($author) || !is_string($author))
        {
            $this->errors[] = self::INVALID_AUTHOR;
        }

        // set the author
        $this->author = $author;
    }



    // setTitle
    public function setTitle($title)
    {
        // Check IF title is an empty string. If so add INVALID_TITLE to the $errors[] array which is found
        // in the parent.
        if (empty($title) || !is_string($title))
        {
            $this->errors[] = self::INVALID_TITLE;
        }

        // set the title
        $this->title = $title;
    }

    //setContent
    public function setContent($content)
    {
        // Check IF content is an empty string. If so add INVALID_CONTENT to the $errors[] array which is found
        // in the parent.
        if (empty($content) || !is_string($content))
        {
            $this->errors[] = self::INVALID_CONTENT;
        }

        // set the content
        $this->content = $content;
    }

    // setDateAdded. This takes the $dateAdded as a PHP DateTime object
    public function setDateAdded(\DateTime $dateAdded)
    {
        $this->dateAdded = $dateAdded;
    }


    // setDateModified. This takes the $dateModified as a PHP DateTime object
    public function setDateModified(\DateTime $dateModified)
    {
        $this->dateModified = $dateModified;
    }


    // GETTERS //
//        $author,
//        $title,
//        $content,
//        $dateAdded,
//        $dateModified;

    public function author()
    {
        return $this->author;
    }

    public function title()
    {
        return $this->title;
    }

    public function content()
    {
        return $this->content;
    }

    public function dateAdded()
    {
        return $this->dateAdded;
    }

    public function dateModified()
    {
        return $this->dateModified;
    }

}