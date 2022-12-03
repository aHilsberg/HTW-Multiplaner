<?php

namespace App\Enums;

enum ModuleContent: int {
    case Supervisors = 0;
    case Lecturers = 1;
    case Events = 2;
    case Workload = 3;
    case Credits = 4;
    case ExaminationWork = 5;
    case PreExaminationWork = 6;
    case Content = 7;
    case Skills = 8;
    case Requirements = 9;
    case OptionalRequirements = 10;
    case Languages = 11;
    case Name = 12;
}
