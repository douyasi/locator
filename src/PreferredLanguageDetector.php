<?php

namespace Douyasi\Locator;


use Locale;

/**
 * Browser Preferred Language Detector.
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class PreferredLanguageDetector
{

    private $empty_locale = array(
        'language' => '',
        'script'   => '',
        'region'   => '',
        'variant1' => '',
        'variant2' => '',
        'variant3' => '',
        'private1' => '',
        'private2' => '',
        'private3' => '',
    );

    /**
     * Alias function for parse_accept_language.
     *
     */
    public function get()
    {
        return $this->parse_accept_language();
    }

    /**
     * Alias function for get_preferred_language.
     *
     */
    public function detect($locales = null)
    {
        return $this->get_preferred_language($locales);
    }

    /**
     * Get Preferred language info.
     * 
     */
    public function get_preferred_language($locales = null)
    {

        $preferredLanguages = $this->parse_accept_language();
        $languagePreference = array();

        if (empty($locales)) {

            return isset($preferredLanguages[0]['locales'][0]['language']) ? $preferredLanguages[0]['locales'][0]['language'] : null;

        } else {

            if (!$preferredLanguages) {
                return $locales[0];
            }
            foreach ($locales as $i => $loc) {
                $loc_arr = Locale::parseLocale($loc);
                foreach ($preferredLanguages as $language) {
                    foreach ($language['locales'] as $p_locale_arr) {
                        $result_arr = array_intersect($loc_arr, $p_locale_arr);
                        if (count($result_arr) > 0) {
                            $languagePreference[] = [
                                'locale'   => $loc,
                                'priority' => $language['priority'],
                                'weight'   => count($result_arr),
                            ];
                        }
                    }
                }
            }
        }
        $languagePreference = multi_array_sort($languagePreference, ['priority', 'weight'], ['desc', 'desc']);
        return isset($languagePreference[0]['locale']) ? $languagePreference[0]['locale'] : $locales[0];
    }

    /**
     * Get all languages by browser  `Accept-Language` request header.
     *
     */
    public function parse_accept_language()
    {
        $locales = array();
        $accept_language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $accept_language = str_replace(' ', '', $accept_language);
        $re = preg_match_all("/(.*?);q=([0-9.]+)(?:,?)/i", $accept_language, $matches);
        if ($re) {
            $locales = $this->get_languages($matches[1], $matches[2]);
            $locales = multi_array_sort($locales, 'priority', 'desc');
        }
        return $locales;
    }

    /**
     * Format languages to new array.
     *
     */
    public function get_languages(array $lang_tags_arary, array $priority_array)
    {
        $accept_languages = array();
        foreach ($lang_tags_arary as $key => $lang_tags)
        {
            $tags = explode(',', $lang_tags);
            $priority = isset($priority_array[$key]) ? (int)(floatval($priority_array[$key])*100) : 0;
            $locale_array = array();
            foreach ($tags as $tag) {
                $locale = Locale::parseLocale($tag);
                $locale = $this->fill_locale_array_key($locale);
                $locale_array[] = $locale;
            }
            $accept_languages[] = array(
                'priority' => $priority,
                'tags'     => $lang_tags,
                'locales'  => $locale_array
            );
        }
        return $accept_languages;
    }

    private function fill_locale_array_key(array $locale)
    {
        return $locale + $this->empty_locale;
    }

}
