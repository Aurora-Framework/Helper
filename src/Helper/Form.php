<?php

namespace Aurora\Helper;

class Form
{

   public $values;

   public function withData($values = [])
   {
      $this->values = $values;
   }

   public function addValue($key, $value = null)
   {
      $this->values[$key] = $values;
   }

   public function getValue($key, $default = null)
   {
      return (isset($this->values[$key])) ? $this->values[$key] : $default;
   }

   public function open($action = "/", $attributes = null)
   {
      return '<form action="'.$action.'"'. (($attributes !== null) ? $this->attributes($attributes) : "") . '>';
   }

   public function close()
   {
      return "</form>";
   }

   public function hidden($name, $value = null, $attributes = null)
   {
      return '<input type="hidden" name="'.$name.'" value="'.$this->getValue($name, $value).'" '.(($attributes !== null) ? $this->attributes($attributes) : "").' />';
   }

   public function input($name, $value = null, $attributes = null)
   {
      return '<input type="text" name="'.$name.'" value="'.$this->getValue($name, $value).'" '.(($attributes !== null) ? $this->attributes($attributes) : "").'/>';
   }

   public function password($name, $value = null, $attributes = null)
   {
      return '<input type="password" name="'.$name.'" value="'.$this->getValue($name, $value).'" '.(($attributes !== null) ? $this->attributes($attributes) : "").'/>';
   }

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

   public function fieldsetOpen($legend = null, $attributes = null)
   {
      $ret = '<fieldset '.(($attributes !== null) ? $this->attributes($attributes) : "").'>';
      if ($fieldset !== null) {
         $ret .= '<legend '.((isset($attributes["legend"])) ? $this->attributes($attributes["legend"]) : "").'>'.$legend.'</legend>';
      }
      return $ret;
   }

   public function fieldsetClose()
   {
      return '</fieldset>';
   }

   public function checkbox($name, $value = null, $content = null, $checked = false, $attributes = null)
   {
      return '<input type="checkbox" name="'.$name.'" value="'.$this->getValue($name, $value).'" '.(($checked) ? "checked" : "" ).' '.(($attributes !== null) ? $this->attributes($attributes) : "").' />'.$content;
   }

   public function radio($name, $value = null, $content = null, $checked = false, $attributes = null)
   {
      return '<input type="radio" name="'.$name.'" value="'.$this->getValue($name, $value).'" '.(($checked) ? "checked" : "" ).' '.(($attributes !== null) ? $this->attributes($attributes) : "").' />'.$content;
   }

   public function label($name, $text = null, $attributes = null)
   {
      return '<label name="'.$name.'" '.(($attributes !== null) ? $this->attributes($attributes) : "").' />'.$text.'</label>';
   }

   public function submit($name, $value = null, $attributes = null)
   {
      return '<input type="submit" name="'.$name.'" '.(($attributes !== null) ? $this->attributes($attributes) : "").' value="'.$this->getValue($name, $value).'" />';
   }

   public function button($name, $value = null, $attributes = null)
   {
      return '<input type="button" name="'.$name.'" '.(($attributes !== null) ? $this->attributes($attributes) : "").' value="'.$this->getValue($name, $value).'" />';
   }

   public function attributes($attributes)
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
