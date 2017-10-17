<?php



namespace OCFram;


abstract class Entity implements \ArrayAccess {

    protected $errors = [],
              $id;

    // construct method takes an array of data. This data will be used to construct methods using the hydrate method.
    // E.g. ['title' => 'Random title']
    // Hydrate will then change this to ['setTitle' => 'Random title'].
    // Check that the data array is not empty then call hydrate using this data
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

    // getter
    public function errors()
    {
        return $this->errors();
    }

    public function id()
    {
        return $this->id;
    }

    // check that the passed arg is an int first!
    public function setId($id)
    {
        $this->id = (int) $id;
    }

    // This is used to set all the values for the entity - e.g News(Entity) title(attribute)
    // 1. loop through the data as attribute => value
    // 2. take the attribute to create a method (setThis)
    // 3. check that the method is callable on the method
    // 4. call the method, using value as the argument
    public function hydrate($data)
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

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Whether a offset exists - return true or false - is set and is callable on the class
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $method
     * @return bool true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @internal param mixed $offset <p>
     * An offset to check for.
     * </p>
     */
    public function offsetExists($method)
    {
        return isset($this->$method) && is_callable([$this, $method]);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve - check is set and is callable on the class
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $method
     * @return mixed Can return all value types.
     * @internal param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     */
    public function offsetGet($method)
    {
        if (isset($this->$method) && is_callable([$this, $method]))
        {
            return $this->$method();
        }
        else
        {
            throw new \InvalidArgumentException('The method "'. $method . '" does not exist in this class');
        }
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to set - creating a method manually - i.e. not relying on hydrate
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $method
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @internal param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     */
    public function offsetSet($method, $value)
    {
        $method = 'set'.ucfirst($method);

        if (is_callable([$this, $method]))
        {
            $this->$method($value);
        }
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to unset - throw an exception - not poss!
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $method
     * @internal param mixed $offset <p>
     * The offset to unset.
     * </p>
     */
    public function offsetUnset($method)
    {
        throw new \Exception('It is impossible to delete this value');
    }



}