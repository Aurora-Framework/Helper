<?php

namespace Aurora\Helper;

class Form
{
   /**
    * Stores every value by its key or name
    *
    * @var array
    */
   public $values;

   /**
    * Stores array to values
    *
    * @method withData
    * @param  array   $values Array of values with their keys
    *
    */
   public function withData($values = [])
   {
      $this->values = $values;
   }

   /**
    * Adds or replace value to values array with given key
    * @method addValue
    * @param  string   $key   Name or key for given input
    * @param  string   $value Value for given key/name
    */
   public function addValue($key, $value = null)
   {
      $this->values[$key] = $values;
   }

   /**
    * Returns value for given key/name
    * @method getValue
    * @param  string   $key     Identifying key
    * @param  string   $default Default value if value for givent key is not found
    * @return string   Found or default value
    */
   public function getValue($key, $default = null)
   {
      return (isset($this->values[$key])) ? $this->values[$key] : $default;
   }

   /**
    * Opens form
    * @method open
    * @param  string $action     Action for form
    * @param  array|string $attributes Attributes for form
    * @return string First line of Form
    */
   public function open($action = "/", $attributes = null)
   {
      return '<form action="'.$action.'"'. (($attributes !== null) ? $this->attributes($attributes) : "") . '>';
   }

   /**
    * Closes form
    * @method close
    * @return string Ending line of form
    */
   public function close()
   {
      return "</form>";
   }

   /**
    * Generates hidden input for form
    * @method hidden
    * @param  string $name       Name of input (unique)
    * @param  string $value      Value for input
    * @param  array|string $attributes Attributes for input
    * @return string Hidden input
    */
   public function hidden($name, $value = null, $attributes = null)
   {
      return '<input type="hidden" name="'.$name.'" value="'.$this->getValue($name, $value).'" '.(($attributes !== null) ? $this->attributes($attributes) : "").' />';
   }

   /**
    * Generates text input
    * @method input
    * @param  string $name       Name of input (unique)
    * @param  string $value      Value for input
    * @param  array|string $attributes Attributes for input
    * @return string Input with text type
    */
   public function input($name, $value = null, $attributes = null)
   {
      return '<input type="text" name="'.$name.'" value="'.$this->getValue($name, $value).'" '.(($attributes !== null) ? $this->attributes($attributes) : "").'/>';
   }

   /**
    * Generates password input
    * @method password
    * @param  string   $name       Name of input (unique)
    * @param  string   $value      Value for input
    * @param  array|string   $attributes Attributes for input
    * @return string   Input with password type
    */
   public function password($name, $value = null, $attributes = null)
   {
      return '<input type="password" name="'.$name.'" value="'.$this->getValue($name, $value).'" '.(($attributes !== null) ? $this->attributes($attributes) : "").'/>';
   }

   /**
    * Generates dropdown
    * @method dropdown
    * @param  string   $name      Name of dropdown
    * @param  array   $options   Array of options for dropdown
    * @param  array|string   $atributes Attributes for dropdown
    * @return string   Returns generated dropdown
    */
   public function dropdown($name, $options = [], $atributes = null)
   {
      $ret = '<select name="'.$name.'" '.(($attributes !== null) ? $this->attributes($attributes) : "").'>';
      foreach ($variable as $key => $value) {
         if (is_array($value)) {
            $ret .= '<option value="'.$key.'" '.((isset($value["attributes"])) ? $this->atributes($value["attributes"]) : "").'>'.$this->getValue($key, $value["value"]).'</option>';
         } else {
            $ret .= '<option value="'.$key.'">'.$this->getValue($key, $value).'</option>';
         }
      }
      $ret .= "</select>";
      return $ret;
   }

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
   {
      $ret = '<select multiple name="'.$name.'" '.(($attributes !== null) ? $this->attributes($attributes) : "").'>';
      foreach ($variable as $key => $value) {
         if (is_array($value)) {
            $ret .= '<option '.(isset($select[$key]) ? "selected" : "").' value="'.$key.'" '.((isset($value["attributes"])) ? $this->atributes($value["attributes"]) : "").'>'.$this->getValue($key, $value["value"]).'</option>';
         } else {
            $ret .= '<option '.(isset($select[$key]) ? "selected" : "").' value="'.$key.'">'.$this->getValue($key, $value).'</option>';
         }
      }
      $ret .= "</select>";
      return $ret;
   }

   /**
    * Opens fieldset
    * @method fieldsetOpen
    * @param  string       $legend     Text for legend
    * @param  array|string       $attributes Attributes for form
    * @return string Opened fieldset
    */
   public function fieldsetOpen($legend = null, $attributes = null)
   {
      $ret = '<fieldset '.(($attributes !== null) ? $this->attributes($attributes) : "").'>';
      if ($fieldset !== null) {
         $ret .= '<legend '.((isset($attributes["legend"])) ? $this->attributes($attributes["legend"]) : "").'>'.$legend.'</legend>';
      }
      return $ret;
   }

   /**
    * Closes fieldset
    * @method fieldsetClose
    * @return string End of fieldset
    */
   public function fieldsetClose()
   {
      return '</fieldset>';
   }

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
   {
      return '<input type="checkbox" name="'.$name.'" value="'.$this->getValue($name, $value).'" '.(($checked) ? "checked" : "" ).' '.(($attributes !== null) ? $this->attributes($attributes) : "").' />';
   }

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
   {
      return '<input type="radio" name="'.$name.'" value="'.$this->getValue($name, $value).'" '.(($checked) ? "checked" : "" ).' '.(($attributes !== null) ? $this->attributes($attributes) : "").' />';
   }

   /**
    * Generates label
    * @method password
    * @param  string   $for        For input (unique)
    * @param  string   $text      Value for input
    * @param  array|string   $attributes Attributes for input
    * @return string   Input with radio type
    */
   public function label($for, $text = null, $attributes = null)
   {
      return '<label for="'.$name.'" '.(($attributes !== null) ? $this->attributes($attributes) : "").' />'.$text.'</label>';
   }

   /**
    * Generates submit button
    * @method password
    * @param  string   $name       Name of input (unique)
    * @param  string   $value      Value for input
    * @param  array|string   $attributes Attributes for input
    * @return string   Input with submit type
    */
   public function submit($name, $value = null, $attributes = null)
   {
      return '<input type="submit" name="'.$name.'" '.(($attributes !== null) ? $this->attributes($attributes) : "").' value="'.$this->getValue($name, $value).'" />';
   }

   /**
    * Generates button
    * @method password
    * @param  string   $name       Name of input (unique)
    * @param  string   $value      Value for input
    * @param  array|string   $attributes Attributes for input
    * @return string   Input with button type
    */
   public function button($name, $value = null, $attributes = null)
   {
      return '<input type="button" name="'.$name.'" '.(($attributes !== null) ? $this->attributes($attributes) : "").' value="'.$this->getValue($name, $value).'" />';
   }

   /**
    * Generates attributes
    * @method attributes
    * @param  array|string     $attributes Given attributes
    * @return string     Returns attributes in inline form
    */
   protected function attributes($attributes)
   {
      if (!is_array($attributes)) {
         return $attributes;
      }

      $attr = '';
      foreach ($attributes as $attribute => $value) {
         if (is_int($attribute)) {
            $attribute = $value;
         }
         $attr .= ' ' . $attribute . '="' . $value . '"';
      }

      return $attr;
   }

}
