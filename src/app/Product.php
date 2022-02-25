<?php

namespace App;

use App\Component;

class Product extends Component {

    public $name;
    public $image;
    public $price;

    public function __construct(string $name, string $image, string $price)
    {
        $this->name = $name;
        $this->image = $image;
        $this->price = $price;
    }

    private function haveSubCategory() {
        return $this->getParent()->getParent()->name !== null;
    }


    private function getCategory() {
        if(!$this->haveSubCategory()) {
            return $this->getParent()->name;
        }else {
            return $this->getParent()->getParent()->name; 
        }
    }

    private function getSubCategory() {
        if($this->haveSubCategory()){
            return $this->getParent()->name;
        }
        return;
    }

    public function render(): string {
        return "
        <tr>
            <td style='border: 1px solid;'> $this->name </td>
            <td style='border: 1px solid;'> {$this->getSubCategory()} </td>
            <td style='border: 1px solid;'> {$this->getCategory()} </td>
            <td style='border: 1px solid;'> <img src='{$this->image}' width='50' /> </td>
            <td style='border: 1px solid;'> {$this->price} </td>
        </tr>
        ";
    }
}