<?php
generateWorkSchedule(2024, 7, 2);
class WorkShiftDay {
    public $day;
    public $month;
    public $year;
    public $isWorkDay;

    public function __construct($day, $month, $year, $isWorkDay = false) {
        $this->day = $day;
        $this->month = $month;
        $this->year = $year;
        $this->isWorkDay = $isWorkDay;
    }
}

function generateWorkSchedule($startYear, $startMonth, $numMonths) {
    $workDayInterval = 3;
    $workShiftCalendar = [];

    $currentYear = $startYear;
    $currentMonth = $startMonth;
    $currentWorkDay = 1;

    for ($i = 0; $i < $numMonths; $i++) {
        $calendar = CAL_GREGORIAN;
        $daysInMonth = cal_days_in_month($calendar, $currentMonth, $currentYear);

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $workShiftCalendar[] = new WorkShiftDay($day, $currentMonth, $currentYear);
        }

        while ($currentWorkDay <= $daysInMonth) {
            $currentDate = mktime(0, 0, 0, $currentMonth, $currentWorkDay, $currentYear);
            $dayOfWeek = date('N', $currentDate);

            if ($dayOfWeek == 6 || $dayOfWeek == 7) {
                $nextMonday = $currentWorkDay + (8 - $dayOfWeek);
                if ($nextMonday <= $daysInMonth) {
                    $workShiftCalendar[count($workShiftCalendar) - ($daysInMonth - $nextMonday + 1)]->isWorkDay = true;

                    $currentWorkDay = $nextMonday + $workDayInterval;
                }
            } else {
                $workShiftCalendar[count($workShiftCalendar) - ($daysInMonth - $currentWorkDay + 1)]->isWorkDay = true;
                $currentWorkDay += $workDayInterval;
            }
        }

        $currentWorkDay = 1;
        $currentMonth++;
        if ($currentMonth > 12) {
            $currentMonth = 1;
            $currentYear++;
        }
    }

    foreach ($workShiftCalendar as $workShiftDay) {
        if ($workShiftDay->day == 1) {
            $monthName = date('F', mktime(0, 0, 0, $workShiftDay->month, 1, $workShiftDay->year));
            echo "Расписание на месяц: $monthName {$workShiftDay->year}" . PHP_EOL;
        }
        $dayString = str_pad($workShiftDay->day, 2, '0', STR_PAD_LEFT);
        if ($workShiftDay->isWorkDay) {
            echo "\033[1;32m$dayString\033[0m "; // Зеленый цвет для рабочих дней
        } else {
            echo "$dayString ";
        }
        if ($workShiftDay->day == cal_days_in_month(CAL_GREGORIAN, $workShiftDay->month, $workShiftDay->year)) {
            echo PHP_EOL;
        }
    }
}
