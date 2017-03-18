<?php
/**
 * Ok, glad you are here
 * first we get a config instance, and set the settings
 * $config = HTMLPurifier_Config::createDefault();
 * $config->set('Core.Encoding', $this->config->get('purifier.encoding'));
 * $config->set('Cache.SerializerPath', $this->config->get('purifier.cachePath'));
 * if ( ! $this->config->get('purifier.finalize')) {
 *     $config->autoFinalize = false;
 * }
 * $config->loadArray($this->getConfig());.
 *
 * You must NOT delete the default settings
 * anything in settings should be compacted with params that needed to instance HTMLPurifier_Config.
 *
 * @link http://htmlpurifier.org/live/configdoc/plain.html
 */
return [

    'encoding'  => 'UTF-8',
    'finalize'  => true,
    'cachePath' => storage_path('app/purifier'),
    'settings'  => [
        'default' => [
            'HTML.AllowedAttributes'   => 'src, height, width, alt, style, align, summary, abbr, title, border, cellpadding, cellspacing',
            'HTML.Doctype'             => 'XHTML 1.0 Strict',
            'HTML.Allowed'             => 'script[src],h1,h2,h3,h4,h5,b,strong,i,em,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src|style|align],table[style|border|cellpadding|cellspacing|summary],td[style|abbr],thead[style],tbody[style],tr[style]',
            'CSS.AllowedProperties'    => 'width,font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align',
            'Attr.AllowedFrameTargets' => ['_blank', '_top', '_self', '_parent'],
            'AutoFormat.AutoParagraph' => true,
            'AutoFormat.RemoveEmpty'   => false,
        ],
        'default-no-links' => [
            'HTML.Doctype'             => 'XHTML 1.0 Strict',
            'HTML.Allowed'             => 'h1,h2,h3,h4,h5,b,strong,i,em,ul,ol,li,p[style],br,span[style],img[width|height|alt|src|style]',
            'CSS.AllowedProperties'    => 'width,font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align',
            'AutoFormat.AutoParagraph' => true,
            'AutoFormat.RemoveEmpty'   => true,
        ],
        'default-comment' => [
            'HTML.Doctype'             => 'XHTML 1.0 Strict',
            'HTML.Allowed'             => 'h4,h5,b,strong,i,em,ul,ol,li,p[style],br,span[style],a[href|title],img[alt|src|style]',
            'CSS.AllowedProperties'    => 'width,font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align',
            'AutoFormat.AutoParagraph' => true,
            'AutoFormat.RemoveEmpty'   => true,
        ],
        'text-only' => [
            'HTML.Doctype'             => 'XHTML 1.0 Strict',
            'HTML.Allowed'             => '',
            'AutoFormat.RemoveEmpty'   => true,
        ],
        'test'    => [
            'Attr.EnableID' => true,
        ],
        'youtube' => [
            'HTML.SafeIframe'      => 'true',
            'URI.SafeIframeRegexp' => '%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%',
        ],
    ],

];
