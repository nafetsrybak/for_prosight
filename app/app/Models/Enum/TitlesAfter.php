<?php

declare(strict_types=1);

namespace App\Models\Enum;

enum TitlesAfter: string
{
    case CSc = 'CSc.';
    case DrSc = 'DrSc.';
    case PhD = 'PhD.';
    case ArtD = 'ArtD.';
    case DiS = 'DiS';
    case DiSArt = 'DiS.art';
    case FEBO = 'FEBO';
    case MPH = 'MPH';
    case BSBA = 'BSBA';
    case MBA = 'MBA';
    case DBA = 'DBA';
    case MHA = 'MHA';
    case FCCA = 'FCCA';
    case MSc = 'MSc.';
    case FEBU = 'FEBU';
    case LLM = 'LL.M';
}