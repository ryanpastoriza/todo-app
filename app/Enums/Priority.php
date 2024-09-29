<?php

namespace App\Enums;
use App\Traits\EnumToArray;

enum Priority: string
{
	use EnumToArray;

    case Urgent = 'Urgent';
    case High = 'High';
    case Normal = 'Normal';
    case Low = 'Low';

    public function getValue(): int
    {
    	return match ($this) {
	        self::Urgent => 1,
	        self::High => 2,
	        self::Normal => 3,
	        self::Low => 4
    	};
    }
}