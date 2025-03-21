<?php
namespace App\Services;
use InvalidArgumentException;

class LuhnService {
    public static function generateCheckDigitPrepend($number): string
    {
        if (!ctype_digit($number) || strlen($number) != 7) {
            throw new InvalidArgumentException("Input must be a 7-digit numeric string.");
        }

        $number = str_pad($number, 7, '0', STR_PAD_LEFT);

        // Convert to array of digits
        $digits = str_split($number);

        // Calculate Luhn sum on the original number
        $sum = 0;
        $alternate = true; // Start with true for the rightmost digit (which will be in an even position after adding check digit)

        for ($i = count($digits) - 1; $i >= 0; $i--) {
            $digit = intval($digits[$i]);

            if ($alternate) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            $sum += $digit;
            $alternate = !$alternate;
        }

        // Calculate check digit (what number we need to add to make sum divisible by 10)
        $checkDigit = (10 - ($sum % 10)) % 10;

        // Append check digit to the original number
        return $checkDigit.$number;
    }

    // Validate an 8-digit number with checksum prepended
    public static function validatePrepend($number): bool
    {
        if (!ctype_digit($number) || strlen($number) != 8) {
            return false; // Not a valid 8-digit numeric string
        }

        $checkDigit = $number[0]; // First digit is the checksum
        $originalNumber = substr($number, 1); // Remaining 7 digits

        $expectedNumber = self::generateCheckDigitPrepend($originalNumber);
        return $number === $expectedNumber;
    }
}
