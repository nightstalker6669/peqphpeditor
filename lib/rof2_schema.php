<?php
// Native RoF2 schema 9338 additions. Validate before the first write and retain
// fields omitted by older forms; spell IDs remain full signed 32-bit values.
function rof2_integer($name, $minimum, $maximum) {
  $value = filter_var($_POST[$name], FILTER_VALIDATE_INT, ['options'=>['min_range'=>$minimum, 'max_range'=>$maximum]]);
  if ($value === false) { http_response_code(400); exit("Invalid " . htmlspecialchars($name, ENT_QUOTES)); }
  return $value;
}
function rof2_language_fields() {
  $sql = '';
  foreach (['language_required'=>[-1,27], 'language_skill_required'=>[0,100]] as $name=>$range) {
    if (array_key_exists($name, $_POST)) $sql .= ", $name=" . rof2_integer($name,$range[0],$range[1]);
  }
  return $sql;
}
function rof2_merc_buff_fields() {
  $sql = '';
  foreach (['InitialDuration'=>[-2147483648,2147483647], 'instrument_mod'=>[0,4294967295]] as $name=>$range) {
    if (array_key_exists($name, $_POST)) $sql .= ", $name=" . rof2_integer($name,$range[0],$range[1]);
  }
  return $sql;
}
