# Encryptable Trait

### Usage
Create file `/app/Traits/Encryptable.php`

```
<?php

namespace App\Traits;

trait Encryptable {

    public function getAttribute($key) 
    { 
        $value = parent::getAttribute($key);

        if (in_array($key, $this->encryptable)) { 
            $value = decrypt($value); 
        } 

        return $value; 
    } 
    
    public function setAttribute($key, $value) 
    { 
        if (in_array($key, $this->encryptable)) { 
            $value = encrypt($value); 
        }

        return parent::setAttribute($key, $value); 
    } 
    
} 
``` 

In the model, apply the Encryptable trait like so: 
```
use App\Traits\Encryptable;

class Messages extends Model { 

    /**
     * Use Encryptable trait
     */
    use Encryptable; 
    
    /**
     * Apply Encryptable trait to these columns
     *
     * @var string
     */
    protected $encryptable = [ 'title', 'message']; 
} 
```
