<?php

declare(strict_types=1);

const DEFAULT_TIMEZONE = "America/Sao_Paulo";

function getConfiguredTimezone(): DateTimeZone
{
    $timezone = $_ENV["TIMEZONE"] ?? ($_SERVER["TIMEZONE"] ?? getenv("TIMEZONE"));
    $timezone = is_string($timezone) && $timezone !== "" ? $timezone : DEFAULT_TIMEZONE;

    try {
        return new DateTimeZone($timezone);
    } catch (Exception) {
        return new DateTimeZone(DEFAULT_TIMEZONE);
    }
}

function getCurrentDate(?DateTimeImmutable $now = null): DateTimeImmutable
{
    $timezone = getConfiguredTimezone();
    $now ??= new DateTimeImmutable("now", $timezone);

    return $now->setTimezone($timezone)->setTime(0, 0);
}
