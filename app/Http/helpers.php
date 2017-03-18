<?php

/**
 * Return 'active' for the active route.
 *
 * @param $route
 *
 * @return string
 */
function is_active($route)
{
    return Route::currentRouteName() == $route ? 'active' : '';
}

/**
 * Return 'active' for the active url.
 *
 * @param $url
 *
 * @return string
 */
function is_active_url($url)
{
    return Request::is($url) || Request::is($url.'/*') ? 'active' : '';
}

function is_active_compare($original, $compare)
{
    return $original == $compare ? 'active' : '';
}

/**
 * @param $value
 *
 * @return int
 */
function is_url($value)
{
    return preg_match('%^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@|\d{1,3}(?:\.\d{1,3}){3}|(?:(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)(?:\.(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)*(?:\.[a-z\x{00a1}-\x{ffff}]{2,6}))(?::\d+)?(?:[^\s]*)?$%iu', $value);
}

/**
 * @param $value
 *
 * @return mixed
 */
function domain_base($value)
{
    $find = [
        'http://',
        'https://',
        'www.',
    ];

    $domain = str_replace($find, '', $value);
    $domain = explode('/', $domain);

    return $domain[0];
}

/**
 * @param $date
 * @param $format
 *
 * @return string
 */
function localeDate($date, $format)
{
    return Jenssegers\Date\Date::createFromFormat('d-m-Y H:i:s', $date->format('d-m-Y H:i:s'))->format($format);
}

/**
 * @param $status
 * @param $compare
 *
 * @return string
 */
function signupButtonOpactiy($status, $compare)
{
    if ($status == 0 || $status == $compare) {
        return '1';
    }

    return '.4';
}

/**
 * @param $color
 * @param bool $opacity
 *
 * @return string
 */
function hex2rgba($color, $opacity = false)
{
    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if (empty($color)) {
        return $default;
    }

    //Sanitize $color if "#" is provided
    if ($color[0] == '#') {
        $color = substr($color, 1);
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = [$color[0].$color[1], $color[2].$color[3], $color[4].$color[5]];
    } elseif (strlen($color) == 3) {
        $hex = [$color[0].$color[0], $color[1].$color[1], $color[2].$color[2]];
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb = array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if ($opacity) {
        if (abs($opacity) > 1) {
            $opacity = 1.0;
        }
        $output = 'rgba('.implode(',', $rgb).','.$opacity.')';
    } else {
        $output = 'rgb('.implode(',', $rgb).')';
    }

    //Return rgb(a) color string
    return $output;
}

/**
 * @param $code
 * @param int $limit
 *
 * @return string
 */
function substr_close_tags($code, $limit = 300)
{
    if (strlen($code) <= $limit) {
        return $code;
    }

    $html = substr($code, 0, $limit);
    preg_match_all('#<([a-zA-Z]+)#', $html, $result);

    foreach ($result[1] as $key => $value) {
        if (strtolower($value) == 'br') {
            unset($result[1][$key]);
        }
    }
    $openedtags = $result[1];

    preg_match_all('#</([a-zA-Z]+)>#iU', $html, $result);
    $closedtags = $result[1];

    foreach ($closedtags as $key => $value) {
        if (($k = array_search($value, $openedtags)) === false) {
            continue;
        } else {
            unset($openedtags[$k]);
        }
    }

    if (empty($openedtags)) {
        if (strpos($code, ' ', $limit) == $limit) {
            return $html.'...';
        } else {
            return substr($code, 0, strpos($code, ' ', $limit)).'...';
        }
    }

    $position = 0;
    $close_tag = '';
    foreach ($openedtags as $key => $value) {
        $p = strpos($code, ('</'.$value.'>'), $limit);

        if ($p === false) {
            $code .= ('</'.$value.'>');
        } elseif ($p > $position) {
            $close_tag = '</'.$value.'>';
            $position = $p;
        }
    }

    if ($position == 0) {
        return $code;
    }

    return substr($code, 0, $position).$close_tag.'...';
}

/**
 * @param $s
 * @param $l
 * @param string $e
 * @param bool   $isHTML
 *
 * @return string
 */
function truncate_html($s, $l, $e = '', $isHTML = true)
{
    $s = trim($s);
    $e = (strlen(strip_tags($s)) > $l) ? $e : '';
    $i = 0;
    $tags = [];

    if ($isHTML) {
        preg_match_all('/<[^>]+>([^<]*)/', $s, $m, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
        foreach ($m as $o) {
            if ($o[0][1] - $i >= $l) {
                break;
            }
            $t = substr(strtok($o[0][0], " \t\n\r\0\x0B>"), 1);
            if ($t[0] != '/') {
                $tags[] = $t;
            } elseif (end($tags) == substr($t, 1)) {
                array_pop($tags);
            }
            $i += $o[1][1] - $o[0][1];
        }
    }
    $output = substr($s, 0, $l = min(strlen($s), $l + $i)).(count($tags = array_reverse($tags)) ? '</'.implode('></', $tags).'>' : '').$e;

    return $output;
}

function truncate_text($s, $l, $wrap = true)
{
    $s = trim($s);
    $output = strlen($s) > $l ? substr($s, 0, $l).'...' : $s;

    return $wrap ? '<p>'.$output.'</p>' : $output;
}

function truncate_nonhtml($s, $l)
{
    $s = strip_tags($s, '');

    return trim(substr($s, 0, $l));
}

function last_tweets($max = 1)
{
    if (Cache::has('twitter.tweets')) {
        $tweets = Cache::get('twitter.tweets');
    } else {
        $tweets = Twitter::getUserTimeline(['screen_name' => 'PendoNL', 'count' => 10, 'format' => 'json', 'exclude_replies' => true, 'include_rts' => false]);
        Cache::put('twitter.tweets', $tweets, 30);
    }

    return $sliced_array = array_slice(json_decode($tweets), 0, $max);
}
