<?php

    /**
     * Validate HTML
     */
    Validator::extend(
        'html',
        function ($attribute, $value, $parameters) {
            $value = strip_tags($value, "");
            return strlen(trim($value)) > $parameters[0];
        }
    );
