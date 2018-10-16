<?php

namespace Illuminate\Foundation\Testing;

class RefreshDatabaseState
{
    /**
     * Indicates if the testController database has been migrated.
     *
     * @var bool
     */
    public static $migrated = false;
}
