<?php

/**
 * ConfigJSON.php
 * @Auteur: Christophe Dufour
 * 
 * Librairie de configuration d'une application php à partir d'un fichier JSON
 */

declare(strict_types=1);

namespace ChrisDfr\ConfigJSON;

use ChrisDfr\ConfigJSON\Exception\InvalidJsonException;
use SplFileObject;

class ConfigJSON
{
    /**
     * Tableau des paramètres
     */
    public private(set) static array $setting = [];

    /**
     * @param string $filename
     * Le chemin vers le fichier json à lire
     * @throws InvalidJsonException
     * Lance une exception InvalidJsonException si le décodage de la chaine json échoue
     * @return void
     * Ne retourne aucune valeur
     */
    public static function load(string $filename): void // ConfigJSON
    {
        $file = new SplFileObject($filename);
        $content = $file->fread($file->getSize());
        
        if(is_null($jsonArray = json_decode($content, true))) {
            throw new InvalidJsonException("Erreur de decodage JSON: " . self::jsonErrorMsg());
        }

        self::$setting = $jsonArray;
    }

    /**
     * Retourne une chaine de caractère représentant la dernière erreur survenue par le decodage json
     * 
     * @return string
     * Retourne une chaine de caractère
     */
    private static function jsonErrorMsg(): string
    {
        switch(json_last_error()) {
            case JSON_ERROR_DEPTH:
                $msg = "Profondeur maximale atteinte";
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $msg = "JSON invalide ou mal formé";
                break;
            case JSON_ERROR_CTRL_CHAR:
                $msg = "Erreur de caractère de contrôle";
                break;
            case JSON_ERROR_SYNTAX:
                $msg = "Erreur de syntaxe";
                break;
            case JSON_ERROR_UTF8:
                $msg = "Caractères UTF-8 malformés";
                break;
            default:
                $msg = "Erreur inconnue";
                break;
        }

        return $msg;
    }
}
