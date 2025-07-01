<?php

namespace App\Enums;

enum ReasonSubmission: string
{
    case OFFENSIVE = 'offensive';
    case VULGAR = 'vulgar';
    case OTHER = 'other';
}
