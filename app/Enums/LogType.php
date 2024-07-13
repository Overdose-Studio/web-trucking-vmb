<?php

namespace App\Enums;

/**
 * Enum representing types of logs.
 */
enum LogType: string
{
    /**
     * Create Shipment log type.
     *
     * @var string
     */
    case CREATE_SHIPMENT = 'create_shipment';

    /**
     * Set DTP log type.
     *
     * @var string
     */
    case SET_DTP = 'set_dtp';

    /**
     * Approve DTP log type.
     *
     * @var string
     */
    case APPROVE_DTP = 'approve_dtp';

    /**
     * Set DTA log type.
     *
     * @var string
     */
    case SET_DTA = 'set_dta';

    /**
     * Approve DTA log type.
     *
     * @var string
     */
    case APPROVE_DTA = 'approve_dta';

    /**
     * Create Bill log type.
     *
     * @var string
     */
    case CREATE_BILL = 'create_bill';

    /**
     * Unknown log type.
     *
     * @var string
     */
    case UNKNOWN = 'unknown';
}