<?php
//共通に使う関数を記述

function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');  
}
