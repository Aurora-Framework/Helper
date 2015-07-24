<?php

namespace Aurora\Helper;

class Text
{
   public static function limitWords($str, $limit = 15, $end = "")
   {
      return preg_replace('/((\w+\W*|| [\p{L}]+\W*){'.($limit-1).'}(\w+))(.*)/', '${1}', $str).$end;
   }

   public static function limitCharacters($str, $limit = 15, $end = "")
   {
      return preg_match('(\S{'.$limit.'})', $str).$end;
   }

   public static function censorWords($str, $disallowed = null, $replacement = "")
   {
      return str_replace($disallowed, $replacement, $str);
   }
}
