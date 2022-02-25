<?php

namespace App;

use App\Component;

class Category extends Component {
    protected $children;

    public $name;

    public function __construct(string $name = null) {
        $this->children = new \SplObjectStorage();
        $this->name = $name;
    }

    public function add(Component $component): void {
        $this->children->attach($component);
        $component->setParent($this);
    }

    public function render(): string
    {

        $results = "";
        foreach ($this->children as $child) {
            $results.= $child->render();
        }

        $table = "<table style='border: 1px solid;border-collapse: collapse;'>
            <thead>
                <tr>
                    <th style='border: 1px solid;'><b>Product Name</b></th>
                    <th style='border: 1px solid;'><b>Sub Category</b></th>
                    <th style='border: 1px solid;'><b>Category</b></th>
                    <th style='border: 1px solid;'><b>Image of product</b></th>
                    <th style='border: 1px solid;'><b>Price</b></th>
                </tr>
            </thead>
            <tbody>
                $results
            </tbody>
            
        </table>";

        if($this->name == null) {
            return $table;
        }
        return $results;
    }
}