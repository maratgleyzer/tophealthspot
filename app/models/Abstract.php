<?php
/**
 * @author adam
 *
 */
abstract class Default_Model_Abstract
{
	protected $_mapper;
	protected $_modelName = 'abstract';

	const SET_RETURN_SELECT = 1;
	const SET_RETURN_ARRAY = 2;

    public function __construct($options = null)
    {
    	if (is_array($options)) {
            $this->setOptions($options);
        }
    }
	
	
    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid '.$this->_modelName .'property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid '.$this->_modelName .'property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }
    
    public function setMapper($mapper)
    {
        $this->_mapper = $mapper;
        return $this;
    }
    
    public function getMapper()
    {
        if (null === $this->_mapper) {
            $this->setMapper($this->getMapperInstance());                     
        }
        return $this->_mapper;
    }
    
    /**
     * @return Default_Model_MapperAbstract
     */
    abstract protected function getMapperInstance();

    public function save()
    {
        $this->getMapper()->save($this);
    }
    
    public function update()
    {
    	$this->getMapper()->update($this);
    }

    public function find($id)
    {
        $this->getMapper()->find($id, $this);
        return $this;
    }
    
    public function delete($id)
    {
    	$this->getMapper()->delete($id);
    	return $this;
    }

    public function fetchAll()
    {
        return $this->getMapper()->fetchAll();
    }
    
    public function fetchAllSelect()
    {
    	return $this->getMapper()->fetchAllSelect();
    }

    public function toArray()
    {
    	$arr = array();
    	foreach( $this as $var => $value )
    	{
    		$var = substr($var, 1);	
    		$arr[$var] = $value;	
    	}
    	return $arr;
    }
}