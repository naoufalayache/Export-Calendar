<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ExportCalendar\ECalendar;

$events = [
    [
        'name' => 'Réunion équipe',
        'description' => 'Réunion hebdomadaire avec toute l\'équipe.',
        'location' => 'Lyon, France',
        'date_start' => '20260812T100000',
        'date_end' => '20260812T110000',
    ],
    [
        'name' => 'Déjeuner client',
        'description' => 'Déjeuner avec le client.',
        'location' => 'Paris, France',
        'date_start' => '20260813T120000',
        'date_end' => '20260813T133000',
    ],
];

$calendar = new ECalendar(
    'My Calendar',
    $events
);

$calendar->exportCalendar();