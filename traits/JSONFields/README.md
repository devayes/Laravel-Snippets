# JSONFields Trait
This trait automatically encodes and decodes array data using JSON.

### Usage
Create file `/app/Traits/JSONFields.php`

```
<?php

namespace App\Traits;

trait JSONFields {

    public function getAttribute($key)
    {
        if (is_array($this->json_fields) && in_array($key, $this->json_fields)) {
            $value = parent::getAttribute($key);
            $value = json_decode($value, true);
            return $value;
        }
    }

   public function setAttribute($key, $value)
   {
        if (is_array($this->json_fields) && in_array($key, $this->json_fields)) {
            $value = json_encode($value);
            return parent::setAttribute($key, $value);
        }
   }
}
``` 

In the model, apply the JSONFields trait like so: 
```
use App\Traits\JSONFields;

class User extends Model { 

    /**
     * Use JSONFields trait
     */
    use JSONFields; 
    
    /**
     * Apply JSONFields trait to these columns
     *
     * @var string
     */
    protected $encryptable = ['permissions']; 
} 
```
