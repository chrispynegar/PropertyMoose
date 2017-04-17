<?php

namespace App\Libraries;

use League\CLImate\CLImate;

class Output extends CLImate
{
    /**
     * Simple wrapper for CLImate.
     *
     * @return league\CLImate\CLImate
     */
    public static function cli()
    {
        return new CLImate;
    }
}
