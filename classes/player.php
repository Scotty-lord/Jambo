<?php
class Players
{
    private $name;
    private $color;

    public function __construct($name, $color)
    {
        $this->setName($name);
        $this->setColor($color);
    }

    public function setName($name)
    {
        $this->name = ucwords($name);
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getColor()
    {
        return $this->color;
    }
}

?>