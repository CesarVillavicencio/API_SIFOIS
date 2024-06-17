<?php

namespace App\Helpers;

class ArrayHelpers {

    public static function findObjectByFieldValue(array $elements, string $field, mixed $value): mixed {
        for ($i = 0; $i < count($elements); $i++) {
            if ($value === $elements[$i][$field]) {
                return $elements[$i];
            }
        }

        return false;
    }

    public static function findObjectByFieldValueDBVersion(array $elements, string $field, mixed $value): mixed {
        for ($i = 0; $i < count($elements); $i++) {
            if ($value === $elements[$i]->{$field}) {
                return $elements[$i];
            }
        }

        return false;
    }
}