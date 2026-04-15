<?php
/**
 * Custom template tags for this theme
 *
 * @package msm-theme
 */

if (!function_exists('msm_cta_button')):
    /**
     * Renders a CTA button with an icon circle.
     * Usage: msm_cta_button('Ver más', '#', 'solid');
     *
     * @param string $text    Button label.
     * @param string $link    URL.
     * @param string $variant 'solid' or 'gradient'.
     * @param bool   $echo    Whether to echo or return.
     * @return string|void
     */
    function msm_cta_button($text, $link = '#', $variant = 'solid', $echo = true)
    {
        $valid_variants = ['solid', 'gradient'];
        $variant = in_array($variant, $valid_variants) ? $variant : 'solid';

        $class = 'btn-msm-cta btn-msm-' . $variant;

        // Escape attributes
        $url = esc_url($link);
        $cls = esc_attr($class);
        $label = esc_html($text);

        $html = <<<HTML
        <div class="mb-3">
            <a href="{$url}" class="{$cls}" role="button">
                {$label}
                <span class="icon-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="msm-icon-arrow">
                        <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z" />
                    </svg>
                </span>
            </a>
        </div>
HTML;

        if ($echo) {
            echo $html;
        } else {
            return $html;
        }
    }
endif;

if (!function_exists('msm_cta_link')):
    /**
     * Renders a CTA text link with an arrow icon.
     * Usage: msm_cta_link('Ver otros eventos', '#', 'cyan');
     *
     * @param string $text    Link label.
     * @param string $link    URL.
     * @param string $variant 'cyan' or 'dark'.
     * @param bool   $echo    Whether to echo or return.
     * @return string|void
     */
    function msm_cta_link($text, $link = '#', $variant = 'cyan', $echo = true)
    {
        $valid_variants = ['cyan', 'dark'];
        $variant = in_array($variant, $valid_variants) ? $variant : 'cyan';

        $class = 'btn-msm-link btn-msm-link-' . $variant;

        $url = esc_url($link);
        $cls = esc_attr($class);
        $label = esc_html($text);

        $html = <<<HTML
        <div class="mb-3">
            <a href="{$url}" class="{$cls}">
                {$label}
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="msm-icon-arrow">
                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z"/>
                </svg>
            </a>
        </div>
HTML;

        if ($echo) {
            echo $html;
        } else {
            return $html;
        }
    }
endif;
