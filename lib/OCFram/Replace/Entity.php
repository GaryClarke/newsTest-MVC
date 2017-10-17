<?php
namespace OCFram;

abstract class Entity implements \ArrayAccess
{
    protected $errors = [],
        $id;

    public function __construct(array $data = [])
    {
        if (!empty($data))
        {
            $this->hydrate($data);
        }
    }

    public function isNew()
    {
        return empty($this->id);
    }

    public function errors()
    {
        return $this->errors;
    }

    public function id()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (int) $id;
    }

    public function hydrate(array $data)
    {
        foreach ($data as $attribute => $value)
        {
            $method = 'set'.ucfirst($attribute);

            if (is_callable([$this, $method]))
            {
                $this->$method($value);
            }
        }
    }

    public function offsetGet($var)
    {
        if (isset($this->$var) && is_callable([$this, $var]))
        {
            return $this->$var();
        }
    }

    public function offsetSet($var, $value)
    {
        $method = 'set'.ucfirst($var);

        if (isset($this->$var) && is_callable([$this, $method]))
        {
            $this->$method($value);
        }
    }

    public function offsetExists($var)
    {
        return isset($this->$var) && is_callable([$this, $var]);
    }

    public function offsetUnset($var)
    {
        throw new \Exception('Impossible de supprimer une quelconque value');
    }
}