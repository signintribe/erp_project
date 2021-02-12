<?php


	if (!function_exists('isChemist')) {
		function isChemist()
		{
			if(!Auth::check()){
				return false;
			}

			return Auth::user()->isChemist();
		}
	}

	if (!function_exists('isCustomer')) {
		function isCustomer()
		{
			if(!Auth::check()){
				return false;
			}

			return Auth::user()->isCustomer();
		}
	}

	if (!function_exists('isAdmin')) {
		function isAdmin()
		{
			if(!Auth::check()){
				return false;
			}

			return Auth::user()->isAdmin();
		}
	}

	if (!function_exists('isShipper')) {
		function isShipper()
		{
			if(!Auth::check()){
				return false;
			}

			return Auth::user()->isShipper();
		}
	}

	if (!function_exists('isGuest')) {
		function isGuest()
		{
			if(!Auth::check()){
				return true;
			} else {
				return false;
			}
		}
	}

	if (!function_exists('passedTime')) {
		function passedTime($time){
	        $date = \Carbon\Carbon::parse($time);
			$now = \Carbon\Carbon::now();
			
			return $date->diffForHumans($now);
	    }
	}