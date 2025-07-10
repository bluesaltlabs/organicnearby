<?php

namespace App\Rules;

class LocationRules
{
    public static function rules($prefix = 'location.')
    {
        return [
            $prefix . 'address' => 'nullable|string',
            $prefix . 'address_line_2' => 'nullable|string',
            $prefix . 'label' => 'nullable|string',
            $prefix . 'county' => 'nullable|string',
            $prefix . 'country' => 'nullable|string',
            $prefix . 'timezone' => 'nullable|string',
            $prefix . 'city' => 'nullable|string',
            $prefix . 'state' => 'nullable|string',
            $prefix . 'zip' => 'nullable|string',
            $prefix . 'map_icon' => 'nullable|string',
            $prefix . 'latitude' => 'nullable|numeric',
            $prefix . 'longitude' => 'nullable|numeric',
        ];
    }
} 