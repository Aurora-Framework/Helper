## Aurora.Helper.Form

```php
   /**
    * Stores array to values
    *
    * @method withData
    * @param  array   $values Array of values with their keys
    *
    */
   public function withData($values = [])


   /**
    * Adds or replace value to values array with given key
    * @method addValue
    * @param  string   $key   Name or key for given input
    * @param  string   $value Value for given key/name
    */
   public function addValue($key, $value = null)


   /**
    * Returns value for given key/name
    * @method getValue
    * @param  string   $key     Identifying key
    * @param  string   $default Default value if value for givent key is not found
    * @return string   Found or default value
    */
   public function getValue($key, $default = null)


   /**
    * Opens form
    * @method open
    * @param  string $action     Action for form
    * @param  array|string $attributes Attributes for form
    * @return string First line of Form
    */
   public function open($action = "/", $attributes = null)


   /**
    * Closes form
    * @method close
    * @return string Ending line of form
    */
   public function close()


   /**
    * Generates hidden input for form
    * @method hidden
    * @param  string $name       Name of input (unique)
    * @param  string $value      Value for input
    * @param  array|string $attributes Attributes for input
    * @return string Hidden input
    */
   public function hidden($name, $value = null, $attributes = null)


   /**
    * Generates text input
    * @method input
    * @param  string $name       Name of input (unique)
    * @param  string $value      Value for input
    * @param  array|string $attributes Attributes for input
    * @return string Input with text type
    */
   public function input($name, $value = null, $attributes = null)


   /**
    * Generates password input
    * @method password
    * @param  string   $name       Name of input (unique)
    * @param  string   $value      Value for input
    * @param  array|string   $attributes Attributes for input
    * @return string   Input with password type
    */
   public function password($name, $value = null, $attributes = null)

   /**
    * Generates dropdown
    * @method dropdown
    * @param  string   $name      Name of dropdown
    * @param  array   $options   Array of options for dropdown
    * @param  array|string   $atributes Attributes for dropdown
    * @return string   Returns generated dropdown
    */
   public function dropdown($name, $options = [], $atributes = null)


   /**
    * Generates multiselect
    * @method dropdown
    * @param  string   $name      Name of multiselect
    * @param  array   $options   Array of options for multiselect
    * @param  array   $selected   Array of selected for multiselect
    * @param  array|string   $atributes Attributes for multiselect
    * @return string   Returns generated multiselect
    */
   public function multiSelect($name, $options = [], $selected = [], $atributes = null)


   /**
    * Opens fieldset
    * @method fieldsetOpen
    * @param  string       $legend     Text for legend
    * @param  array|string       $attributes Attributes for form
    * @return string Opened fieldset
    */
   public function fieldsetOpen($legend = null, $attributes = null)


   /**
    * Closes fieldset
    * @method fieldsetClose
    * @return string End of fieldset
    */
   public function fieldsetClose()

   /**
    * Generates checkbox
    * @method password
    * @param  string   $name       Name of input (unique)
    * @param  string   $value      Value for input
    * @param  bool     $checked    Checked or not?
    * @param  array|string   $attributes Attributes for input
    * @return string   Input with checkbox type
    */
   public function checkbox($name, $value = null, $checked = false, $attributes = null)


   /**
    * Generates radio
    * @method password
    * @param  string   $name       Name of input (unique)
    * @param  string   $value      Value for input
    * @param  bool     $checked    Checked or not?
    * @param  array|string   $attributes Attributes for input
    * @return string   Input with radio type
    */
   public function radio($name, $value = null, $checked = false, $attributes = null)

   /**
    * Generates label
    * @method password
    * @param  string   $for        For input (unique)
    * @param  string   $text      Value for input
    * @param  array|string   $attributes Attributes for input
    * @return string   Input with radio type
    */
   public function label($for, $text = null, $attributes = null)

   /**
    * Generates submit button
    * @method password
    * @param  string   $name       Name of input (unique)
    * @param  string   $value      Value for input
    * @param  array|string   $attributes Attributes for input
    * @return string   Input with submit type
    */
   public function submit($name, $value = null, $attributes = null)


   /**
    * Generates button
    * @method password
    * @param  string   $name       Name of input (unique)
    * @param  string   $value      Value for input
    * @param  array|string   $attributes Attributes for input
    * @return string   Input with button type
    */
   public function button($name, $value = null, $attributes = null)

```
