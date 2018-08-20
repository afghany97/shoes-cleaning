<?php 

function create($class , $attributes = [] , $times = null,$state = 'testing')
{
	return factory($class, $times)->state($state)->create($attributes);
}

function make($class , $attributes = [] , $times = null , $state = 'testing')
{
	return factory($class, $times)->state($state)->make($attributes);
}

function raw($class , $attributes = [] , $times = null,$state = 'testing')
{
	return factory($class, $times)->state($state)->raw($attributes);
}

 ?>