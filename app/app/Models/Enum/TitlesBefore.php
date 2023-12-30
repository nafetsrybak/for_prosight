<?php

declare(strict_types=1);

namespace App\Models\Enum;

enum TitlesBefore: string
{
    case Bc = 'Bc.';
    case Mgr = 'Mgr.';
    case Ing = 'Ing.';
    case JUDr = 'JUDr.';
    case MVDr = 'MVDr.';
    case MUDr = 'MUDr.';
    case PaedDr = 'PaedDr.';
    case Prof = 'prof.';
    case Doc = 'doc.';
    case Dipl = 'dipl.';
    case MDDr = 'MDDr.';
    case Dr = 'Dr.';
    case MgrArt = 'Mgr. art.';
    case ThLic = 'ThLic.';
    case PhDr = 'PhDr.';
    case PhMr = 'PhMr.';
    case RNDr = 'RNDr.';
    case ThDr = 'ThDr.';
    case RSDr = 'RSDr.';
    case Arch = 'arch.';
    case PharmDr = 'PharmDr.';
}