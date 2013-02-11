<?php

/**
 * @created 27.01.13 - 16:27
 * @author stefanriedel
 */#

namespace Fuel\Tasks;

class Postalcode {

    static $_countries = array();

    public static function run() {
        $install = \Cli::option('install', \Cli::option('i'));
        $remove = \Cli::option('remove', \Cli::option('r'));

        if (!empty($install)) {
            static::install($install);
        }
    }

    public static function install($install) {
        static::$_countries = explode(',', $install);
        foreach (static::$_countries as $country) {
            $country_path = DOCROOT . '/data/postalcodes/' . $country;
            $country_file_path = $country_path . '/' . $country . '.txt';
            if (is_dir($country_path) && file_exists($country_file_path)) {
                $file_content = \File::read($country_file_path, true);
                $lines = explode("\n", $file_content);

                $cnt_lines = count($lines);

                $country_model = \Customers\Model_Country::find_by_iso_code($country);
                if ($country_model) {
                    foreach ($lines as $li) {
                        $tsvData = str_getcsv($li, "\t");
                        if (isset($tsvData[1]) && isset($tsvData[2])) {
                            $postalcode = $tsvData[1];
                            $city = $tsvData[2];
                            \Customers\Model_Postalcode::forge(array('postalcode' => $postalcode, 'city' => $city, 'country_id' => $country_model->id))->save();
                        }
                    }

                    //$tsvData = str_getcsv($file_content, "\t");
                    echo <<<COUNTRY
{$cnt_lines} Postleitzahlen erfolgreich hinzugefügt

COUNTRY;
                } else {
                    echo <<<COUNTRY
Es gibt leider keine Länderkennung für {$country}   

COUNTRY;
                }
            }
        }
    }

}