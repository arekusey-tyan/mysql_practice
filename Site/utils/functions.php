<?php

function convert(int $size)
{
  if ($size < 1024) return $size . ' b';
  elseif ($size / 1024 < 1024) return round($size / 1024, 1) . ' kb';
  elseif ($size / (1024 * 1024) < 1024) return round($size / (1024 * 1024), 1) . ' mb';
  else return 're';
}
