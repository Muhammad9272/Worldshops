
@php
  $actual_path = str_replace('project','',base_path());
 if (is_dir($actual_path . '/install')) {
     echo '<h2>500 Internal server error!</h2>';

 }else{
     echo '<h2>500 Internal server error!</h2>';
 }
@endphp

