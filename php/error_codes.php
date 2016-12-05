<?php

class ErrorCodes {

/************************************
 * Banner error type css classes    *
 ************************************/

public static final $TYPE_INFO = ".info";
public static final $TYPE_POSITIVE = ".positive";
public static final $TYPE_NEGATIVE = ".negative";

/************************************
 * disen_advising.php Codes         *
 ************************************/

public static final $DISEN_DEFAULT_CODE = "disen_def";

// Enabled advising results from disen_advising.php

public static final $SUCCESS_ENABLE_ADVISING = "enable_advising_succ";
public static final $FAILURE_ENABLE_ADVISING_GENERIC = "enable_advising_fail_gen";
public static final $FAILUTE_ENABLE_ADVISING_NOT_ADVISOR = "enable_advising_fail_notadv";


// Disabled advising results from disen_advising.php

public static final $SUCCESS_DISABLE_ADVISING = "disable_advising_succ";
public static final $FAILURE_DISABLE_ADVISING_GENERIC = "disable_advising_fail_gen";
public static final $FAILUTE_DISABLE_ADVISING_NOT_ADVISOR = "disable_advising_fail_notadv";

}

?>
