<?php
namespace Entity;

use \OCFram\Entity;

class News extends Entity
{
    protected $author,
        $title,
        $content,
        $dateAdded,
        $dateModified;

    const INVALID_AUTHOR = 1;
    const INVALID_TITLE = 2;
    const INVALID_CONTENT = 3;

    public function isValid()
    {
        return !(empty($this->author) || empty($this->title) || empty($this->content));
    }


    // SETTERS //

    public function setAuthor($author)
    {
        if (!is_string($author) || empty($author))
        {
            $this->errors[] = self::INVALID_AUTHOR;
        }

        $this->author = $author;
    }

    public function setTitle($title)
    {
        if (!is_string($title) || empty($title))
        {
            $this->errors[] = self::INVALID_TITLE;
        }

        $this->title = $title;
    }

    public function setContent($content)
    {
        if (!is_string($content) || empty($content))
        {
            $this->errors[] = self::INVALID_CONTENT;
        }

        $this->content = $content;
    }

    public function setDateAdded(\DateTime $dateAdded)
    {
        $this->dateAdded = $dateAdded;
    }

    public function setDateModified(\DateTime $dateModified)
    {
        $this->dateModified = $dateModified;
    }

    // GETTERS //

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