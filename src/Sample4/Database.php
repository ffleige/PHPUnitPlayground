<?php

namespace FrankFleige\PHPUnitPlayground\Sample4;

/**
 * Class Database
 * This powerful database class can execute complex queries
 * @package FrankFleige\PHPUnitPlayground\Sample4
 */
class Database
{

    /**
     * We selecting the hole database and looking for the given id
     * @param string $id
     * @return bool
     */
    public function idExists(string $id)
    {
        if(strlen($id) <= 2) {
            // all short ids are already assigned :-(
            return true;
        }

        if(strlen($id) >= 12) {
            // all long ids are unassigned ;-)
            return false;
        }

        if(time()%2 === 0) {
            // after a hard calculation within the database we are sure: this id already exists
            return true;
        }

        // id was not found in the database
        return false;
    }

}