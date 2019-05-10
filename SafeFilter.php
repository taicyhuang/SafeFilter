$_GET       && SafeFilter($_GET);
$_POST      && SafeFilter($_POST);
$_COOKIE    && SafeFilter($_COOKIE);
  
function SafeFilter (&$arr) 
{   
      if (is_array($arr))
     {
          foreach ($arr as $key => $value) 
          {
               if (!is_array($value))
               {
                    if (!get_magic_quotes_gpc()) //magic_quotes_gpc轉義過的字使用addslashes,避免轉兩次。
                    {
                         $value    = addslashes($value);    //對（'）、（"）、（\）、 NUL加上反斜線
                    }
                    $arr[$key]    = htmlspecialchars($value,ENT_QUOTES);   //&,",',> ,< 轉html實體 &amp;,&quot;&#039;,&gt;,&lt;
               }
               else
               {
                    SafeFilter($arr[$key]);
               }
          }
     }
}
