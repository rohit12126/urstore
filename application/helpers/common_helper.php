<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**

*	clear cache

*/
if ( ! function_exists('get_first_image')) 
{
	function get_first_image($array='')

	{
		$CI =& get_instance();
      	return $CI->Top_model->get_first_image($array);
	}

}
if ( ! function_exists('get_image_array')) 
{
	function get_image_array($array='')

	{
		$CI =& get_instance();
      	return $CI->Top_model->get_image_array($array);
	}

}
if ( ! function_exists('get_last_rank')) 
{
	function get_last_rank($table='',$where=array(),$date='')
	{
		$CI =& get_instance();
      	return $CI->Top_model->get_last_rank($table,$where,$date);
	}

}
if ( ! function_exists('next_link')) 
{
	function next_link($table='',$id='')
	{
		$CI =& get_instance();
      	return $CI->Top_model->next_link($table,$id);
	}

}
if ( ! function_exists('pre_link')) 
{
	function pre_link($table='',$id='')
	{
		$CI =& get_instance();
      	return $CI->Top_model->pre_link($table,$id);
	}

}