<?php

namespace app\common\model;

class format
{

var $rank;
var $name;
var $num;
var $score;
function __construct($rank,$name,$num,$score)
{
$this->rank=$rank;
$this->name=$name;
$this->num=$num;
$this->score=$score;
}

function tostring()
{
$string="{rank:".$this->rank.",name:'".$this->name."',num:".$this->num.",score:".$this->score."}";
return $string;
}
}