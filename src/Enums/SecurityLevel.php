<?php

namespace LogRat\Core\Enums;

enum SecurityLevel: int
{
    case SECURITY_LEVEL_NONE = 0;
    case SECURITY_LEVEL_EASY = 1;
    case SECURITY_LEVEL_MEDIUM = 2;
    case SECURITY_LEVEL_HARD = 3;
    case SECURITY_LEVEL_ADMIN = 4;
}
