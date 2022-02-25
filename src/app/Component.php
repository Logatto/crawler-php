<?php

namespace App;

abstract class Component {

    protected $parent;

    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function setParent(Component $parent) {
        $this->parent = $parent;
    }

    public function getParent(): Component{
        return $this->parent;
    }

    public function add(Component $component): void {}

    abstract public function render(): string;
}

