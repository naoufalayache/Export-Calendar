<?php
/* Declaring the namespace of the class. */

namespace ExportCalendar;

class ECalendar
{
    
    /* Declaring the properties of the class. */
    public array $events;
    public string $name;

    /**
     * The function takes in two parameters,  and , and sets the  property to the
     *  parameter and the  property to the  parameter
     * 
     * @param name The name of the event.
     * @param events An array of events that the listener is listening for.
     */
    public function __construct($name,$events)
    {
        $this->events = $events;
        $this->name = $name;
    }

    /**
     * The function takes an array of events, and creates an iCalendar file from them
     */
    public function exportCalendar()
    {
        $ical = "BEGIN:VCALENDAR\r\n";
        $ical .= "VERSION:2.0\r\n";
        $ical .= "PRODID:-//ExportCalendar//" . $this->name . "//EN\r\n";
        $ical .= "CALSCALE:GREGORIAN\r\n";
        $ical .= "METHOD:PUBLISH\r\n";
        foreach ($this->events as $event) {
            $slug = strtolower((str_replace(array(' ', "'", '.'), array('_', '', ''), $this->name)));
            $ical .= "BEGIN:VEVENT\n";
            $ical .= "uID:" . date('Y-m-d') . 'T' . date("H:i:s") . "-" . rand() . "-learnphp.co\n";
            if (isset($event['description'])) {
                $ical .= "DESCRIPTION:" . $event['description'] . "\n";
            }
            if (isset($event['location'])) {
                $ical .= "LOCATION:" . $event['location'] . "\n";
            }
            $ical .= "DTSTAMP:" . date('Y-m-d') . 'T' . date("H:i:s") . "\n";
            $ical .= "DTSTART:" . $event['date_start'] . " \n";
            $ical .= "DTEND:" . $event['date_end'] . " \n";
            $ical .= "SUMMARY: " . $event['name'] . "\n";
            $ical .= "END:VEVENT\n";
        }
        $ical .= "END: VCALENDAR\n";
        header("Content-Type: text/Calendar; charset=utf-8");
        header("Content-Disposition: inline; filename=" . ($slug ?? 'no-valid-filename-name') . ".ics");
        echo $ical;
    }
}