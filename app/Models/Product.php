<?php

namespace App\Models;

// HasFactory is used to automate the migration process (Out of the book's scope)
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
	// use HasFactory;

	// Always include validation into Model NOT controller or create separate class
	public static function validate($request) {
		$request->validate([
			'name' => ['required', 'max:40'],
			'price' => ['required', 'numeric'],
			'description' => ['required', 'max:255'],
			'image' => 'image'
		]);
	}

	/**
	 * Product Attributes
	 * $this->attributes['id'] - int - contains the product primary key (id)
	 * $this->attributes['name'] - string - contains the product name
	 * $this->attributes['description'] - string - contains the product description
	 * $this->attributes['image'] - string - contains the product image
	 * $this->attributes['price'] - int - contains the product price
	 * $this->attributes['created_at'] - timestamp - contains the product creation date
	 * $this->attributes['updated_at'] - timestamp - contains the product update date
	 */

	/**
	 * Use Case:
	 * This method is better and cleaner!
	 * It applies the encapsulation pillar of OOP
	 * And it deals with DB in one singe file/place (Model)
	 * If you want to return UPPERCASE names of all products, you just edit the `getName()` by returning `strtoupper($name)`
	 */

	public function getId()
    {
			return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getName()
    {
        return $this->attributes['name'];

        // Return upper case name
        // return strtoupper($this->attributes['name']);
    }

    public function setName($name)
    {
        $this->attributes['name'] = $name;
    }

    public function getDescription()
    {
        return $this->attributes['description'];
    }

    public function setDescription($description)
    {
        $this->attributes['description'] = $description;
    }

    public function getImage()
    {
        return $this->attributes['image'];
    }

    public function setImage($image)
    {
        $this->attributes['image'] = $image;
    }

    public function getPrice()
    {
        return $this->attributes['price'];
    }

    public function setPrice($price)
    {
        $this->attributes['price'] = $price;
    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt($createdAt)
    {
        $this->attributes['created_at'] = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->attributes['updated_at'] = $updatedAt;
    }
}